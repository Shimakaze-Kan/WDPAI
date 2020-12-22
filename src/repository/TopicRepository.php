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
            INSERT INTO topics (title, img_url, id_assigned_by, created_at) 
            VALUES (?,?,?,?)
        ');

        $assigned_by = $_SESSION['user_id'];

        $stmt->execute([
          $topic->getTitle(),
          $topic->getImgUrl(),
            $assigned_by,
            $date->format('Y-m-d')
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

    public function getUsersTopics(int $userId)
    {
        $stmt = $this->database->connect()->prepare('
        SELECT title, created_at, id FROM public.topics WHERE id_assigned_by=:userId
        ');

        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($rows, ['title' => $row['title'], 'date' => $row['created_at'], 'topicId' => $row['id']]);
        }

        return $rows;
    }

    public function getAllTopic()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT id, title, img_url, "like", dislike, created_at, email, user_role, user_id FROM all_topics_view
        ');

        $stmt->execute();

        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($rows, ['title' => $row['title'], 'date' => $row['created_at'], 'topicId' => $row['id'],
                'like'=>$row['like'], 'dislike'=>$row['dislike'], 'author'=>$row['email'], 'img_url'=>$row['img_url'],
                'user_role'=>$row['user_role'], 'user_id'=>$row['user_id']]);
        }

        return $rows;
    }

    public  function deleteTopic($id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT delete_topic(:id);
        ');
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);

        $result = $stmt->execute();

        return $result;
    }

}