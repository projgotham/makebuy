<?php
// THIS IS A FREELANCER PROCESS
/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-04-01
 * Time: 오전 12:39
 */

session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'client') {
        echo "<script>
            alert('프리랜서 매뉴입니다');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    } else {
    }
} //주소창으로 접근하는경우
else {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../index.php';
            </script>";
}

require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db->connect();

$careerKey = $db->quote($_POST['careerKey']);

$sql = "DELETE FROM career_tb WHERE careerKey='$careerKey'";
$result = $db->query($sql);

echo "<script>
alert('경력이 제거되었습니다');
 location.href='../sub.php?page=freelancer-profile';
</script>";


?>