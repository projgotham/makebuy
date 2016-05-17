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
//회원가입을 시도하는 경우
else if(isset($_POST['email'])){}
//주소창으로 접근하는경우
else{
    //header("Location: http://localhost/503.html");
    //exit();
}

require(__DIR__.'/../class/db.php');
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

$nickname = $db ->quote($_POST['nickname']);
$email = $db ->quote($_POST['email']);
$hash = password_hash($db ->quote($_POST['password']), PASSWORD_BCRYPT);
$name = $db ->quote($_POST['name']);
$phone = $db ->quote($_POST['phone']);
$user_type = $db ->quote($_POST['user-type']);
$user_agreements = $db ->quote($_POST['user-agreements']);
if($user_agreements == "agreements"){
    $user_agreements = 1;
}
$user_newsletter = $db ->quote($_POST['user-newsletter']);
if($user_newsletter == "newsletter"){
    $user_newsletter = 1;
}
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
    $sql = "INSERT INTO user_tb (user_id, user_email, user_pwd, user_name, user_phone, user_im, user_type, user_login,  user_fbid, user_token, user_first, user_last, user_active, user_agreements, user_newsletter) VALUES ('" . $nickname . "', '" . $email . "', '" . $hash . "', '" . $name . "', '" . $phone . "', '" . $image . "', '" . $user_type . "', '" . $user_login . "', '" . $user_fbid . " ', '" . $token . "', now(), now(), 1, '" . $user_agreements . "', '" . $user_newsletter . "')";
    $result= $db -> query($sql);

    //가입된 유저의 토큰을 세션에 저장한다
    $sql = "SELECT userKey, user_type, user_fbid from user_tb WHERE user_email='".$email."'";
    $rows = $db -> select($sql);
    $row = $rows[0];
    $_SESSION['user_key'] = $row['userKey'];
    $_SESSION['user_type'] = $row['user_type'];


    /*send email to help@makebuy.co.kr*/
    // the message
    $msg = "새로운 유저가 가입했습니다.\n유저아이디:".$nickname."\n유저타입: ".$_SESSION['user_type']."\n유저이름:".$name;
    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);
    // send email
    mail("help@makebuy.co.kr","[웹사이트]유저가입",$msg);

    /* send email to client or freelancer */
    $msgToClient = '
<!DOCTYPE html>
<html style="font-size: normal; border: 0; font-weight: normal; font-style: normal; padding: 0; line-height: normal; margin: 0; font-variant: normal; vertical-align: baseline;">
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta charset="utf-8">

    </head>
    <body style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; background-color: #f1f1f1; margin: 0; padding: 0; border: 0;" bgcolor="#f1f1f1">
        <div class="wrap" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; width: 600px; margin: 0 auto; padding: 0; border: 0;">
            <div class="box" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; position: relative; background-color: white; margin: 40px 0; padding: 0; border: 6px solid #09b262;">
                <div class="header" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; border-bottom-style: solid; border-bottom-color: #09b262; text-align: center; margin: 0; padding: 20px 40px; border-width: 0 0 2px;" align="center">
                    <a class="logo" href="http://www.makebuy.co.kr" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; text-decoration: none; margin: 0; padding: 0; border: 0;">
                        <img src="http://i.imgur.com/k5CuI6q.png" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: top; margin: 0; padding: 0; border: 0;">
                    </a>
                </div>
                <div class="content" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; margin: 0; padding: 0px 20px; border: 0;">
                    <p class="message" style="vertical-align: baseline; width: 450px; font-style: normal; font-variant: normal; font-weight: normal; font-size: normal; line-height: normal; margin: 0; padding: 30px; border: 0;">
					<br>\''.$name.'\'님 안녕하세요.<br>
					<br>메이크바이에 가입해주셔서 진심으로 감사드립니다.<br>

						<br>메이크바이는 어플리케이션을 만들고자 하시는 분들을 대상으로 기획 도움 및 외주 중개를 담당하고 있습니다. <br>

						<br>프로젝트 기획부터 미팅, 계약, 진행 및 완료까지 외주작업의 모든 단계를 함께 하면서 안전하고 효율적으로 외주중개를 끝낼 수 있도록 최선을 다하도록 하겠습니다.<br>

						<br>프로젝트 진행 및 기타 문의사항은 고객센터로 연락주시면 자세히 안내해드리겠습니다.
						<br><br>
						<br>감사합니다.
						<br>메이크바이 드림


                    </p>

                </div>
                <div class="footer" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; border-top-style: solid; border-top-color: #09b262; margin: 0; padding: 20px 40px; border-width: 2px 0 0;">
                    <p style="vertical-align: baseline; font-style: normal; font-variant: normal; font-weight: normal; font-size: 15px; line-height: 25px; font-family: \'Nanum Gothic\', sans-serif; margin: 0; padding: 0; border: 0;">@2016 makebuy.
                    <br>Call 070)7500-5850 (상담가능시간:AM10:00~PM6:00)
                    <br>Email help@makebuy.co.kr
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
        ';

    $charset='UTF-8'; // 문자셋 : UTF-8
    $subject = "[메이크바이] '회원가입을 환영합니다'";
// 제목
    $toEmail=$email; // 받는이 이메일주소
    $fromEmail='help@makebuy.co.kr'; // 보내는이 이메일주소

    $encoded_subject="=?".$charset."?B?".base64_encode($subject)."?=\n"; // 인코딩된 제목
    $to= "\"=?".$charset."?B?".base64_encode($toName)."?=\" <".$toEmail.">" ; // 인코딩된 받는이
    $from= "\"=?".$charset."?B?".base64_encode($fromName)."?=\" <".$fromEmail.">" ; // 인코딩된 보내는이
    $headers="MIME-Version: 1.0\n".
        "Content-Type: text/html; charset=".$charset."; format=flowed\n".
        "To: ". $to ."\n".
        "From: ".$from."\n".
        "Return-Path: ".$from."\n".
        "Content-Transfer-Encoding: 8bit\n"; // 헤더 설정
// send email
    $result = mail($to, $encoded_subject ,$msgToClient, $headers);

    if($_SESSION['user_type'] == 'client'){
        echo "<script>
            alert('회원가입에 성공하셨습니다');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    }
    else{
        echo "<script>
            alert('회원가입에 성공하셨습니다');
            location.href='../sub.php?page=freelancer-dashboard';
            </script>";
    }

} else {
    echo "<script>
                alert('중복된 아이디입니다');
                location.href='../sub.php?page=signup';
           </script>";

}
?>