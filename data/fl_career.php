<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 12:15
 */
class fl_career {
    private $careerKey;
    private $flKey;
    private $carr_nm;
    private $carr_period;
    private $carr_type;

    /**
     * fl_career constructor.
     * @param $careerKey
     * @param $flKey
     * @param $carr_nm
     * @param $carr_period
     * @param $carr_type
     */
    public function __construct($careerKey, $flKey, $carr_nm, $carr_period, $carr_type)
    {
        $this->careerKey = $careerKey;
        $this->flKey = $flKey;
        $this->carr_nm = $carr_nm;
        $this->carr_period = $carr_period;
        $this->carr_type = $carr_type;
    }

    /**
     * @return mixed
     */
    public function getCareerKey()
    {
        return $this->careerKey;
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
    public function getCarrNm()
    {
        return $this->carr_nm;
    }

    /**
     * @return mixed
     */
    public function getCarrPeriod()
    {
        return $this->carr_period;
    }

    /**
     * @return mixed
     */
    public function getCarrType()
    {
        return $this->carr_type;
    }

}