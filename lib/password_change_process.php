<?php
/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-05-08
 * Time: 오전 1:13
 */
  session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if(!isset($_SESSION['user_key'])){
    //if client, direct to client dashboard
    echo "<script>
                alert('로그인을 해주세요');
                location.href='../sub.php?page=login';
           </script>";
}

require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db ->connect();

$userKey = $_SESSION['user_key'];
$current_password = $db->quote($_POST['current_password']);
$new_password = password_hash($db ->quote($_POST['new_password']), PASSWORD_BCRYPT);

$sql = "SELECT user_pwd FROM user_tb WHERE userKey ='$userKey'";
$rows = $db -> select($sql);

if($rows != false) {
    if(password_verify($current_password, $rows[0]['user_pwd'])) {
        $sql = "UPDATE user_tb SET user_pwd = '$new_password' WHERE userKey = '$userKey'";
        $result = $db->query($sql);
        if($result) {
            echo "<script>
            alert('비밀번호를 변경하였습니다!');
            location.href='../sub.php?page=user-profile';
            </script>";
        } else {
            echo "<script>  
            alert('비밀번호를 변경하지 못했습니다');
            location.href='../sub.php?page=user-password';
            </script>";
        }
    } else {
        echo "<script>
            alert('기존 비밀번호가 맞지 않습니다');
            location.href='../sub.php?page=user-password';
            </script>";
    }
} else {
    echo "<script>
            alert('비밀번호를 변경하지 못했습니다');
            location.href='../sub.php?page=user-password';
            </script>";
}

?>