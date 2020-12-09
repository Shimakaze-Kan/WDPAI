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
        $this->render('featured');

    }

    public function registration()
    {
        $this->render('registration');
    }

    public function tea()
    {
        $this->render('tea');
    }
}