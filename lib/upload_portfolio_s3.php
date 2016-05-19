<?php
/**
 * Originally created by soari
 * Edited & Modified to be used in S3 by projgotham
 * All rights reserved to EnsembleLab & makebuy
 *
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-04-26
 * Time: 오후 4:36
 */

session_start();

use Aws\S3\Exception\S3Exception;

require(__DIR__ . './../config/aws_start.php');

if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'client') {
        echo "<script>
            alert('프리랜서 포트폴리오 등록 매뉴입니다');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    } else {
    }
} //주소창으로 접근하는경우
else {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../sub.php?page=login';
            </script>";
}

ini_set("display_errors", "1");

// define ('SITE_ROOT', realpath(dirname(__FILE__)));

$subject = $_POST['subject'];
$content = $_POST['content'];
$userKey = $_SESSION['user_key'];

$filename = $_FILES['portfolio']['name'];
$tmp_name = $_FILES['portfolio']['tmp_name'];

$extension = explode('.', $filename);
$extension = strtolower(end($extension));

// Temp file details
$key = md5(uniqid());
$tmp_file_name = "{$key}.{$extension}";
$tmp_file_path = "./../uploads/{$userKey}/portfolio/{$tmp_file_name}";


$uploadOk = 1;

//Check if image file is a actual image or not
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES['portfolio']['tmp_name']);
    if ($check !== false) {
        echo "File is an image - " . $check['mime'] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image. <br/>";
        $uploadOk = 0;
    }
}
//Allow certain format of files
if (($_FILES["portfolio"]["type"] != "image/gif") &&
    ($_FILES["portfolio"]["type"] != "image/jpeg") &&
    ($_FILES["portfolio"]["type"] != "image/png") &&
    ($_FILES["portfolio"]["type"] != "image/pjpeg")
) {
    echo "Only jpg, jpeg, png, gif format can be uploaded";
    $uploadOk = 0;
}

//Check file size
if ($_FILES['portfolio']['size'] > 500000) {
    echo "file is too large";
    $uploadOk = 0;
}

//limit uploading condition
if ($uploadOk == 1) {
    if ($_FILES["portfolio"]["error"] > 0) {
        echo "Error: " . $_FILES["portfolio"]["error"] . "<br />";
    } else {
        if(file_exists('../uploads/'.$userKey.'/portfolio/'.$filename)){
            echo $_FILES["portfolio"]["name"]."already exists.";
            exit();
        } else {

            require(__DIR__ . '/../class/db.php');
            $db = new db();
            $connection = $db->connect();
            $userKey = $_SESSION['user_key'];

            // Retrieve Latest Portfolio Key
            $sql = "SELECT portKey FROM portfolio_tb WHERE portKey = (SELECT MAX(portKey) FROM portfolio_tb)";
            $rows = $db->select($sql);
            if ($rows != null) {
                $portKey = $rows[0]['portKey'];
            } else {
                $portKey = 0;
            }
            $filename = 'portfolio-' . $portKey;
            $sql = "INSERT INTO portfolio_tb (flKey, port_nm, port_explain, port_im) VALUES('" . $userKey . "', '" . $subject . "', '" . $content . "', '" . $filename . "')";
            $result = $db->query($sql);

            try {
                $s3->putObject([
                    'Bucket' => $aws_config['s3']['bucket'],
                    'Key' => "upload/portfolio/{$userKey}/{$filename}",
                    'Body' => fopen($tmp_file_path, 'rb'),
                    'ACL' => 'public-read'
                ]);
            } catch (S3Exception $e) {
                die ("오류가 발생했습니다");
            }

            //echo '자세한 디버깅 정보입니다:';
            //print_r($_FILES);

            //find character set of server
            //echo "==>".var_dump(iconv_get_encoding('all'))."<br>";
            echo "<script>
                  opener.location.reload();
                  window.close();
                  </script>";
        }
    }
} else {
    echo "Invalid file";
}

?>