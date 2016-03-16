<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-12
 * Time: 오후 12:59
 * Description; Project List when called by Client
 */
class project_list {

    private $projList;

    public function __construct() {
        $this->projList = array();
    }

    public function getDB($columnName, $valueKey) {
        require_once("../data/project.php");
        require_once("../class/db.php");

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM project_tb WHERE $columnName='$valueKey'";
        $rows = $db->select($sql);

        foreach($rows as $row) {
            $projKey = $row['projKey'];
            $projState = $row['proj_state'];
            $projPrice = $row['proj_price'];
            $projDeadLine = $row['proj_deadline'];
            $projUploadDate = $row['proj_upload'];
            $projPeriod = $row['proj_period'];
            $projName = $row['proj_nm'];
            $projDescription = $row['proj_desc'];
            $projPlanning = $row['proj_plan'];
            $projMeeting = $row['proj_meet'];

            $project = new project($projKey, $projState, $projPrice, $projDeadLine, $projUploadDate, $projPeriod, $projName, $projDescription, $projPlanning, $projMeeting);
            $project->getProjectType($projKey);

            array_push($this->projList, $project);
        }
    }

    /**
     * @return array
     */
    public function getProjList()
    {
        return $this->projList;
    }


}