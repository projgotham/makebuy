<?php
/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-03-30
 * Time: 오후 3:20
 */

session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'client') {
        echo "<script>
            alert('프로젝트 지원은 프리랜서만 가능합니다');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    }
} //주소창으로 접근하는경우
else {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../sub.php?page=login';
            </script>";
}

require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db->connect();

$bidPrice = $db->quote($_POST['bid-price']);
$bidDeadline = $db->quote($_POST['bid-period']);
$bidContent = $db->quote($_POST['bid-content']);
$bidFlag = 'apply';
$userKey = $_SESSION['user_key'];
$projKey = $_SESSION['project'];

$registerComplete == false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Look if the user has already Participated in the project
    $sql = "SELECT * FROM participant_tb WHERE flKey='$userKey' AND projKey='$projKey'";
    $result = $db->select($sql);

    // If the user hasn't applied for the project, Register.
    if(count($result) == 0){
        $sql = "INSERT INTO participant_tb (flKey, projKey, b_price, b_period, b_content, b_flag) VALUES ('$userKey', '$projKey', '$bidPrice', '$bidDeadline', '$bidContent', '$bidFlag')";
        $result = $db->query($sql);

        $registerComplete = true;
    }

    if ($registerComplete == true) {
        echo "<script>
            alert('프로젝트를 지원하였습니다. 감사합니다.');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    } else {
        echo "<script>
            alert('이미 프로젝트에 지원되어 있습니다!');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    }
}
?>