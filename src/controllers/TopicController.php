<?php

require_once 'AppController.php';
require_once __DIR__ . "/../models/Topic.php";
require_once __DIR__ . '/../repository/TopicRepository.php';

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
        $this->checkCurrentUserActiveStatus();

        $response = array('state' => 'failure');

        if (!isset($_SESSION['user_id'])) {
            echo json_encode($response);
            return;
        }

        if (!$this->isCookieSetted()) {
            return $this->render('login');
        }

        if (!$this->isPost()) {
            return $this->render('add');
        }

        $title = $_POST['title'];
        $url = $_POST['url'];

        if (strlen($title) > 60) {
            echo json_encode($response);
            return;
        }

        if (strlen($url) > 16384) {
            echo json_encode($response);
            return;
        }

        $result = $this->topicRepository->getTopicByName($title);
        if ($result) {
            $response += ["message" => "Topic already exist!"];
            echo json_encode($response);
            return;
        }

        $topic = new Topic($title, $url);
        $this->topicRepository->addTopic($topic);


        $response['state'] = 'success';
        $response += ["url" => substr($_SERVER['SERVER_NAME'], 0, -1) . "featured"];
        echo json_encode($response);
        return;
    }

    public function deleteTopic()
    {
        $this->checkCurrentUserActiveStatus();

        if (!isset($_SESSION['user_id'])) {
            echo 'failure';
            return;
        }

        if (!$this->isPost()) {
            return $this->render('login');
        }

        if ($_SESSION['user_role'] != 'mode') {
            echo 'failure';
            return;
        }

        $id = $_POST['id'];
        $result = $this->topicRepository->deleteTopic($id);

        echo 'success';
    }

    public function updateCountryData()
    {
        $this->checkCurrentUserActiveStatus();

        if (!isset($_SESSION['user_id'])) {
            echo 'failure';
            return;
        }

        if (!$this->isPost()) {
            return $this->render('tea');
        }

        $value = $_POST['value'];
        $countryId = $_POST['id'];
        $topicId = $_POST['topicId'];


        if ($value == '' || $countryId == '' || $topicId == '' || strlen($value) > 50) {
            echo 'failure';
            return;
        }

        $result = $this->topicRepository->updateTopicDetail($countryId, $value, $topicId);

        if ($result == false) {
            echo 'failure';
            return;
        }

        echo 'success';
    }

    public function getCountriesData()
    {
        $this->checkCurrentUserActiveStatus();

        if (!isset($_SESSION['user_id'])) {
            echo 'failure';
            return;
        }

        if (!$this->isPost()) {
            return $this->render('tea');
        }

        $id = $_POST['id'];
        $result = $this->topicRepository->getTopicDetails($id);

        if ($result == false) {
            echo 'failure';
            return;
        }

        echo json_encode($result);
    }

    public function recent()
    {
        $this->checkCurrentUserActiveStatus();

        if (!isset($_SESSION['user_id'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/index");
            exit();
        }

        if (!$this->isGet()) {
            return $this->render('featured');
        }

        $result = $this->topicRepository->getAllTopic();
        $this->render('recent', ['topics' => $result]);
    }

    public function featured()
    {
        $this->checkCurrentUserActiveStatus();

        if (!isset($_SESSION['user_id'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/index");
            exit();
        }

        if (!$this->isGet()) {
            return $this->render('login');
        }

        $topics = $this->topicRepository->getFeaturedTopics();

        foreach ($topics as $topic) {
            if ($topic->getImgUrl() == "") {
                $topic->setImgUrl(self::NO_IMAGE_URL);
            }
        }

        $this->render('featured', ['topics' => $topics]);
    }

    public function tea()
    {
        $this->checkCurrentUserActiveStatus();

        if (!isset($_SESSION['user_id'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/index");
            exit();
        }

        if (!$this->isGet()) {
            return $this->render('featured');
        }

        if (!isset($_GET['id']) || !ctype_digit(strval($_GET['id']))) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/featured");
            exit();
        }

        $id = $_GET['id'];
        $topic = $this->topicRepository->getTopic($id);

        if ($topic == null) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/featured");
            exit();
        }

        $this->render('tea', ['title' => $topic->getTitle()]);
    }

    public function rateTopic()
    {
        $this->checkCurrentUserActiveStatus();

        if (!isset($_SESSION['user_id'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/index");
            exit();
        }

        if (!$this->isPost() || !isset($_POST['id']) || !ctype_digit(strval($_POST['id'])) || !isset($_POST['feedback'])) {
            return $this->render('featured');
        }

        $result = $this->topicRepository->rateTopic($_POST['id'], $_POST['feedback']);

        if (!$result) {
            echo json_encode(['state' => 'failure', 'message' => 'Topic doesn\'t exist']);
            exit();
        }

        echo json_encode(['state' => 'success']);
    }
}