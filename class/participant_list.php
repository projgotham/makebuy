<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-15
 * Time: 오후 12:19
 * Description: Project List when called by Freelancer
 */
class participant_list{

    private $partList;

    public function __construct() {
    }

    public function getDB($columnName, $valueKey){
        require_once(__DIR__."/../data/participant.php");
        require_once(__DIR__."/../class/db.php");

        $this->partList = array();

        $db = new db();
        $db->connect();
        // Change SQL Query: $sql = "SELECT * FROM project_tb WHERE (participant_tb.flKey='$flKey' AND participant_tb.projKey=project_tb.projKey)";
        $sql = "SELECT * FROM participant_tb WHERE $columnName='$valueKey'";
        $rows = $db->select($sql);

        foreach($rows as $row) {
            $flKey = $row['flKey'];
            $projKey = $row['projKey'];
            $bidPrice = $row['b_price'];
            $bidDeadLine = $row['b_deadline'];
            $bidContent = $row['b_content'];
            $selectedFlag = $row['b_flag'];

            $participant = new participant($flKey, $projKey, $bidPrice, $bidDeadLine, $bidContent, $selectedFlag);
            array_push($this->partList, $participant);
        }
    }

    public function getSelectedDB($columnName, $valueKey, $selectedKey){
        require_once(__DIR__."/../data/participant.php");
        require_once(__DIR__."/../class/db.php");

        $this->partList = array();

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM participant_tb WHERE ($columnName='$valueKey' AND b_flag=$selectedKey)";
        $rows = $db->select($sql);

        foreach($rows as $row) {
            $flKey = $row['flKey'];
            $projKey = $row['projKey'];
            $bidPrice = $row['b_price'];
            $bidDeadLine = $row['b_deadline'];
            $bidContent = $row['b_content'];
            $selectedFlag = $row['b_flag'];

            $participant = new participant($flKey, $projKey, $bidPrice, $bidDeadLine, $bidContent, $selectedFlag);
            array_push($this->partList, $participant);
        }
    }

    /**
     * @return array
     */
    public function getPartList()
    {
        return $this->partList;
    }

}