<?php

/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-03-29
 * Time: 오후 12:36
 */
session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'freelancer') {
        echo "<script>
            alert('접근할 수 없습니다');
            location.href='../sub.php?page=freelancer-dashboard';
            </script>";
    } else {
    }
} //주소창으로 접근하는경우
else {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../sub.php?page=login';
            </script>";

}

$projSkills = $_POST['proj_skill'];
$projSkills = explode(',', $projSkills);

$_SESSION['proj_skill'] = $projSkills;

?>