<?php

require_once 'AppController.php';
class TopicController extends AppController
{
    public function addTopic()
    {
        if(!$this->isPost())
        {
            return $this->render('add');
        }

        $url = $_POST['url'];

        if(strlen($url)>255)
        {
            echo 'failure';
            return;
        }

        $this->writeData($url);

        echo 'success';
    }

    function writeData(string $data)
    {
        $myfile = fopen("public/uploads/newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $data);
        fclose($myfile);
    }
}