<?php

require_once 'AppController.php';
require_once __DIR__.'/../HMAC_Cookie.php';

class DefaultController extends AppController
{
    public function index()
    {
        if(isset($_SESSION['user_email'])) {
            return $this->render('featured');
        }

        $hmac_cookie = new HMAC_Cookie();
        if(isset($_COOKIE['user'])) {
            $decryptionResult = $hmac_cookie->decryptCookieData('user');
            if ($decryptionResult[0] == false) {
                return $this->render('login', ['messages' => ['Unauthorized access, modified cookie']]);
            }

            $cookieData = explode(';',$decryptionResult[1]);
            $_SESSION['user_email'] = $cookieData[0];
            $_SESSION['user_id'] = $cookieData[1];
            $_SESSION['user_role'] = $cookieData[2];

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/featured");
        }

        $this->render('login');
    }

    public function featured()
    {
        if(!isset($_SESSION['user_email'])) {
            return $this->render('login');
        }

        if(!$this->isCookieSetted())
        {
            return $this->render('login');
        }
        $this->render('featured');

    }

    public function registration()
    {
        if(!$this->isCookieSetted())
        {
            return $this->render('login');
        }
        $this->render('registration');
    }

    public function tea()
    {
        if(!isset($_SESSION['user_email'])) {
            return $this->render('login');
        }

        if(!$this->isCookieSetted())
        {
            return $this->render('login');
        }
        $this->render('tea');
    }

    public function add()
    {
        if(!isset($_SESSION['user_email'])) {
            return $this->render('login');
        }

        if(!$this->isCookieSetted())
        {
            return $this->render('login');
        }
        $this->render('add');
    }

    public function profile()
    {
        if(!isset($_SESSION['user_email'])) {
            return $this->render('login');
        }

        if(!$this->isCookieSetted())
        {
            return $this->render('login');
        }
        $this->render('profile');
    }

}