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
        require_once(__DIR__."/../data/fl_portfolio.php");
        require_once(__DIR__."/../class/db.php");

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM portfolio_tb WHERE flKey='$valueKey'";
        $rows = $db->select($sql);

        foreach($rows as $row) {
            $portKey = $row['portKey'];
            $flKey = $row['flkey'];
            $portName = $row['port_nm'];
            $port_explain = $row['port_explain'];
            $portImage = $row['port_im'];

            $portfolio = new fl_portfolio($portKey, $flKey, $portName, $port_explain, $portImage);

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