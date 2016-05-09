<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 2:14
 */
class user {

    private $userKey;
    private $userId;
    private $userEmail;
    private $userName;
    private $userPhone;
    private $userImage;
    private $userType;
    private $userLoginMethod;
    private $userFirst;
    private $userLast;
    private $userActive;
    private $userDesc;
    private $userAgreements;
    private $userNewsLetter;

    /**
     * user constructor.
     * @param $userKey
     * @param $userId
     * @param $userEmail
     * @param $userName
     * @param $userPhone
     * @param $userImage
     * @param $userType
     * @param $userLoginMethod
     * @param $userFirst
     * @param $userLast
     * @param $userActive
     * @param $userDesc
     * @param $userAgreements
     * @param $userNewsLetter
     */
    public function __construct($userKey, $userId, $userEmail, $userName, $userPhone, $userImage, $userType, $userLoginMethod, $userFirst, $userLast, $userActive, $userDesc, $userAgreements, $userNewsLetter)
    {
        $this->userKey = $userKey;
        $this->userId = $userId;
        $this->userEmail = $userEmail;
        $this->userName = $userName;
        $this->userPhone = $userPhone;
        $this->userImage = $userImage;
        $this->userType = $userType;
        $this->userLoginMethod = $userLoginMethod;
        $this->userFirst = $userFirst;
        $this->userLast = $userLast;
        $this->userActive = $userActive;
        $this->userDesc = $userDesc;
        $this->userAgreements = $userAgreements;
        $this->userNewsLetter = $userNewsLetter;
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
    public function getUserId()
    {
        return $this->userId;
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
    public function getUserName()
    {
        return $this->userName;
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
    public function getUserFirst()
    {
        return $this->userFirst;
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

    /**
     * @return mixed
     */
    public function getUserAgreements()
    {
        return $this->userAgreements;
    }

    /**
     * @return mixed
     */
    public function getUserNewsLetter()
    {
        return $this->userNewsLetter;
    }



}