<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-15
 * Time: 오후 12:56
 */
class participant {

    private $flKey;
    private $projKey;
    private $bidPrice;
    private $bidDeadLine;
    private $bidContent;
    private $selectedFlag;

    /**
     * participant constructor.
     * @param $flKey
     * @param $projKey
     * @param $bidPrice
     * @param $bidDeadLine
     * @param $bidContent
     * @param $selectedFlag
     */
    public function __construct($flKey, $projKey, $bidPrice, $bidDeadLine, $bidContent, $selectedFlag)
    {
        $this->flKey = $flKey;
        $this->projKey = $projKey;
        $this->bidPrice = $bidPrice;
        $this->bidDeadLine = $bidDeadLine;
        $this->bidContent = $bidContent;
        $this->selectedFlag = $selectedFlag;
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
    public function getBidPrice()
    {
        return $this->bidPrice;
    }

    /**
     * @return mixed
     */
    public function getBidDeadLine()
    {
        return $this->bidDeadLine;
    }

    /**
     * @return mixed
     */
    public function getBidContent()
    {
        return $this->bidContent;
    }

    /**
     * @return mixed
     */
    public function getSelectedFlag()
    {
        return $this->selectedFlag;
    }


}