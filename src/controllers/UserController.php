<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/TopicRepository.php';
class UserController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function profile()
    {
        $this->checkCurrentUserActiveStatus();

        if(!isset($_SESSION['user_id'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/index");
        }

        $topicRepository = new TopicRepository();

        if(!$this->isGet())
        {
            return $this->render('login');
        }

        $user = null;

        if(!empty($_GET))
        {
            $id = $_GET['id'];
            $user = $this->userRepository->getUserById($id);
        }
        else
        {
            $email = $_SESSION['user_email'];
            $user = $this->userRepository->getUserByEmail($email);
        }

        if($user==null)
        {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/profile");
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


        $details = $this->userRepository->getUsersDetails($user->getId());
        $history = $topicRepository->getUsersTopics($user->getId());

        $isMode = $_SESSION['user_role'] == 'mode';

        return $this->render('profile', (['email' => $user->getEmail(), 'id' => $user->getId(),'topics' => $history, 'role' => $user->getRole(), 'active'=>$user->isActive(), 'isMode'=>$isMode, 'ban'=>$ban]+$details));
    }

    public function banUser()
    {
        $this->checkCurrentUserActiveStatus();

        if(!$this->isPost())
        {
            $this->render('login');
        }

        if($_SESSION['user_role']!='mode') {
            echo 'failure';
            return;
        }

        $years = $_POST['years'];
        $months = $_POST['months'];
        $days = $_POST['days'];
        $id = $_POST['userId'];


        $date = date("Y-m-d");
        $newDate = date('Y-m-d',strtotime($date. (' + '.$days.' days')));
        $newDate = date('Y-m-d',strtotime($newDate. (' + '.$months.' months')));
        $newDate = date('Y-m-d',strtotime($newDate. (' + '.$years.' years')));

        $this->userRepository->setUserBanDate($id, $newDate);
        $this->userRepository->changeUserActiveStatusUsingId($id, false);

        echo 'success';
    }

    public function unbanUser()
    {
        $this->checkCurrentUserActiveStatus();

        if(!$this->isPost())
        {
            $this->render('login');
        }

        if($_SESSION['user_role']!='mode') {
            echo 'failure';
            return;
        }

        $id = $_POST['userId'];
        $this->userRepository->setUserBanDate($id, date('Y-m-d',strtotime(date("Y-m-d"). (' - 100 days'))));
        echo 'success';
    }

    public function updateLastActivity()
    {
        $this->checkCurrentUserActiveStatus();

        if(!isset($_SESSION['user_id'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/index");
        }

        if(!$this->isPost())
        {
            $this->render('login');
        }

        $id = $_SESSION['user_id'];
        $this->userRepository->updateLastActivity($id);
    }

}