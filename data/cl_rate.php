<?php

/**
 * Created by PhpStorm.
 * User: projg
 * Date: 2016-03-16
 * Time: 오후 3:41
 */
class cl_rate {

    private $clientRateKey;
    private $clientKey;
    private $projKey;

    // Rate Conditions
    private $r_accuracy;
    private $r_comm;
    private $r_pay;
    private $r_manage;

    private $r_date;

    /**
     * cl_rating constructor.
     * @param $clientRateKey
     * @param $clientKey
     * @param $projKey
     * @param $r_accuracy
     * @param $r_comm
     * @param $r_pay
     * @param $r_manage
     * @param $r_date
     */
    public function __construct($clientRateKey, $clientKey, $projKey, $r_accuracy, $r_comm, $r_pay, $r_manage, $r_date)
    {
        $this->clientRateKey = $clientRateKey;
        $this->clientKey = $clientKey;
        $this->projKey = $projKey;
        $this->r_accuracy = $r_accuracy;
        $this->r_comm = $r_comm;
        $this->r_pay = $r_pay;
        $this->r_manage = $r_manage;
        $this->r_date = $r_date;
    }

    /**
     * @return mixed
     */
    public function getClientRateKey()
    {
        return $this->clientRateKey;
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
    public function getProjKey()
    {
        return $this->projKey;
    }

    /**
     * @return mixed
     */
    public function getRAccuracy()
    {
        return $this->r_accuracy;
    }

    /**
     * @return mixed
     */
    public function getRComm()
    {
        return $this->r_comm;
    }

    /**
     * @return mixed
     */
    public function getRPay()
    {
        return $this->r_pay;
    }

    /**
     * @return mixed
     */
    public function getRManage()
    {
        return $this->r_manage;
    }

    /**
     * @return mixed
     */
    public function getRDate()
    {
        return $this->r_date;
    }



}