<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/TopicRepository.php';
class ProfileController extends AppController
{
    public function profile()
    {
        if(!isset($_SESSION['user_email'])) {
            return $this->render('index');
        }

        $userRepository = new UserRepository();
        $topicRepository = new TopicRepository();

        if(!$this->isGet())
        {
            return $this->render('login');
        }

        $user = null;

        if(!empty($_GET))
        {
            $id = $_GET['id'];
            $user = $userRepository->getUserById($id);
        }
        else
        {
            $email = $_SESSION['user_email'];
            $user = $userRepository->getUserByEmail($email);
        }

        $ban = strtotime($user->getBanDate());
        if(date('Y-m-d',$ban)<date("Y-m-d"))
        {
            $ban=false;
        }
        else
        {
            $ban=date("Y-m-d",$ban);
        }


        $details = $userRepository->getUsersDetails($user->getId());
        $history = $topicRepository->getUsersTopics($user->getId());

        $isMode = $_SESSION['user_role'] == 'mode';

        return $this->render('profile', (['email' => $user->getEmail(), 'id' => $user->getId(),'topics' => $history, 'role' => $user->getRole(), 'active'=>$user->isActive(), 'isMode'=>$isMode, 'ban'=>$ban]+$details));
    }

}