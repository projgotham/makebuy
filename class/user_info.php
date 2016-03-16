<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-16
 * Time: 오후 2:19
 */
class user_info {

    private $currentUser;

    public function getDB($valueKey){
        require_once('../class/db.php');
        require_once('../data/user.php');

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM user_tb WHERE userKey='$valueKey'";
        $rows = $db->select($sql);
        $row = $rows[0];

        if($row != null){
            $userKey = $row['userKey'];
            $userPhone = $row['user_phone'];
            $userEmail = $row['user_email'];
            $userImage = $row['user_im'];
            $userType = $row['user_type'];
            $userLoginMethod = $row['user_login'];
            $userLast = $row['user_last'];
            $userActive = $row['user_active'];
            $userDesc = $row['user_desc'];

            $this->currentUser = new user($userKey, $userPhone, $userEmail, $userImage, $userType, $userLoginMethod, $userLast, $userActive, $userDesc);
        }
    }

    /**
     * @return mixed
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }



}