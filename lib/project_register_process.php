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
        mail("help@makebuy.co.kr","[웹사이트] '".$freelancer_name."' 님이 '".$projName."' 프로젝트 지원",$msgToMakebuy);
        $address = "http://www.makebuy.co.kr/sub.php?page=freelancer-detail&id=".$userKey;

        // the message
        $msgToClient = $client_name."님 안녕하세요? 메이크바이입니다. \n\n".$freelancer_name." 님이".$projName. "프로젝트에 지원했습니다.\n".$client_name."님의 견적과 포트폴리오를 확인하시려면 아래 링크를 확인해보세요."
            .$address."\n\n\n마음에 드는 지원자 두 분까지 미팅 신청이 가능합니다. 미팅 신청이 되시면 일정을 맞추기 위해 담당자가 연락을 드리겠습니다.\n기타 문의사항은 언제든 고객센터로 연락주시기 바랍니다.
            \n감사합니다.\n메이크바이 드림";
        // use wordwrap() if lines are longer than 70 characters
        $msgToClient = wordwrap($msgToClient,70);
        $subject = "[메이크바이] '".$freelancer_name."' 님이 '".$projName."' 프로젝트에 지원했습니다";
        $headers = "From: help@makebuy.co.kr". "\r\n";;
        // send email
        mail($client_email, $subject ,$msgToClient, $headers);

        echo "<script>
            alert('프로젝트를 지원하였습니다. 감사합니다.');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    } else {
        echo "<script>
            alert('이미 프로젝트에 지원되어 있습니다!');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    }
}
?>