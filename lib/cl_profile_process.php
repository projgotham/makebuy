<?php
/**
 * Created by PhpStorm.
 * User: soari
 * Date: 2016-02-16
 * Time: 오전 11:33
 */
session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'freelancer') {
        echo "<script>
            alert('클라이언트 프로필 등록 메뉴입니다');
            location.href='../sub.php?page=freelancer-dashboard';
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
$userKey = $_SESSION['user_key'];
/*Insert text into db*/
require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db ->connect();
$desc = $db -> quote($_POST['profile-textarea']);
$userKey = $_SESSION['user_key'];
$sql = "UPDATE user_tb SET user_desc = '$desc' WHERE userKey = '$userKey'";
$result = $db -> query($sql);


/*upload profile image*/
//When upload at server, change root to /srv.
// You need to change permission before do that.
$uploaddir =  '../uploads/'.$userKey.'/profile/';
$filename = $_FILES['profile']['name'];

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
$emptyFile = 1;
//check if image file uploaded or not
if($_FILES['profile']['size'] == 0){
    $emptyFile = 0;
    $uploadOk = 0;
}
//Check if image file is a actual image or not & check file is empty or not
if($emptyFile != 0 && isset($_POST["submit"])){
    $check = getimagesize($_FILES['profile']['tmp_name']);
    if($check !== false){
        echo "File is an image - " . $check['mime'].".";
        $uploadOk = 1;
    }
    else{
        echo "<script>
            alert('jpg, jpeg, png, gif 파일 형식만 업로드 가능합니다');
            location.href='../sub.php?page=freelancer-profile';
            </script>";
        $uploadOk = 0;
    }
}
//Allow certain format of files
if ($emptyFile != 0 &&
    ($_FILES["profile"]["type"] != "image/gif") &&
    ($_FILES["profile"]["type"] != "image/jpeg") &&
    ($_FILES["profile"]["type"] != "image/png") &&
    ($_FILES["profile"]["type"] != "image/pjpeg")){
    echo "<script>
            alert('jpg, jpeg, png, gif 파일 형식만 업로드 가능합니다');
            location.href='../sub.php?page=freelancer-profile';
            </script>";
    $uploadOk = 0;
}
//Check file size
if($_FILES['profile']['size'] > 500000) {
    echo "<script>
            alert('파일사이즈가 너무 큽니다');
            location.href='../sub.php?page=freelancer-profile';
            </script>";
    $uploadOk = 0;
}
//limit uploading condition
if ($uploadOk == 1) {
    if ($_FILES["profile"]["error"] > 0) {
        echo "Error: " . $_FILES["profile"]["error"] . "<br />";
    } else {
        if(file_exists('../uploads/'.$userKey.'/profile/'.$upload_filename)){
            echo $_FILES["profile"]["name"]."already exists.";
            exit();
        }
        else{
            if(!is_dir('../uploads/'.$userKey)){
                //mkdir('../uploads\\');
                //mkdir('../uploads/portfolio\\');
                mkdir('../uploads/'.$userKey);
                mkdir('../uploads/'.$userKey.'/profile');
            }
            //portfolio만 올린 상태일 경우
            if(!is_dir('../uploads/'.$userKey.'/profile')){
                mkdir('../uploads/'.$userKey.'/profile');
            }
            $success = move_uploaded_file($_FILES['profile']['tmp_name'], $uploadfile);
            //save url to db
            if($success){
                //get userID and save url to user_portfolio column
                $db_upload_dir = './uploads/'.$userKey.'/profile/';
                $db_upload_file = $db_upload_dir.$upload_filename;
                $sql = "UPDATE user_tb SET user_im = '$db_upload_file' WHERE userKey = '$userKey'";
                $result= $db -> query($sql);
            }
        }
    }
}
else{
    //echo "Invalid file";
}
echo "<script>
            alert('프로필이 수정되었습니다');
            location.href='../sub.php?page=client-profile';
            </script>";