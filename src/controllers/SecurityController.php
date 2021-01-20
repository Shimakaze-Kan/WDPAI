<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../HMAC_Cookie.php';

class SecurityController extends AppController
{
    public function login()
    {

        if(isset($_SESSION['user_id']))
        {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/featured");
        }

        $userRepository = new UserRepository();

        if(!$this->isPost())
        {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $hmac_cookie = new HMAC_Cookie();
        if(isset($_COOKIE['user'])) {
            $decryptionResult = $hmac_cookie->decryptCookieData('user');
            if ($decryptionResult[0] == false) {
                return $this->render('login', ['messages' => ['Unauthorized access, modified cookie']]);
            }

            $cookieData = explode(';',$decryptionResult[1]);
            $email = $cookieData[0];
            //$_SESSION['user_id'] = $cookieData[1];
            //$_SESSION['user_role'] = $cookieData[2];

            //$url = "http://$_SERVER[HTTP_HOST]";
            //header("Location: {$url}/featured");
        }

        $user = $userRepository->getUserByEmail($email);

        if(!$user)
        {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if($email !== $user->getEmail())
        {
            return $this->render('login', ['messages' => ['wrong email']]);
        }

        if(!isset($_COOKIE['user']) && !password_verify($password,  $user->getPassword()))
        {
            return $this->render('login', ['messages' => ['wrong password']]);
        }

        $banDate = $user->getBanDate();
        $today = date("Y-m-d");

        if ($banDate > $today) {
            return $this->render('login', ['messages' => ['Your account has been blocked until: '.$banDate.' today is '.$today]]);
        }


        $userRepository->changeUserActiveStatus($email, true);

        $user_email = $user->getEmail();
        $user_id = $user->getId();
        $user_role = $user->getRole();


        if(!isset($_COOKIE['user'])) {
            $cookieData = $hmac_cookie->encryptCookieData( $user_email.';'.$user_id . ';' . $user_role);
            setcookie('user', $cookieData, time() + (86000 * 30), "/");
        }

        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_role'] = $user_role;

        //setcookie("loginCredentials", $email, time() + 7200);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/featured");
    }

    public function logout()
    {
        $userRepository = new UserRepository();
        if(isset($_SESSION['user_email'])) {
            $userRepository->changeUserActiveStatus($_SESSION['user_email'], false);
        }
        setcookie("user", "", time() - 3600);
        session_destroy();
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/index");
    }

    public function registration()
    {
        if(!$this->isPost())
        {
            return $this->render('registration');
        }

        $userRepository = new UserRepository();
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return $this->render('registration', ['messages' => ['The email address doesn\'t look right']]);
        }

        if(strlen($password) < 4)
        {
            return $this->render('registration', ['messages' => ['Password is too short, should be at least 4 characters long']]);
        }

        $user = $userRepository->getUserByEmail($email);

        if($user)
        {
            return $this->render('registration', ['messages' => ['User already exist!']]);
        }

        $newUser = new User($email, $password);
        $result = $userRepository->addUser($newUser);


        if($result==false) {
            return $this->render('registration', ['messages' => [$result]]);
        }


        return  $this->render('login',['messages' => ['Account created successfuly']]);
    }
}