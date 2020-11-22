<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login()
    {
        $user = new User("random@test.pl", "1234", "John", "Smith");

        if(!$this->isPost())
        {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if($email !== $user->getEmail())
        {
            return $this->render('login', ['messages' => ['wrong email']]);
        }

        if($password !== $user->getPassword())
        {
            return $this->render('login', ['messages' => ['wrong password']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/featured");
    }
}