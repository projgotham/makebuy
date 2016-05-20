<?php
/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-05-08
 * Time: 오전 1:13
 */
session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if client, direct to client dashboard
    if ($_SESSION['user_type'] == 'freelancer') {
        echo "<script>location.href='../sub.php?pages=freelancer-dashboard';</script>";
    } else {
        echo "<script>location.href='../sub.php?pages=client-dashboard';</script>";
    }
}

require(__DIR__ . '/../class/db.php');
$db = new db();
$connection = $db->connect();

$email = $db->quote($_POST['email']);
$sql = "SELECT * FROM user_tb WHERE user_email='$email'";
$rows = $db->select($sql);

if ($rows != false) {
    $temp_password = randomString();
    $temp_password_encrypted = password_hash($temp_password, PASSWORD_BCRPYT);

    $sql = "UPDATE user_tb SET user_pwd='$temp_password_encrypted' WHERE user_email='$email'";
    $result = $db->query($sql);

    // Email
    $msgToClient = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html style="font-size: normal; border: 0; font-weight: normal; font-style: normal; padding: 0; line-height: normal; margin: 0; font-variant: normal; vertical-align: baseline;">
    <head>
       <!-- <meta charset="utf-8"> -->
    </head>
    <body style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; background-color: #f1f1f1; margin: 0; padding: 0; border: 0;" bgcolor="#f1f1f1">
        <div class="wrap" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; width: 870px; margin: 0 auto; padding: 0; border: 0;">
            <div class="box" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; position: relative; background-color: white; margin: 40px 0; padding: 0; border: 6px solid #09b262;">
                <div class="header" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; border-bottom-style: solid; border-bottom-color: #09b262; margin: 0; padding: 20px 40px; border-width: 0 0 2px;">
                    <a class="logo" href="http://www.makebuy.co.kr" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; text-decoration: none; margin: 0; padding: 0; border: 0;">
                        <img src="http://i.imgur.com/6cooUrL.png?1" alt="makebuy" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: top; width: 200px; margin: 0; padding: 0; border: 0;">
                        <h1 style="vertical-align: baseline; color: #434343; display: inline; font-style: normal; font-variant: normal; font-weight: 800; font-size: 50px; line-height: normal; font-family: \'Didact Gothic\', sans - serif; margin: 0 0 0 5px; padding: 0; border: 0;"></h1>
                    </a>
                </div >
                <div class="content" style = "font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; margin: 0; padding: 0px 20px; border: 0;" >
                    <p class="message" style = "vertical-align: baseline; width: 700px; font-style: normal; font-variant: normal; font-weight: normal; font-size: normal; line-height: normal; margin: 0; padding: 30px; border: 0;" >
                        <span style = "font-size: normal; font-weight: 700; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; margin: 0; padding: 0; border: 0;" >"' . $client_name . '"</span>님 안녕하세요?
                        <br>Makebuy를 이용해주셔서 감사합니다.
                        <br>
                        <br>"' . $email . '" 님이 요청하신 변경된 비밀번호입니다."
                        <br>
                        <br>"' . $temp_password . '""
                        <br>
                        <br>접속 후 비밀번호 변경을 해주시기 바랍니다
                        <br>
                    </p>
                    <div class="button-area" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; text-align: center; margin: 0 0 30px; padding: 0; border: 0;" align="center">
                    <a href="http://www.makebuy.co.kr" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; text-decoration: none; margin: 0; padding: 0; border: 0;">
                        <div class="button" style="vertical-align: baseline; color: white; display: inline-block; text-align: center; border-bottom-style: solid; border-bottom-color: #cecece; border-radius: 5px; font-style: normal; font-variant: normal; font-weight: normal; font-size: 20px; line-height: normal; font-family: \'Nanum Gothic\', sans-serif; background-color: #09b262; margin: 0; padding: 15px 20px; border-width: 0 0 1px;" align="center">
                           메이크바이 접속하기
                        </div>
                    </a>
                    </div>
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
    $charset = 'UTF-8';
    $subject = '[메이크바이] 비밀번호 변경 안내입니다';
    $toEmail = $email;
    $fromEmail = 'help@makebuy.co.kr';

    $encoded_subject = "=?" . $charset . "?B?" . base64_encode($subject) . "?=\n"; // Encoded Subject
    $to = "\"=?" . $charset . "?B?" . base64_encode($toName) . "?=\" <" . $toEmail . ">"; // Encoded Receiver
    $from = "\"=?" . $charset . "?B?" . base64_encode($fromName) . "?=\" <" . $fromEmail . ">"; // Encoded Sender
    $headers="MIME-Version: 1.0\n".
        "Content-Type: text/html; charset=".$charset."; format=flowed\n".
        "To: ". $to ."\n".
        "From: ".$from."\n".
        "Return-Path: ".$from."\n".
        "Content-Transfer-Encoding: 8bit\n"; // 헤더 설정
    // send email
    $result = mail($to, $encoded_subject ,$msgToClient, $headers);

    // Check Result & Send Email
    if ($result) {
        echo "<script>
            alert('비밀번호가 메일로 전송되었습니다. 이메일을 확인해주세요');
            location.href='../sub.php?page=login';
            </script>";
    } else {
        echo "<script>
            alert('오류가 발생하였습니다. 비밀번호가 전송되지 못했습니다');
            location.href='../sub.php?page=user-password-find';
            </script>";
    }

} else {
    echo "<script>
            alert('이메일을 찾지 못했습니다. 이메일을 확인해주세요');
            location.href='../sub.php?page=user-password-find';
            </script>";
}

function randomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

?>