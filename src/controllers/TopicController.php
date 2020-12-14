<?php

require_once 'AppController.php';
require_once __DIR__."/../models/Topic.php";
require_once __DIR__.'/../repository/TopicRepository.php';
class TopicController extends AppController
{
    private $topicRepository;

    public function __construct()
    {
        parent::__construct();
        $this->topicRepository = new TopicRepository();
    }

    public function addTopic()
    {
        if(!isset($_SESSION['user_email'])) {
            return $this->render('index');
        }

        if(!$this->isCookieSetted())
        {
            return $this->render('login');
        }

        if(!$this->isPost())
        {
            return $this->render('add');
        }

        $title = $_POST['title'];
        $url = $_POST['url'];

        if(strlen($title)>60)
        {
            echo 'failure';
            return;
        }

        if(strlen($url)>255)
        {
            echo 'failure';
            return;
        }

        $topic = new Topic($title, $url);
        $this->topicRepository->addTopic($topic);



        //$this->writeData($url);

        echo 'success '.substr($_SERVER['SERVER_NAME'],0,-1)."featured";
    }

    function writeData(string $data)
    {
        $myfile = fopen("public/uploads/newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $data);
        fclose($myfile);
    }
}