<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
    public function index()
    {
        $this->render('login');
    }

    public function featured()
    {
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
        if(!$this->isCookieSetted())
        {
            return $this->render('login');
        }
        $this->render('tea');
    }

    public function add()
    {
        if(!$this->isCookieSetted())
        {
            return $this->render('login');
        }
        $this->render('add');
    }
}