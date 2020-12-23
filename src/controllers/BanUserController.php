<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';
class BanUserController extends AppController
{
    public function banUser()
    {
        if($_SESSION['user_role']!='mode') {
            echo 'failure';
            return;
        }

        $userRepository = new UserRepository();
        $years = $_POST['years'];
        $months = $_POST['months'];
        $days = $_POST['days'];
        $id = $_POST['userId'];


        //$previousDate = $userRepository->setUserBanDate($id);
        $date = date("Y-m-d");
        $newDate = date('Y-m-d',strtotime($date. (' + '.$days.' days')));
        $newDate = date('Y-m-d',strtotime($newDate. (' + '.$months.' months')));
        $newDate = date('Y-m-d',strtotime($newDate. (' + '.$years.' years')));

        $userRepository->setUserBanDate($id, $newDate);

        echo 'success';
    }

    public function unbanUser()
    {
        if($_SESSION['user_role']!='mode') {
            echo 'failure';
            return;
        }

        $userRepository = new UserRepository();
        $id = $_POST['userId'];
        $userRepository->setUserBanDate($id, date('Y-m-d',strtotime(date("Y-m-d"). (' - 100 days'))));
        echo 'success';
    }

}