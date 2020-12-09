<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Data.php';
class GetTextController extends AppController
{
    private $dataModel;

    public function tea()
    {
        if(!$this->isPost())
        {
            return $this->render('tea');
        }

        $value = $_POST['value'];


        $this->dataModel = new Data($value);

        if($this->dataModel->getData()=='')
        {
            return $this->render('tea', ['messages' => ['failure']]);
        }

        $this->writeData($this->dataModel->getData());

        return $this->render('tea', ['messages' => ['success']]);
    }

    function writeData(string $data)
    {
        $myfile = fopen("public/json/newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $data);
        fclose($myfile);
    }

}