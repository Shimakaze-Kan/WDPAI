<?php

require_once 'AppController.php';
require_once __DIR__."/../models/Topic.php";
require_once __DIR__.'/../repository/TopicRepository.php';
class TopicController extends AppController
{
    const NO_IMAGE_URL = "public/img/uploads/No-image.svg";
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

        if(strlen($url)>16384)
        {
            echo 'failure';
            return;
        }

        $topic = new Topic($title, $url);
        $this->topicRepository->addTopic($topic);


        echo 'success '.substr($_SERVER['SERVER_NAME'],0,-1)."featured";
    }

    public function deleteTopic()
    {
        if(!$this->isPost())
        {
            return $this->render('login');
        }

        if($_SESSION['user_role']!='mode') {
            echo 'failure';
            return;
        }

        $id = $_POST['id'];
        $result = $this->topicRepository->deleteTopic($id);

        echo 'success';
    }

    public function updateCountryData()
    {

        if(!$this->isPost())
        {
            return $this->render('tea');
        }

        $value = $_POST['value'];
        $countryId = $_POST['id'];
        $topicId = $_POST['topicId'];


        if($value=='' || $countryId=='' || $topicId=='')
        {
            echo 'failure';
            return;
        }

        $result = $this->topicRepository->updateTopicDetail($countryId,$value,$topicId);

        if($result==false)
        {
            echo 'failure';
            return;
        }

        echo 'success';
    }

    public function getCountriesData()
    {
        if(!$this->isPost())
        {
            return $this->render('tea');
        }

        $id = $_POST['id'];
        $result = $this->topicRepository->getTopicDetails($id);

        if($result==false)
        {
            echo 'failure';
            return;
        }

        echo json_encode($result);
    }

    public function recent()
    {
        if(!$this->isGet())
        {
            return $this->render('featured');
        }

        $result = $this->topicRepository->getAllTopic();
        $this->render('recent',['topics'=>$result]);
    }

    public function featured()
    {
        if(!$this->isGet())
        {
            return $this->render('login');
        }

        $topics = $this->topicRepository->getFeaturedTopics();

        foreach ($topics as $topic)
        {
            if($topic->getImgUrl() == "")
            {
                $topic->setImgUrl(self::NO_IMAGE_URL);
            }
        }

        $this->render('featured', ['topics' => $topics]);
    }

    public function tea()
    {
        if(!$this->isGet())
        {
            return $this->render('featured');
        }

        $id = $_GET['id'];
        $topic = $this->topicRepository->getTopic($id);

        $this->render('tea', ['title' => $topic->getTitle()]);
    }
}