<?php
/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-05-07
 * Time: 오전 6:40
 */
session_start();

if (!isset($_SESSION['user_key'])) {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../sub.php?page=login';
            </script>";
}

require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db->connect();

$userKey = $_SESSION['user_key'];
$nickname = $db->quote($_POST['nickname']);
$email = $db->quote($_POST['email']);
$name = $db->quote($_POST['name']);
$phone = $db->quote($_POST['phone']);

$sql = "UPDATE user_tb SET user_id = $nickname, user_email = $email, user_name = $name, user_phone = $phone WHERE userKey = $userKey";
$result = $db->query($sql);

if ($result) {
    if($_SESSION['user_type'] == 'client'){
        echo "<script>
            alert('회원 정보를 변경하였습니다');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    }
    else{
        echo "<script>
            alert('회원 정보를 변경하였습니다');
            location.href='../sub.php?page=freelancer-dashboard';
            </script>";
    }
} else {
    echo "<script>
        alert('회원 정보를 변경하지 못했습니다. 자세한 사항은 help@makebuy.co.kr로 문의 부탁드립니다');
        location.href='../sub.php?page=user-profile';
        </script>";
}