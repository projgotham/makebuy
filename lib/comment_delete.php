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
            location.href='../pages/login.php';
            </script>";
}

require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db->connect();

$userKey = $_SESSION['user_key'];
$current_project = $_SESSION['current_project'];

