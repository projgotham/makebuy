<?php
/**
 * Created by PhpStorm.
 * User: Junho
 * Date: 2016-03-25
 * Time: 오전 2:37
 */

require('../class/db.php');
$db = new db();
$connection = $db->connect();

echo "hello";

?>