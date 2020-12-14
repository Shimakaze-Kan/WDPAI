<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class ProfileController extends AppController
{
    public function profile()
    {
        if(!isset($_SESSION['user_email'])) {
            return $this->render('index');
        }

        $userRepository = new UserRepository();

        if(!$this->isGet())
        {
            return $this->render('login');
        }

        $email = $_SESSION['user_email'];
        $user = $userRepository->getUser($email);
        $details = $userRepository->getUsersDetails($user->getId());

        return $this->render('profile', (['email' => $user->getEmail(), 'id' => $user->getId()]+$details));
    }

}