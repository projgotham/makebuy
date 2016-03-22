<?php

/**
 * Created by PhpStorm.
 * User: Junho
 * Date: 2016-03-01
 * Time: 오후 5:31
 */
class announce_list
{
    private $announceList;

    /**
     * announce_list constructor.
     */
    public function __construct() {
        $this->announceList = array();
    }

    public function getDB() {
        require_once "class/db.php";
        //require_once('./db.php');
        require_once "data/announce.php";
        //require_once('../data/announce.php');

        $db = new db();
        $db->connect();
        $query = "SELECT * FROM announce_tb order by announceKey DESC ";
        $rows = $db->select($query);

        if($rows != null){
            foreach($rows as $row){
                $key = $row['announceKey'];
                $topic= $row['an_topic'];
                $date= $row['an_date'];
                $content= $row['an_content'];
                $announce = new announce($key, $topic, $date, $content);
                array_push($this->announceList, $announce);
            }
        }

    }

    public function getSelectedDB($id) {
        require_once "class/db.php";
        require_once "data/announce.php";

        $db = new db();
        $db->connect();
        $query = "SELECT * FROM announce_tb WHERE announceKey='$id' ";
        $row = $db->select($query);

        if($row != null){
                $key = $row[0]['announceKey'];
                $topic= $row[0]['an_topic'];
                $date= $row[0]['an_date'];
                $content= $row[0]['an_content'];
                $announce = new announce($key, $topic, $date, $content);
                array_push($this->announceList, $announce);
        }

    }


    /**
     * @return mixed
     */
    public function getAnnounceList()
    {
        return $this->announceList;
    }

}