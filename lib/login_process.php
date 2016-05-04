<?php
session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if(isset($_SESSION['user_key'])){
    //if client, direct to client dashboard
    if($_SESSION['user_type']=='client'){
        header("Location: http://www.makebuy.co.kr/makebuy/sub.php?page=client-dashboard");
    }
    //if freelancer, direct to freelancer dashboard
    else {
        header("Location: http://www.makebuy.co.kr/makebuy/sub.php?page=freelancer-dashboard");
    }
    exit();
}
//로그인을 시도하는 경우
else if(isset($_POST['email'])){}
//주소창으로 접근하는경우
else{
    header("Location: http://localhost/503.html");
    exit();
}

require(__DIR__.'/../class/db.php');
$db = new db();
$connection = $db ->connect();
$email = $db ->quote($_POST['email']);
$rows = $db -> select("SELECT userKey, user_type, user_email, user_pwd, user_token FROM user_tb WHERE user_email='$email'");

//confirm email exist or not
if ($rows != false) {
    //check email and password
    if($email == $rows[0]['user_email'] && password_verify($db ->quote($_POST['password']), $rows[0]['user_pwd'])){
        //로그인된 유저의 키를 세션에 저장한다
        session_start();
        $row = $rows[0];
        $_SESSION['user_key'] = $row['userKey'];
        $_SESSION['user_type'] = $row['user_type'];
        if($_SESSION['user_type'] == 'client'){
            echo "<script>
            alert('로그인에 성공하셨습니다');
            location.href='../sub.php?page=client-dashboard';
            </script>";
        }
        else{
            echo "<script>
            alert('로그인에 성공하셨습니다');
            location.href='../sub.php?page=freelancer-dashboard';
            </script>";
        }
    } else {
        echo "<script>
                alert('아이디나 비밀번호를 잘못 입력했습니다');
                location.href='../sub.php?page=login';
           </script>";

    }
} else {
    echo "<script>
                alert('아이디나 비밀번호를 잘못 입력했습니다');
                location.href='../sub.php?page=login';
           </script>";

}
?>