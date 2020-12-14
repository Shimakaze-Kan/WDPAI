<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class MapController extends AppController
{
    public function map()
    {
        if(!isset($_SESSION['user_email'])) {
            return $this->render('index');
        }

        if(!$this->isGet())
        {
            return $this->render('index');
        }



    }

}