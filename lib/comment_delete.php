<?php
/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-05-15
 * Time: 오후 9:38
 */

 session_start();

if (isset($_SESSION['user_key'])) {
    
} else {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../sub.php?page=login';
            </script>";
}

require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db->connect();

$userKey = $_SESSION['user_key'];
$current_project = $_SESSION['current_project'];
$comment_key = $db->quote($_POST['current_comment']);;
$comment_key = explode("_", $comment_key);
$comment_key = $comment_key[1];

$sql = "UPDATE comment_tb SET c_private = 0, c_active = 0 WHERE commentKey = '$comment_key'";
$result = $db->query($sql);

echo $current_project;