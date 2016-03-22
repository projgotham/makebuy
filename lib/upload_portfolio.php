<?php
/**
 * Created by PhpStorm.
 * User: soari
 * Date: 2016-03-17
 * Time: 오후 6:09
 */
ini_set("display_errors", "1");

//When upload at server, change root to /srv.
// You need to change permission before do that.
$uploaddir =  '../uploads/portfolio\\';
$uploadfile = $uploaddir.basename($_FILES['portfolio']['name']);
$uploadOk = 1;

//Check if image file is a actual image or not
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES['portfolio']['tmp_name']);
    if($check !== false){
        echo "File is an image - " . $check['mime'].".";
        $uploadOk = 1;
    }
    else{
        echo "File is not an image. <br/>";
        $uploadOk = 0;
    }
}
//Allow certain format of files
if (($_FILES["portfolio"]["type"] != "image/gif") &&
    ($_FILES["portfolio"]["type"] != "image/jpeg") &&
    ($_FILES["portfolio"]["type"] != "image/png") &&
    ($_FILES["portfolio"]["type"] != "image/pjpeg")){
    echo "Only jpg, jpeg, png, gif format can be uploaded";
    $uploadOk = 0;
}

//Check file size
if($_FILES['portfolio']['size'] > 500000) {
    echo "file is too large";
    $uploadOk = 0;
}

//limit uploading condition
if ($uploadOk == 1) {
    if ($_FILES["portfolio"]["error"] > 0) {
        echo "Error: " . $_FILES["portfolio"]["error"] . "<br />";
    } else {
        /*
        echo "Upload: " . $_FILES["portfolio"]["name"] . "<br />";
        echo "Type: " . $_FILES["portfolio"]["type"] . "<br />";
        echo "Size: " . ($_FILES["portfolio"]["size"] / 1024) . " Kb<br />";
        echo "Stored in: " . $_FILES["portfolio"]["tmp_name"]."<br />";
        */

        if(file_exists("../uploads/portfolio\\".$_FILES["portfolio"]["name"])){
            echo $_FILES["portfolio"]["name"]."already exists.";
            exit();
        }
        else{
            if(!is_dir('../uploads\\')){
                mkdir('../uploads\\');
                mkdir('../uploads\portfolio\\');
            }
            $success = move_uploaded_file($_FILES['portfolio']['tmp_name'], $uploadfile);
            //save url to db
            if($success){
                //get userID and save url to user_portfolio column
                require('../class/db.php');
                $db = new db();
                $connection = $db ->connect();
                session_start();
                $userKey = $_SESSION['user_key'];

                $db_upload_dir = './uploads/portfolio/\\';
                $db_upload_file = $db_upload_dir.basename($_FILES['portfolio']['name']);
                $sql = "INSERT INTO portfolio_tb (flKey, port_nm, port_type, port_im) VALUES('".$userKey."', 'porttest', 'port_type', '".$db_upload_file."')";
                $result= $db -> query($sql);

            }
            //echo '자세한 디버깅 정보입니다:';
            //print_r($_FILES);

            echo "<script>
            location.href='../sub.php?page=freelancer-profile';
            </script>";
        }
    }
}
else{
    echo "Invalid file";
}

?>