<?php

/**
 * Created by PhpStorm.
 * User: Junho
 * Date: 2016-02-07
 * Time: 오후 6:17
 * check when refactoring
 */
class project
{

    private $projKey;
    private $projState;
    private $projPrice;
    private $projDeadLine;
    private $projUploadDate;
    private $projPeriod;
    private $projName;
    private $projDescription;
    private $projPlanning;
    private $projMeeting;
    // Project Type List
    private $projTypes;

    public function __construct($projKey, $projState, $projPrice, $projDeadLine, $projUploadDate, $projPeriod, $projName, $projDescription, $projPlanning, $projMeeting) {
        $this->projKey = $projKey;
        $this->projState = $projState;
        $this->projPrice = $projPrice;
        $this->projDeadLine = $projDeadLine;
        $this->projUploadDate = $projUploadDate;
        $this->projPeriod = $projPeriod;
        $this->projName = $projName;
        $this->projDescription = $projDescription;
        $this->projPlanning = $projPlanning;
        $this->projMeeting = $projMeeting;

        $this->projTypes = array();
    }

    // Below was annotated because direct access to the data class itself can be harmful
    // Do not unlock unless there is a specific method of using it
    // 2016-02-16 MinGu Lee
    /*
    public function getDB($projKey){
        require_once("../class/db.php");

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM project_tb WHERE projKey='$projKey'";
        $row = $db->select($sql);

        if ($row != null) {
            $this->projKey = $row['projKey'];
            $this->projState = $row['proj_state'];
            $this->projPrice = $row['proj_price'];
            $this->projDeadLine = $row['proj_deadline'];
            $this->projUploadDate = $row['proj_upload'];
            $this->projPeriod = $row['proj_period'];
            $this->projName = $row['proj_nm'];
            $this->projDescription = $row['proj_desc'];
            $this->projPlanning = $row['proj_plan'];
            $this->projMeeting = $row['proj_meet'];

            $this->getProjectType($projKey);
        }
    }
    */
    public function getProjectType($projKey){
        require_once("../class/project_type_list.php");

        $projTypeList = new project_type_list();
        $projTypeList->getDB($projKey);
        $this->projTypes = $projTypeList->getProjTypeList();
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
    public function getProjState()
    {
        return $this->projState;
    }

    /**
     * @return mixed
     */
    public function getProjPrice()
    {
        return $this->projPrice;
    }

    /**
     * @return mixed
     */
    public function getProjDeadLine()
    {
        return $this->projDeadLine;
    }

    /**
     * @return mixed
     */
    public function getProjUploadDate()
    {
        return $this->projUploadDate;
    }

    /**
     * @return mixed
     */
    public function getProjPeriod()
    {
        return $this->projPeriod;
    }

    /**
     * @return mixed
     */
    public function getProjName()
    {
        return $this->projName;
    }

    /**
     * @return mixed
     */
    public function getProjDescription()
    {
        return $this->projDescription;
    }

    /**
     * @return mixed
     */
    public function getProjPlanning()
    {
        return $this->projPlanning;
    }

    /**
     * @return mixed
     */
    public function getProjMeeting()
    {
        return $this->projMeeting;
    }

    /**
     * @return mixed
     */
    public function getProjTypes()
    {
        return $this->projTypes;
    }


}