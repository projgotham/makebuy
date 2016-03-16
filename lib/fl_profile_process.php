<?php
/**
 * Created by PhpStorm.
 * User: soari
 * Date: 2016-02-16
 * Time: 오전 11:33
 */
session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'client') {
        echo "<script>
            alert('프리랜서 프로필 등록 메뉴입니다');
            location.href='../index.php';
            </script>";
    } else {
    }
} //주소창으로 접근하는경우
else {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../pages/login.php';
            </script>";
}

require('../class/db.php');
$db = new db();
$connection = $db ->connect();

$desc = $db -> quote($_POST['profile-textarea']);
$userKey = $_SESSION['user_key'];
$sql = "UPDATE user_tb SET user_desc = '$desc' WHERE userKey = '$userKey'";
$result = $db -> query($sql);


echo "<script>
            alert('프로필이 수정되었습니다');
            location.href='../pages/freelancer-profile.php';
            </script>";