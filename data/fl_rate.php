<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 12:16
 */
class fl_rate {

    private $flRateKey;
    private $flKey;
    private $projKey;

    // Rate Conditions
    private $isProfessional;
    private $isCommunicate;
    private $isTime;
    private $isPassion;
    private $isWorkAgain;

    private $rateDate;

    /**
     * fl_rate constructor.
     * @param $flRateKey
     * @param $flKey
     * @param $projKey
     * @param $isProfessional
     * @param $isCommunicate
     * @param $isTime
     * @param $isPassion
     * @param $isWorkAgain
     */
    public function __construct($flRateKey, $flKey, $projKey, $isProfessional, $isCommunicate, $isTime, $isPassion, $isWorkAgain, $rateDate)
    {
        $this->flRateKey = $flRateKey;
        $this->flKey = $flKey;
        $this->projKey = $projKey;
        $this->isProfessional = $isProfessional;
        $this->isCommunicate = $isCommunicate;
        $this->isTime = $isTime;
        $this->isPassion = $isPassion;
        $this->isWorkAgain = $isWorkAgain;
        $this->rateDate = $rateDate;
    }

    /**
     * @return mixed
     */
    public function getFlRateKey()
    {
        return $this->flRateKey;
    }

    /**
     * @return mixed
     */
    public function getFlKey()
    {
        return $this->flKey;
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
    public function getIsProfessional()
    {
        return $this->isProfessional;
    }

    /**
     * @return mixed
     */
    public function getIsCommunicate()
    {
        return $this->isCommunicate;
    }

    /**
     * @return mixed
     */
    public function getIsTime()
    {
        return $this->isTime;
    }

    /**
     * @return mixed
     */
    public function getIsPassion()
    {
        return $this->isPassion;
    }

    /**
     * @return mixed
     */
    public function getIsWorkAgain()
    {
        return $this->isWorkAgain;
    }

    /**
     * @return mixed
     */
    public function getRateDate()
    {
        return $this->rateDate;
    }




}