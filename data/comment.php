<?php

/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-05-15
 * Time: 오후 4:11
 */
class comment
{
    private $commentKey;
    private $projKey;
    private $oCommKey;
    private $c_content;
    private $c_writerKey;
    private $c_date;
    private $c_private;

    /**
     * comment constructor.
     * @param $commentKey
     * @param $projKey
     * @param $oCommKey
     * @param $c_content
     * @param $c_writerKey
     * @param $c_date
     * @param $c_private
     */
    public function __construct($commentKey, $projKey, $oCommKey, $c_content, $c_writerKey, $c_date, $c_private)
    {
        $this->commentKey = $commentKey;
        $this->projKey = $projKey;
        $this->oCommKey = $oCommKey;
        $this->c_content = $c_content;
        $this->c_writerKey = $c_writerKey;
        $this->c_date = $c_date;
        $this->c_private = $c_private;
    }

    /**
     * @return mixed
     */
    public function getCommentKey()
    {
        return $this->commentKey;
    }

    /**
     * @return mixed
     */
    public function getProjKey()
    {
        return $this->projKey;
    }

    /**
     * @return mixed
     */
    public function getOCommKey()
    {
        return $this->oCommKey;
    }

    /**
     * @return mixed
     */
    public function getCContent()
    {
        return $this->c_content;
    }

    /**
     * @return mixed
     */
    public function getCWriterKey()
    {
        return $this->c_writerKey;
    }

    /**
     * @return mixed
     */
    public function getCDate()
    {
        return $this->c_date;
    }

    /**
     * @return mixed
     */
    public function getCPrivate()
    {
        return $this->c_private;
    }

    


}