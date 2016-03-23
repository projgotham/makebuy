<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 12:14
 */
class fl_portfolio {
    private $portKey;
    private $flKey;
    private $port_nm;
    private $port_explain;
    private $port_im;

    /**
     * fl_portfolio constructor.
     * @param $portKey
     * @param $flKey
     * @param $port_nm
     * @param $port_explain
     * @param $port_im
     */
    public function __construct($portKey, $flKey, $port_nm, $port_explain, $port_im)
    {
        $this->portKey = $portKey;
        $this->flKey = $flKey;
        $this->port_nm = $port_nm;
        $this->port_explain = $port_explain;
        $this->port_im = $port_im;
    }

    /**
     * @return mixed
     */
    public function getPortKey()
    {
        return $this->portKey;
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
    public function getPortNm()
    {
        return $this->port_nm;
    }

    /**
     * @return mixed
     */
    public function getPortExplain()
    {
        return $this->port_explain;
    }

    /**
     * @return mixed
     */
    public function getPortIm()
    {
        return $this->port_im;
    }

}