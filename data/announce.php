<?php
/**
 * Created by PhpStorm.
 * User: Junho
 * Date: 2016-03-01
 * Time: 오후 5:34
 */

class announce {

    private $key;
    private $topic;
    private $date;
    private $content;

    public function __construct ($key, $topic, $date, $content){
        $this->key = $key;
        $this->topic = $topic;
        $this->date = $date;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }




}