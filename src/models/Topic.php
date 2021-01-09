<?php


class Topic
{
    private $title;
    private $imgUrl;
    private $like;
    private $id;


    public function __construct($title, $imgUrl, $like=0, $dislike=0)
    {
        $this->title = $title;
        $this->imgUrl = $imgUrl;
        $this->like = $like;
        $this->dislike = $dislike;
    }

    public function getLike()
    {
        return $this->like;
    }

    public function setLike($like): void
    {
        $this->like = $like;
    }

    public function getDislike()
    {
        return $this->dislike;
    }

    public function setDislike($dislike): void
    {
        $this->dislike = $dislike;
    }
    private $dislike;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}