<?php
session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if(isset($_SESSION['user_key'])){
    //if client, direct to client dashboard
    if($_SESSION['user_type']=='client'){
        header("Location: http://localhost/makebuy_web/client-dashboard.php");
    }
    //if freelancer, direct to freelancer dashboard
    else {
    }
    exit();
}
//회원가입을 시도하는 경우
else if(isset($_POST['email'])){}
//주소창으로 접근하는경우
else{
    //header("Location: http://localhost/503.html");
    //exit();
}

require('../class/db.php');
$db = new db();
$connection = $db ->connect();

//leave it for checking image size
/*
if ( getimagesize($_FILES['image']['tmp_name']) == FALSE) {
    echo "Please select an image";
} else {
    $image = addslashes($_FILES['image']['tmp_name']);
    // $name = addslashes($_FILES['image']['name']);
    $image = file_get_contents($image);
    $image = base64_encode($image);
}
//image process
$image = addslashes($_FILES['image']['tmp_name']);
$image = file_get_contents($image);
$image = base64_encode($image);
*/

$email = $db ->quote($_POST['email']);
$hash = password_hash($db ->quote($_POST['password']), PASSWORD_BCRYPT);
$name = $db ->quote($_POST['name']);
$phone = $db ->quote($_POST['phone']);
$user_type = $db ->quote($_POST['user-type']);
$user_login = "normal";
//토큰 생성
$salt1 = "mb@";
$salt2 = "gh**";
$token = md5("$salt1$email$salt2");
//facebook login
if(isset($_POST['fblogin'])){
    $user_login = $db ->quote($_POST['fblogin']);
}
$user_fbid = $db ->quote($_POST['fbid']);

$sql = "SELECT user_email from user_tb WHERE user_email='$email'";
$rows = $db -> select($sql);

//같은 아이디의 유저가 있는 지 확인한다.
if (count($rows) < 1) {
    $sql = "INSERT INTO user_tb (user_email, user_pwd, user_name, user_phone, user_im, user_type, user_login, user_token, user_fbid) VALUES ('" . $email . "', '" . $hash . "', '" . $name . "', '" . $phone . "', '" . $image . "', '" . $user_type . "', '" . $user_login . "', '" . $token . "', '" . $user_fbid . " ')";
    $result= $db -> query($sql);

    //가입된 유저의 토큰을 세션에 저장한다
    $sql = "SELECT userKey, user_type, user_fbid from user_tb WHERE user_email='".$email."'";
    $rows = $db -> select($sql);
    $row = $rows[0];
    $_SESSION['user_key'] = $row['userKey'];
    $_SESSION['user_type'] = $row['user_type'];

    if($_SESSION['user_type'] == 'client'){
        echo "<script>
            alert('회원가입에 성공하셨습니다');
            location.href='../pages/client-dashboard.php';
            </script>";
    }
    else{
        echo "<script>
            alert('회원가입에 성공하셨습니다');
            location.href='../pages/freelancer-dashboard.php';
            </script>";
    }

} else {
    echo "<script>
                alert('중복된 아이디입니다');
                location.href='../pages/signup.php';
           </script>";

}
?>