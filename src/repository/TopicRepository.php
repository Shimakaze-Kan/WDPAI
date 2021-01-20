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

    public function getTopicByName(string $title): ?Topic
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.topics WHERE title = :title
        ');

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
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

    public function getFeaturedTopics()
    {
        $stmt = $this->database->connect()->prepare('
            select * from featured_topics_view
        ');

        $state = $stmt->execute();

        if($state == false)
        {
            return false;
        }

        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $topic = new Topic(
                $row['title'],
                $row['img_url'],
                $row['like'],
                $row['dislike']
            );

            $topic->setId($row['id']);
            $rows[] = $topic;
        }

        return $rows;
    }

    public function getUsersTopics(int $userId)
    {
        $stmt = $this->database->connect()->prepare('
        SELECT title, created_at, id FROM public.topics WHERE id_assigned_by=:userId ORDER BY created_at DESC
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

    public function updateTopicDetail(string $id, string $value, int $topicId)
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

        return $result;
    }

    public function getTopicDetails(int $topicId)
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
            $tmp[$row['country_code']] = $row['value'];
            $rows = $rows + $tmp;
        }

        return $rows;
    }

    public function rateTopic(int $id, string $action = 'like')
    {
        $stmt = null;

        if($action == 'like') {
            $stmt = $this->database->connect()->prepare('
                update topics set "like" = "like" + 1 where id = :id
            ');
        }
        else {
            $stmt = $this->database->connect()->prepare('
                update topics set dislike = dislike + 1 where id = :id
            ');
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}