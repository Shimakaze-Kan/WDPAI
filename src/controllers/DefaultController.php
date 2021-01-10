<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
    public function index()
    {
        if(isset($_SESSION['user_email'])) {
            return $this->render('featured');
        }

        if(isset($_COOKIE['user']))
        {
            $this->render('login', ['cookie' => 'true']);
        }
        else {
            $this->render('login');
        }
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