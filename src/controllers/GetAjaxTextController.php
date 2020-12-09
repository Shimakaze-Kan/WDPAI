<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Data.php';
require_once __DIR__.'/../repository/TeaRepository.php';
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

        $teaRepository = new TeaRepository();
        $result = $teaRepository->updateRecord($this->dataModel->getData()[0],$this->dataModel->getData()[1]);

        if($result==false)
        {
            echo 'failure';
            return;
        }
        //$this->writeData($this->dataModel->getData()[0]);

        echo 'success';
    }

    public function getCountriesData()
    {
        if(!$this->isPost())
        {
            return $this->render('tea');
        }

        $teaRepository = new TeaRepository();
        $result = $teaRepository->getData();

        if($result==false)
        {
            echo 'failure';
            return;
        }

        echo json_encode($result);
        /*echo var_dump($result);
        foreach ($result as $key => $value)
        {
            echo $key." ".$value."\n";
        }*/
    }

    function writeData(string $data)
    {
        $myfile = fopen("public/json/newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $data);
        fclose($myfile);
    }

}