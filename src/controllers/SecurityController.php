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
        $hmac_cookie = new HMAC_Cookie();

        $userRepository = new UserRepository();

        if(!$this->isPost())
        {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUserByEmail($email);

        if(!$user)
        {
            return $this->render('login', ['messages' => ['User not exist!']]);
        }

        if($email !== $user->getEmail())
        {
            return $this->render('login', ['messages' => ['wrong email']]);
        }

        if(!password_verify($password,  $user->getPassword()))
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

        $user = $userRepository->getUserByEmail($email);

        if($user)
        {
            return $this->render('registration', ['messages' => ['User already exist!']]);
        }

        $newUser = new User($email, $password, 0);
        $result = $userRepository->addUser($newUser);


        if($result==false) {
            return $this->render('registration', ['messages' => [$result]]);
        }


        return  $this->render('login',['messages' => ['Account created successfuly']]);
    }
}