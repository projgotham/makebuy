<?php
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


require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db->connect();
$userKey = $_POST['userKey'];
$projKey = $_POST['projId'];
//check whether client select two participant already
$sql = "select 1 from participant_tb where projKey='$projKey' AND b_flag='meeting';";
$rows = $db->select($sql);
$count = count($rows);
if($count < 2 ) {
//update participants flag
    $sql = "UPDATE participant_tb SET b_flag='meeting' WHERE flKey='$userKey';";
    $result = $db->query($sql);
    echo "미팅 신청이 완료되었습니다";
}
else{
   echo "이미 두 명의 프리랜서 미팅을 신청하셨습니다";
}
?>