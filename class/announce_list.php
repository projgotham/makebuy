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
        require_once('../class/db.php');
        require_once('../data/project_type.php');

        $db = new db();
        $db->connect();
        $query = "SELECT * FROM announce_tb";
        $rows = $db->select($query);

        if($rows != null){
            foreach($rows as $row){
                $key = $row['announceKey'];
                $topic= $row['an_topic'];
                $date= $row['an_date'];
                $author= $row['an_author'];
                $content= $row['an_content'];
                $projectType = new project_type($key, $name);
                array_push($announceList, $projectType);
            }
        }

    }

    /**
     * @return mixed
     */
    public function getProjTypeList()
    {
        return $this->projTypeList;
    }

}