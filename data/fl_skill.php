<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 12:15
 */
class fl_skill {

    private $skillKey;
    private $flKey;
    private $skill_nm;
    private $skill_lvl;
    private $skill_period;

    /**
     * fl_skill constructor.
     * @param $skillKey
     * @param $flKey
     * @param $skill_nm
     * @param $skill_lvl
     * @param $skill_period
     */
    public function __construct($skillKey, $flKey, $skill_nm, $skill_lvl, $skill_period)
    {
        $this->skillKey = $skillKey;
        $this->flKey = $flKey;
        $this->skill_nm = $skill_nm;
        $this->skill_lvl = $skill_lvl;
        $this->skill_period = $skill_period;
    }

    /**
     * @return mixed
     */
    public function getSkillKey()
    {
        return $this->skillKey;
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
    public function getSkillNm()
    {
        return $this->skill_nm;
    }

    /**
     * @return mixed
     */
    public function getSkillLvl()
    {
        return $this->skill_lvl;
    }

    /**
     * @return mixed
     */
    public function getSkillPeriod()
    {
        return $this->skill_period;
    }


}