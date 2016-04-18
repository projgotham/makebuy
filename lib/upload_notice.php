<?php
/**
 * Created by PhpStorm.
 * User: Junho
 * Date: 2016-04-19
 * Time: 오전 2:15
 */

require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db ->connect();
$title = $db ->quote($_POST['title']);
$content = $db ->quote($_POST['content']);
$time = mktime();
$time = date("Y-m-d h:i:s", $time);

$sql = "INSERT INTO announce_tb (an_topic, an_date, an_content) VALUES ('$title', '$time', '$content')";
$result = $db->query($sql);

echo "<script>
            alert('공지가 등록되었습니다.');
            location.href='../sub.php?page=notice_list';
            </script>";