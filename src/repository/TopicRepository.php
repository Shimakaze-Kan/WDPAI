<?php

require_once "Repository.php";
require_once __DIR__."/../models/Topic.php";

class TopicRepository extends Repository
{
    public function getTopic(int $id): ?Topic
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.topics WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
        $topic = $stmt->fetch(PDO::FETCH_ASSOC);


        if($topic == false)
        {
            return null;
        }

        return new Topic(
            $topic['title'],
            $topic['img_url'],
            $topic['like'],
            $topic['dislike']
        );
    }

    public function addTopic(Topic $topic): void
    {
        $date = new DateTime();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO topics (title, img_url, id_assigned_by, created_at, id_topic_details) 
            VALUES (?,?,?,?,?)
        ');

        $assigned_by = 1;
        $id_topic_details = 2;

        $stmt->execute([
          $topic->getTitle(),
          $topic->getImgUrl(),
            $assigned_by,
            $date->format('Y-m-d'),
            $id_topic_details
        ]);
    }

    public function getFeaturedTopicsIds()
    {
        $stmt = $this->database->connect()->prepare('
            select id from topics order by (dislike-"like") limit 4
        ');

        $state = $stmt->execute();

        if($state == false)
        {
            return false;
        }

        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($rows, $row['id']);
        }

        return $rows;
    }

}