<?php

/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-05-15
 * Time: 오후 5:06
 */

  session_start();
 $current_project = $_SESSION['current_project'];
/*
 * 1. Check if logged in: If not, Cannot write comment
 * 2. Check if the person is related to the project
 * 2-1. Only the following people can leave a comment
 * (Project Creator, Freelancers)
 * If not related to the project, one cannot leave a comment
 */
if (isset($_SESSION['user_key'])) {
    if ($_SESSION['user_type'] == 'client') {

    }
} else {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../pages/login.php';
            </script>";
}

require(__DIR__ . '/../class/db.php');
$db = new db();
$connection = $db->connect();

$userKey = $_SESSION['user_key'];
$c_content = $db->quote($_POST['comment']);
$c_private = $db->quote($_POST['secret']);
if($c_private == 'on'){
    $c_private = 1;
} else {
    $c_private = 0;
}

if(isset($_POST['isReply'])) {
    $oCommKey = $_POST['isReply'];
} else {
    $sql = "SELECT commentKey FROM comment_tb WHERE commentKey = (SELECT MAX(commentKey) FROM comment_tb)";
    $result = $db->select($sql);
    if ($result) {
        $oCommKey = $result[0]['commentKey'] + 1;
    } else {
        $oCommKey = 1; // When there is no previous input
    }
}


$sql = "INSERT INTO comment_tb (projKey, oCommKey, c_content, c_writerKey, c_date, c_private, c_active) VALUES ('" . $current_project . "', '".$oCommKey."', '".$c_content."', '" . $userKey . "', now(), '".$c_private."', 1)";
$result = $db->query($sql);

if ($result) {
    echo "<script>
alert('댓글이 추가되었습니다');
location.href='../sub.php?page=project-intro&projId=" .$current_project. "';
</script>";

} else {
    echo "<script>
alert('오류가 발생했습니다');
location.href='../sub.php?page=project-intro&projId=" .$current_project. "';
</script>";

}
