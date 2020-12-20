<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/TopicRepository.php';

class RecentController extends AppController
{
    public function recent()
    {
         $topicRepository = new TopicRepository();
        $result = $topicRepository->getAllTopic();

        $this->render('recent',['topics'=>$result]);
    }
}