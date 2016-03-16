<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 12:35
 */
class fl_portfolio_list {

    private $portfolioList;

    /**
     * fl_rating_list constructor.
     * @param $ratingList
     */
    public function __construct()
    {
        $this->portfolioList = array();
    }

    public function getDB($valueKey){
        require_once("../data/fl_portfolio.php");
        require_once("../class/db.php");

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM portfolio_tb WHERE flKey='$valueKey'";
        $rows = $db->select($sql);

        foreach($rows as $row) {
            $portKey = $row['portKey'];
            $flKey = $row['flkey'];
            $portName = $row['port_nm'];
            $portType = $row['port_type'];
            $portImage = $row['port_im'];

            $portfolio = new fl_rate($portKey, $flKey, $portName, $portType, $portImage);

            array_push($this->portfolioList, $portfolio);
        }
    }

    /**
     * @return array
     */
    public function getPortfolioList()
    {
        return $this->portfolioList;
    }



}