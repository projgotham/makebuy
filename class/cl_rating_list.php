<?php

/**
 * Created by PhpStorm.
 * User: projg
 * Date: 2016-03-16
 * Time: 오후 3:40
 */
class cl_rating_list {

    private $ratingList;

    /**
     * cl_rating_list constructor.
     * @param $ratingList
     */
    public function __construct($ratingList)
    {
        $this->ratingList = array();
    }

    public function getDB($valueKey){
        require_once("../data/cl_rate.php");
        require_once("../class/db.php");

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM client_rate_tb WHERE clKey='$valueKey'";
        $rows = $db->select($sql);

        foreach($rows as $row){
            $clientRateKey = $row['clientRateKey'];
            $clientKey = $row['clientKey'];
            $projKey = $row['projKey'];
            $r_accuracy = $row['r_accuracy'];
            $r_comm = $row['r_comm'];
            $r_pay = $row['r_pay'];
            $r_manage = $row['r_manage'];
            $r_again = $row['r_again'];
            $rateDate = $row['r_date'];

            $rate = new cl_rate($clientRateKey, $clientKey, $projKey, $r_accuracy, $r_comm, $r_pay, $r_manage, $r_again, $rateDate);

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