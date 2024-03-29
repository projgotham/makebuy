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
        require_once(__DIR__."/../data/user.php");
        require_once(__DIR__."/../class/db.php");

        $db = new db();
        $db->connect();
        $sql = "SELECT * FROM user_tb WHERE userKey='$valueKey'";
        $rows = $db->select($sql);
        $row = $rows[0];

        if($row != null){
            $userKey = $row['userKey'];
            $userId = $row['user_id'];
            $userEmail = $row['user_email'];
            $userName = $row['user_name'];
            $userPhone = $row['user_phone'];
            $userImage = $row['user_im'];
            $userType = $row['user_type'];
            $userLoginMethod = $row['user_login'];
            $userFirst = $row['user_first'];
            $userLast = $row['user_last'];
            $userActive = $row['user_active'];
            $userDesc = $row['user_desc'];

            $this->currentUser = new user($userKey, $userId, $userEmail, $userName, $userPhone, $userImage, $userType, $userLoginMethod, $userFirst, $userLast, $userActive, $userDesc);
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