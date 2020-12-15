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

        $email = $_SESSION['user_email'];
        $user = $userRepository->getUser($email);
        $details = $userRepository->getUsersDetails($user->getId());
        $history = $topicRepository->getUsersTopics($user->getId());

        return $this->render('profile', (['email' => $user->getEmail(), 'id' => $user->getId(),'topics' => $history]+$details));
    }

}