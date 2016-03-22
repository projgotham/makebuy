<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-12
 * Time: 오후 3:19
 */
class project_type_list {

    private $projTypeList;
    /**
     * project_type_list constructor.
     */
    public function __construct() {
        $this->projTypeList = array();
    }

    public function getDB($projectKey) {
        require_once('/class/db.php');
        require_once('/data/project_type.php');

        $db = new db();
        $db->connect();
        $query = "SELECT * FROM project_type_tb WHERE projKey='$projectKey'";
        $rows = $db->select($query);

        if($rows != null){
            foreach($rows as $row){
                $key = $row['projKey'];
                $name= $row['proj_type'];
                $projectType = new project_type($key, $name);
                array_push($projTypeList, $projectType);
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