<?php

/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-05-15
 * Time: 오후 4:10
 */
class comment_list
{
    private $commentList;

    /**
     * comment_list constructor.
     * @param $commentList
     */
    public function __construct($commentList)
    {
        $this->commentList = array();
    }

    public function getSelectedDB($projKey) {
        require_once(__DIR__."/../data/comment.php");
        require_once(__DIR__."/../class/db.php");

        $db = new db();
        $db->connect();
        $query = "SELECT * FROM comment_tb WHERE projKey = '".$projKey."' ORDER BY oCommKey, commentKey";
        $rows = $db->select($query);

        if($rows != null) {
            foreach($rows as $row) {
                $commentKey = $row['commentKey'];
                $oCommKey = $row['oCommKey'];
                $c_content = $row['c_content'];
                $c_writerKey = $row['c_writerKey'];
                $c_date = $row['c_date'];
                $c_private = $row['c_private'];

                $comment = new comment($commentKey, $projKey, $oCommKey, $c_content, $c_writerKey, $c_date, $c_private);
                array_push($this->commentList, $comment);
            }
        }
    }

    /**
     * @return array
     */
    public function getCommentList()
    {
        return $this->commentList;
    }

    

}