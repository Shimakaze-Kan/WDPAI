<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Data.php';
class GetAjaxTextController extends AppController
{
    private $dataModel;

    public function returnConfirm()
    {
        if(!$this->isPost())
        {
            return $this->render('tea');
        }

        $value = $_POST['value'];

        if($value=='')
        {
            echo 'failure';
            return;
        }


        $this->dataModel = new Data($value);

        $this->writeData($this->dataModel->getData());
        echo 'success';
    }

    function writeData(string $data)
    {
        $myfile = fopen("public/json/newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $data);
        fclose($myfile);
    }

}