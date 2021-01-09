<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';
class UpdateLastActivityController extends AppController
{

    public function updateLastActivity()
    {
        $userRepository = new UserRepository();

        $id = $_SESSION['user_id'];
        $userRepository->updateLastActivity($id);
    }
}