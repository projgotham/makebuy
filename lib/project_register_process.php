<?php
/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-03-30
 * Time: 오후 3:20
 */

session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'client') {
        echo "<script>
            alert('프로젝트 지원은 프리랜서만 가능합니다');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    }
} //주소창으로 접근하는경우
else {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../sub.php?page=login';
            </script>";
}

require(__DIR__.'/../class/db.php');
require_once(__DIR__.'/../class/project_list.php');
require_once(__DIR__.'/../class/user_info.php');


$db = new db();
$connection = $db->connect();

$bidPrice = $db->quote($_POST['bid-price']);
$bidDeadline = $db->quote($_POST['bid-period']);
$bidContent = $db->quote($_POST['bid-content']);
$bidFlag = 'apply';
$userKey = $_SESSION['user_key'];
$projKey = $_SESSION['project'];

// Load Project Info
$project_list_class = new project_list();
$project_list_class->getDB('projKey', $projKey);

$project = $project_list_class->getProjList();
$project = $project[0];

$projName = $project->getProjName();
$projClientKey = $project->getClientKey();

// Load freelancer Info
$freelancer_info_class = new user_info();
$freelancer_info_class->getDB($userKey);

$freelancer_info = $freelancer_info_class->getCurrentUser();
$freelancer_name = $freelancer_info->getUserId();
//Load Client Info
$client_info_class = new user_info();
$client_info_class->getDB($projClientKey);

$client_info = $client_info_class->getCurrentUser();
$client_name = $client_info->getUserId();
$client_email = $client_info->getUserEmail();

