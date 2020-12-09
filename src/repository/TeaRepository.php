<?php

require_once "Repository.php";
require_once __DIR__."/../models/Data.php";
class TeaRepository extends Repository
{
    public function updateRecord(string $id, string $value)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.tea SET value=:value WHERE id=:id
        ');

        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        $result = $stmt->execute();
        //$user = $stmt->fetch(PDO::FETCH_ASSOC);


        return $result;
    }

    public function getData()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.tea
        ');

        $state = $stmt->execute();

        if($state == false)
        {
            return false;
        }

        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //array_push($rows,$row);
            $tmp[$row['id']] = $row['value'];
            $rows = $rows + $tmp;
        }
        //$result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rows;
    }


}