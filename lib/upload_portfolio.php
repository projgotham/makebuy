<?php
/**
 * Created by PhpStorm.
 * User: soari
 * Date: 2016-03-17
 * Time: 오후 6:09
 */
ini_set("display_errors", "1");

$subject = $_POST['subject'];
$content = $_POST['content'];

//When upload at server, change root to /srv.
// You need to change permission before do that.
$uploaddir =  '../uploads/portfolio\\';
$filename = $_FILES['portfolio']['name'];

/*refer: http://sexy.pe.kr/tc/88
Create new file name
*/
$ext = substr(strrchr($filename,"."),1);	//확장자앞 .을 제거하기 위하여 substr()함수를 이용
$ext = strtolower($ext);			//확장자를 소문자로 변환

$tmp_file = explode(' ',microtime());			//공백을 구분하여 마이크로초와 초를 구분
$tmp_file[0] = substr($tmp_file[0],2,6);			//마이크로초의 소수점 뒷부분부터 6자리만 이용
$upload_filename = $tmp_file[1].$tmp_file[0].'.'.$ext;	//$ext는 위에서 사용된 확장자 부분, $ext='jpg'


$uploadfile = $uploaddir.$upload_filename;
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

        if(file_exists("../uploads/portfolio\\".$upload_filename)){
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
                require(__DIR__.'/../class/db.php');
                $db = new db();
                $connection = $db ->connect();
                session_start();
                $userKey = $_SESSION['user_key'];

                $db_upload_dir = './uploads/portfolio/\\';
                $db_upload_file = $db_upload_dir.$upload_filename;
                $sql = "INSERT INTO portfolio_tb (flKey, port_nm, port_explain, port_im) VALUES('".$userKey."', '".$subject."', '".$content."', '".$db_upload_file."')";
                $result= $db -> query($sql);

            }
            echo '자세한 디버깅 정보입니다:';
            print_r($_FILES);

                //find character set of server
                //echo "==>".var_dump(iconv_get_encoding('all'))."<br>";
            echo "<script>
                  opener.location.reload();
                  window.close();
                  </script>";
        }
    }
}
else{
    echo "Invalid file";
}

?>