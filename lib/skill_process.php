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
            alert('프리랜서 기술 등록 매뉴입니다');
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
$connection = $db->connect();

$userKey = $_SESSION['user_key'];
$skill_nm = $db->quote($_POST['skill_name']);
$skill_lvl = $_POST['skill_lvl'];
$skill_period = $_POST['skill_period'];

$sql = "INSERT INTO skill_tb (flKey, skill_nm, skill_lvl, skill_period) VALUES ('$userKey', '$skill_nm', '$skill_lvl', '$skill_period' )";
$result = $db->query($sql);

echo "<script>
alert('기술이 추가되었습니다');
location.href='../pages/freelancer-profile.php';
</script>";

?>