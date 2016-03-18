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
    private $clientKey;
    private $projState;
    private $projExpPrice;
    private $projActPrice;
    private $projDeadLine;
    private $projUploadDate;
    private $projFinishDate;
    private $projExpPeriod;
    private $projActPeriod;
    private $projName;
    private $projDescription;
    private $projPlanning;
    private $projMeeting;
    private $projSourceCode;

    // Project Type List
    private $projTypes;

    // Project Participant List
    private $participantList;

    /**
     * project constructor.
     * @param $projKey
     * @param $projState
     * @param $projExpPrice
     * @param $projActPrice
     * @param $projDeadLine
     * @param $projUploadDate
     * @param $projFinishDate
     * @param $projExpPeriod
     * @param $projActPeriod
     * @param $projName
     * @param $projDescription
     * @param $projPlanning
     * @param $projMeeting
     * @param $projSourceCode
     * @param $projTypes
     * @param $participantList
     */
    public function __construct($projKey, $clientKey, $projState, $projExpPrice, $projActPrice, $projDeadLine, $projUploadDate, $projFinishDate, $projExpPeriod, $projActPeriod, $projName, $projDescription, $projPlanning, $projMeeting, $projSourceCode, $projTypes, $participantList)
    {
        $this->projKey = $projKey;
        $this->clientKey = $clientKey;
        $this->projState = $projState;
        $this->projExpPrice = $projExpPrice;
        $this->projActPrice = $projActPrice;
        $this->projDeadLine = $projDeadLine;
        $this->projUploadDate = $projUploadDate;
        $this->projFinishDate = $projFinishDate;
        $this->projExpPeriod = $projExpPeriod;
        $this->projActPeriod = $projActPeriod;
        $this->projName = $projName;
        $this->projDescription = $projDescription;
        $this->projPlanning = $projPlanning;
        $this->projMeeting = $projMeeting;
        $this->projSourceCode = $projSourceCode;

        $this->projTypes = array();
        $this->participantList = array();
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

    public function getParticipantList($projKey){
        require_once("../class/participant_list.php");

        $participantList = new participant_list();
        $participantList->getDB("projKey", $projKey);
        $this->participantList = $participantList->getPartList();
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
    public function getClientKey()
    {
        return $this->clientKey;
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
    public function getProjExpPrice()
    {
        return $this->projExpPrice;
    }

    /**
     * @return mixed
     */
    public function getProjActPrice()
    {
        return $this->projActPrice;
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
    public function getProjFinishDate()
    {
        return $this->projFinishDate;
    }

    /**
     * @return mixed
     */
    public function getProjExpPeriod()
    {
        return $this->projExpPeriod;
    }

    /**
     * @return mixed
     */
    public function getProjActPeriod()
    {
        return $this->projActPeriod;
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
    public function getProjSourceCode()
    {
        return $this->projSourceCode;
    }

    /**
     * @return array
     */
    public function getProjTypes()
    {
        return $this->projTypes;
    }


}