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
            $clientKey = $row['clientKey'];
            $projState = $row['proj_state'];
            $projExpPrice = $row['proj_exp_price'];
            $projActPrice = $row['proj_act_price'];
            $projDeadLine = $row['proj_deadline'];
            $projUploadDate = $row['proj_upload'];
            $projFinishDate = $row['proj_finish'];
            $projExpPeriod = $row['proj_exp_period'];
            $projActPeriod = $row['proj_act_period'];
            $projName = $row['proj_nm'];
            $projDescription = $row['proj_desc'];
            $projPlanning = $row['proj_plan'];
            $projMeeting = $row['proj_meet'];

            $project = new project($projKey, $clientKey, $projState, $projExpPrice, $projActPrice, $projDeadLine, $projUploadDate, $projFinishDate, $projExpPeriod, $projActPeriod, $projName, $projDescription, $projPlanning, $projMeeting);
            $project->getProjectType($projKey);
            $project->getParticipantList($projKey);

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