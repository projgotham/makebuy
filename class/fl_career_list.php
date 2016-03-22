<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 12:35
 */
class fl_career_list {

    private $careerList;

    /**
     * fl_rating_list constructor.
     * @param $ratingList
     */
    public function __construct()
    {
        $this->careerList = array();
    }

    public function getDB($valueKey){
        require_once("/data/fl_career.php");
        require_once("/class/db.php");

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM career_tb WHERE flKey='$valueKey'";
        $rows = $db->select($sql);

        foreach($rows as $row) {
            $careerKey = $row['careerKey'];
            $flKey = $row['flKey'];
            $careerName = $row['carr_nm'];
            $careerPeriod = $row['carr_period'];
            $careerType = $row['carr_type'];

            $career = new fl_career($careerKey, $flKey, $careerName, $careerPeriod, $careerType);

            array_push($this->careerList, $career);
        }
    }

    /**
     * @return array
     */
    public function getCareerList()
    {
        return $this->careerList;
    }

}