$registerComplete == false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Look if the user has already Participated in the project
    $sql = "SELECT * FROM participant_tb WHERE flKey='$userKey' AND projKey='$projKey'";
    $result = $db->select($sql);

    // If the user hasn't applied for the project, Register.
    if(count($result) == 0){
        $sql = "INSERT INTO participant_tb (flKey, projKey, b_price, b_period, b_content, b_flag) VALUES ('$userKey', '$projKey', '$bidPrice', '$bidDeadline', '$bidContent', '$bidFlag')";
        $result = $db->query($sql);

        $registerComplete = true;
    }

    if ($registerComplete == true) {

        /*send email to help@makebuy.co.kr && client*/
        // the message
        $msgToMakebuy = "유저가 프로젝트에 지원했습니다.\n클라이언트 아이디:".$client_name."\n클라이언트 이메일:".$client_email."\n프로젝트이름: ".$projName."\n프리랜서이름:".$freelancer_name;
        // use wordwrap() if lines are longer than 70 characters
        $msgToMakebuy = wordwrap($msgToMakebuy,90);
        // send email
        //mail("help@makebuy.co.kr","[웹사이트] '".$freelancer_name."' 님이 '".$projName."' 프로젝트 지원",$msgToMakebuy);
        $address = "http://www.makebuy.co.kr//sub.php?page=freelancer-detail&id=".$userKey;



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
                        <img src="http://www.makebuy.co.kr/images/common/makebuy_logo.png" alt="makebuy" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: top; width: 80px; margin: 0; padding: 0; border: 0;">
                        <h1 style="vertical-align: baseline; color: #434343; display: inline; font-style: normal; font-variant: normal; font-weight: 800; font-size: 50px; line-height: normal; font-family: \'Didact Gothic\', sans - serif; margin: 0 0 0 5px; padding: 0; border: 0;">makebuy</h1>
                    </a>
                    <a class="link" href="http://www.makebuy.co.kr" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; text-decoration: none; float: right; margin: 0; padding: 0; border: 0;">
                        <span style = "vertical-align: baseline; color: #676767; position: absolute; right: 40px; top: 45px; font-style: normal; font-variant: normal; font-weight: normal; font-size: 27px; line-height: normal; font-family: \'Didact Gothic\', sans-serif; margin: 0; padding: 0; border: 0;" > www.makebuy.co.kr</span >
                    </a >
                </div >
                <div class="content" style = "font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; margin: 0; padding: 0px 20px; border: 0;" >
                    <p class="message" style = "vertical-align: baseline; width: 700px; font-style: normal; font-variant: normal; font-weight: normal; font-size: normal; line-height: normal; margin: 0; padding: 30px; border: 0;" >
                        <span style = "font-size: normal; font-weight: 700; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; margin: 0; padding: 0; border: 0;" >"'.$client_name.'"</span>님 안녕하세요?
                        <br>Makebuy를 이용해주셔서 감사합니다.
                        <br>
                        <!-- <br><span style="font-size: normal; font-weight: 700; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; margin: 0; padding: 0; border: 0;">mingu</span>&#45784;&#51060; <span style="font-size: normal; font-weight: 700; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; margin: 0; padding: 0; border: 0;">Tiny Fingertip</span> &#54532;&#47196;&#51229;&#53944;&#50640; &#51648;&#50896;&#54616;&#49512;&#49845;&#45768;&#45796;.
                        <br><span style="font-size: normal; font-weight: 700; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; margin: 0; padding: 0; border: 0;">mingu</span>&#45784;&#51032; &#44204;&#51201;&#44284; &#54532;&#47196;&#54596;&#51060; &#44417;&#44552;&#54616;&#49884;&#45796;&#47732; &#51648;&#44552; &#54869;&#51064;&#54644;&#48372;&#49464;&#50836;. -->
                        <br>"'.$freelancer_name.'" 님이 "'.$projName.'"프로젝트에 지원했습니다."
                        <br>
                        <br>"'.$freelancer_name.'"님의 견적과 포트폴리오를 확인하시려면 아래 링크를 확인해보세요."
                        <br>&#51648;&#50896;&#51088;&#50752;&#51032; &#49888;&#49549;&#54620; &#48120;&#54021; &#51312;&#50984;&#51012; &#50948;&#54644; &#45812;&#45817; &#47588;&#45768;&#51200;&#44032; &#50672;&#46973;&#46300;&#47540; &#50696;&#51221;&#51077;&#45768;&#45796;.
                        <br>
                        <br>&#47928;&#51032;&#49324;&#54637;&#51008; &#50616;&#51228;&#46304;&#51648; &#44256;&#44061;&#49468;&#53552;&#47196; &#50672;&#46973;&#48148;&#46989;&#45768;&#45796;.
                        <br>&#44048;&#49324;&#54633;&#45768;&#45796;.
                    </p>
                    <div class="button-area" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; text-align: center; margin: 0 0 30px; padding: 0; border: 0;" align="center">
                    <a href="'.$address.'" style="font-size: normal; font-weight: normal; line-height: normal; font-variant: normal; font-style: normal; vertical-align: baseline; text-decoration: none; margin: 0; padding: 0; border: 0;">
                        <div class="button" style="vertical-align: baseline; color: white; display: inline-block; text-align: center; border-bottom-style: solid; border-bottom-color: #cecece; border-radius: 5px; font-style: normal; font-variant: normal; font-weight: normal; font-size: 20px; line-height: normal; font-family: \'Nanum Gothic\', sans-serif; background-color: #09b262; margin: 0; padding: 15px 20px; border-width: 0 0 1px;" align="center">
                           지원자 확인하기
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
        // use wordwrap() if lines are longer than 70 characters
        //$msgToClient = wordwrap($msgToClient,70);

        //encoding text
        // $msgToClient = "=?EUC-KR?B?".base64_encode(iconv("UTF-8","EUC-KR", $msgToClient))."?=";
        // $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
        // $subject = "=?EUC-KR?B?".base64_encode(iconv("UTF-8","EUC-KR", $subject))."?=";

        //$headers = "From: =?EUC-KR?B?".base64_encode(iconv("UTF-8","EUC-KR", "help@makebuy.co.kr"))."?=". "\r\n";

        $charset='UTF-8'; // 문자셋 : UTF-8
        $subject = "[메이크바이] '".$freelancer_name."' 님이 '".$projName."' 프로젝트에 지원했습니다";
        // 제목
        $toEmail=$client_email; // 받는이 이메일주소
        $fromEmail='help@makebuy.co.kr'; // 보내는이 이메일주소
        // the message

        /*
        $msgToClient = $client_name."님 안녕하세요? 메이크바이입니다. \n\n".$freelancer_name." 님이 '".$projName. "' 프로젝트에 지원했습니다.\n".$client_name."님의 견적과 포트폴리오를 확인하시려면 아래 링크를 확인해보세요."
            .$address."\n\n\n마음에 드는 지원자 두 분까지 미팅 신청이 가능합니다. 미팅 신청이 되시면 일정을 맞추기 위해 담당자가 연락을 드리겠습니다.\n기타 문의사항은 언제든 고객센터로 연락주시기 바랍니다.
            \n감사합니다.\n메이크바이 드림\n\nhelp@makebuy.co.kr\n070-7500-5850";
        */
        $encoded_subject="=?".$charset."?B?".base64_encode($subject)."?=\n"; // 인코딩된 제목
        $to= "\"=?".$charset."?B?".base64_encode($toName)."?=\" <".$toEmail.">" ; // 인코딩된 받는이
        $from= "\"=?".$charset."?B?".base64_encode($fromName)."?=\" <".$fromEmail.">" ; // 인코딩된 보내는이
        $headers="MIME-Version: 1.0\n".
            "Content-Type: text/html; charset=".$charset."; format=flowed\n".
            "To: ". $to ."\n".
            "From: ".$from."\n".
            "Return-Path: ".$from."\n".
            "Content-Transfer-Encoding: 8bit\n"; // 헤더 설정
        /*
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= "To: $client_email" . "\r\n";
        $headers .= 'From: help@makebuy.co.kr' . "\r\n";
        $headers .= 'Content-Transfer-Encoding: 8bit. '. "\r\n";
*/
        // send email
        $result = mail($to, $encoded_subject ,$msgToClient, $headers);
        /*
        // the message
        $address = "http://www.makebuy.co.kr/sub.php?page=freelancer-detail&id=".$userKey;
        $msgToClient = $client_name."님 안녕하세요? 메이크바이입니다. \n\n".$freelancer_name." 님이 '".$projName. "' 프로젝트에 지원했습니다.\n".$client_name."님의 견적과 포트폴리오를 확인하시려면 아래 링크를 확인해보세요."
            .$address."\n\n\n마음에 드는 지원자 두 분까지 미팅 신청이 가능합니다. 미팅 신청이 되시면 일정을 맞추기 위해 담당자가 연락을 드리겠습니다.\n기타 문의사항은 언제든 고객센터로 연락주시기 바랍니다.
            \n감사합니다.\n메이크바이 드림\n\nhelp@makebuy.co.kr\n070-7500-5850";

        // use wordwrap() if lines are longer than 70 characters
        $msgToClient = wordwrap($msgToClient,70);
        $subject = "[메이크바이] '".$freelancer_name."' 님이 '".$projName."' 프로젝트에 지원했습니다";

        //encoding text
        $msgToClient = "=?EUC-KR?B?".base64_encode(iconv("UTF-8","EUC-KR", $msgToClient))."?=";
       // $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
        $subject = "=?EUC-KR?B?".base64_encode(iconv("UTF-8","EUC-KR", $subject))."?=";

        $headers = "From: =?EUC-KR?B?".base64_encode(iconv("UTF-8","EUC-KR", "help@makebuy.co.kr"))."?=". "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        // send email
        mail($client_email, $subject ,$msgToClient, $headers);
        */
        echo "<script>
            alert('프로젝트를 지원하였습니다. 감사합니다.');
            location.href='../sub.php?page=freelancer-dashboard';
            </script>";
    } else {
        echo "<script>
            alert('이미 프로젝트에 지원되어 있습니다!');
            location.href='../sub.php?page=project-intro&projId=$projKey';
            </script>";
    }
}
?>