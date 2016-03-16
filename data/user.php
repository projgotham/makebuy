<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 2:14
 */
class user {

    private $userKey;
    private $userPhone;
    private $userEmail;
    private $userImage;
    private $userType;
    private $userLoginMethod;
    private $userLast;
    private $userActive;
    private $userDesc;

    /**
     * user constructor.
     * @param $userKey
     * @param $userId
     * @param $userPhone
     * @param $userEmail
     * @param $userImage
     * @param $userType
     * @param $userLoginMethod
     */
    public function __construct($userKey, $userPhone, $userEmail, $userImage, $userType, $userLoginMethod, $userLast, $userActive, $userDesc)
    {
        $this->userKey = $userKey;
        $this->userPhone = $userPhone;
        $this->userEmail = $userEmail;
        $this->userImage = $userImage;
        $this->userType = $userType;
        $this->userLoginMethod = $userLoginMethod;
        $this->userLast = $userLast;
        $this->userActive = $userActive;
        $this->userDesc = $userDesc;
    }

    /**
     * @return mixed
     */
    public function getUserKey()
    {
        return $this->userKey;
    }

    /**
     * @return mixed
     */
    public function getUserPhone()
    {
        return $this->userPhone;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @return mixed
     */
    public function getUserImage()
    {
        return $this->userImage;
    }

    /**
     * @return mixed
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @return mixed
     */
    public function getUserLoginMethod()
    {
        return $this->userLoginMethod;
    }

    /**
     * @return mixed
     */
    public function getUserLast()
    {
        return $this->userLast;
    }

    /**
     * @return mixed
     */
    public function getUserActive()
    {
        return $this->userActive;
    }

    /**
     * @return mixed
     */
    public function getUserDesc()
    {
        return $this->userDesc;
    }


}