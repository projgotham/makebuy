<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 12:35
 */
class fl_skill_list {

    private $skillList;

    public function __construct() {
        $this->skillList = array();
    }

    public function getDB($valueKey){
        require_once("/data/fl_skill.php");
        require_once("/class/db.php");

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM skill_tb WHERE flKey='$valueKey'";
        $rows = $db->select($sql);

        foreach($rows as $row) {
            $skillKey = $row['skillKey'];
            $flKey = $row['flKey'];
            $skillName = $row['skill_nm'];
            $skillLevel = $row['skill_lvl'];
            $skillPeriod = $row['skill_period'];

            $skill = new fl_skill($skillKey, $flKey, $skillName, $skillLevel, $skillPeriod);

            array_push($this->skillList, $skill);
        }
    }

    /**
     * @return array
     */
    public function getSkillList()
    {
        return $this->skillList;
    }


}