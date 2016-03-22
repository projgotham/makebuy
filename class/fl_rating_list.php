<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 12:35
 */
class fl_rating_list {

    private $ratingList;

    /**
     * fl_rating_list constructor.
     * @param $ratingList
     */
    public function __construct()
    {
        $this->ratingList = array();
    }

    public function getDB($valueKey){
        require_once("/data/fl_rate.php");
        require_once("/class/db.php");

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM freelancer_rate_tb WHERE flKey='$valueKey'";
        $rows = $db->select($sql);

        foreach($rows as $row) {
            $flRateKey = $row['flRateKey'];
            $flKey = $row['flKey'];
            $projKey = $row['projKey'];
            $isProfessional = $row['r_prof'];
            $isCommunicate = $row['r_comm'];
            $isTime = $row['r_time'];
            $isPassion = $row['r_passion'];
            $isWorkAgain = $row['r_again'];
            $rateDate = $row['r_date'];

            $rate = new fl_rate($flRateKey, $flKey, $projKey, $isProfessional, $isCommunicate, $isTime, $isPassion, $isWorkAgain, $rateDate);

            array_push($this->ratingList, $rate);
        }
    }

    /**
     * @return array
     */
    public function getRatingList()
    {
        return $this->ratingList;
    }

}