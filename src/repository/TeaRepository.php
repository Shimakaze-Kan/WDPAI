<?php

require_once "Repository.php";
require_once __DIR__."/../models/Data.php";
class TeaRepository extends Repository
{

    public function updateRecord(string $id, string $value, int $topicId)
    {
        $date = new DateTime();

        $stmt = $this->database->connect()->prepare('
            SELECT 1 FROM public.topics_details
            where topic_id=(select id_topic_details from topics where id=:topic_id) 
            and country_code=:country_code
        ');

        $stmt->bindParam(':topic_id', $topicId, PDO::PARAM_INT);
        $stmt->bindParam(':country_code', $id, PDO::PARAM_STR);
        $stmt->execute();

        $result = false;

        if($stmt->rowCount()>0) {

            $stmt = $this->database->connect()->prepare('
            UPDATE public.topics_details SET country_code=?, value=?, modified_at=?
            where topic_id=(select id_topic_details from topics where id=?) and country_code=?
        ');

            $result = $stmt->execute([
                    $id,
                    $value,
                    $date->format("Y-m-d H:i:s"),
                    $topicId,
                    $id
                ]);
        }
        else
        {
            $stmt = $this->database->connect()->prepare('
                SELECT id_topic_details FROM public.topics
                WHERE id=:id
            ');
            $stmt->bindParam(':id',$topicId,PDO::PARAM_INT);

            $stmt->execute();
            $topic_details = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_topic_details = $topic_details['id_topic_details'];

            $stmt = $this->database->connect()->prepare('
                INSERT INTO public.topics_details (country_code, value, modified_at, topic_id) 
                VALUES (?,?,?,?)
            ');

            $result = $stmt->execute([
               $id,
               $value,
                $date->format("Y-m-d H:i:s"),
                $id_topic_details
            ]);
        }
        //$user = $stmt->fetch(PDO::FETCH_ASSOC);


        return $result;
    }

    public function getData(int $topicId)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.topics_details
            where topic_id=(select id_topic_details from topics where id=:id)
        ');

        $stmt->bindParam(':id', $topicId, PDO::PARAM_INT);
        $state = $stmt->execute();

        if($state == false)
        {
            return false;
        }

        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //array_push($rows,$row);
            $tmp[$row['country_code']] = $row['value'];
            $rows = $rows + $tmp;
        }
        //$result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rows;
    }


}