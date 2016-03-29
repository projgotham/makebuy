<?php

/**
 * Created by PhpStorm.
 * User: MinGu
 * Date: 2016-02-23
 * Time: 오후 4:37
 */

        session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
        if (isset($_SESSION['user_key'])) {
            //if freelancer, direct to index
            if ($_SESSION['user_type'] == 'client') {
                echo "<script>
            alert('프리랜서 경력 등록 매뉴입니다');
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

require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db->connect();

$userKey = $_SESSION['user_key'];
$career_name = $db->quote($_POST['career_name']);
$career_from = $db->quote($_POST['date-from']);
$career_to = $db->quote($_POST['date-to']);
$career_period = $career_from.'~'.$career_to;
$career_rank = $db->quote($_POST['career_rank']);

$sql = "INSERT INTO career_tb (flKey, carr_nm, carr_period, carr_type) VALUES ('$userKey', '$career_name', '$career_period', '$career_rank' )";
$result = $db->query($sql);

echo "<script>
alert('경력이 추가되었습니다');
location.href='../sub.php?page=freelancer-profile';
</script>";

?>