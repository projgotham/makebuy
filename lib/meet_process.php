<?php
session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'freelancer') {
        echo "<script>
            alert('클라이언트 매뉴입니다');
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


require(__DIR__.'/../class/db.php');
require_once(__DIR__.'/../class/project_list.php');
require_once(__DIR__.'/../class/user_info.php');

$db = new db();
$connection = $db->connect();
$userKey = $_POST['userKey'];
$projKey = $_POST['projId'];

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
$client_info_class->getDB($_SESSION['user_key']);

$client_info = $client_info_class->getCurrentUser();
$client_name = $client_info->getUserId();
$client_email = $client_info->getUserEmail();



//check whether client select two participant already
$sql = "select 1 from participant_tb where projKey='$projKey' AND b_flag='meeting';";
$rows = $db->select($sql);
$count = count($rows);

if($count < 2 ) {
//update participants flag
    $sql = "UPDATE participant_tb SET b_flag='meeting' WHERE flKey='$userKey';";
    $result = $db->query($sql);

    /*send email to help@makebuy.co.kr && client*/
    // the message
    $msgToMakebuy = "클라이언트 미팅을 신청했습니다.\n클라이언트 아이디:".$client_name."\n클라이언트 이메일:".$client_email."\n프로젝트이름: ".$projName."\n프리랜서이름:".$freelancer_name;
    // use wordwrap() if lines are longer than 70 characters
    $msgToMakebuy = wordwrap($msgToMakebuy,90);
    // send email
    mail("help@makebuy.co.kr","[웹사이트] '".$client_name."' 님이 '".$projName."' 프로젝트의 지원자 '".$freelancer_name."'님에게 미팅신청을 보냈습니다",$msgToMakebuy);
    //$address = "http://www.makebuy.co.kr/sub.php?page=freelancer-detail&id=".$userKey;

    /*
    // the message
    $msgToClient = $freelancer_name."님 안녕하세요? 메이크바이입니다. \n\n".$client_name." 님이".$projName. "프로젝트에 회원님과의 미팅을 요청했습니다.\n".$client_name."님의 견적과 포트폴리오를 확인하시려면 아래 링크를 확인해보세요."
        .$address."\n\n\n마음에 드는 지원자 두 분까지 미팅 신청이 가능합니다. 미팅 신청이 되시면 일정을 맞추기 위해 담당자가 연락을 드리겠습니다.\n기타 문의사항은 언제든 고객센터로 연락주시기 바랍니다.
            \n감사합니다.\n메이크바이 드림";
    // use wordwrap() if lines are longer than 70 characters
    $msgToClient = wordwrap($msgToClient,70);
    $subject = "[메이크바이] '".$freelancer_name."' 님이 '".$projName."' 프로젝트에 지원했습니다";
    $headers = "From: help@makebuy.co.kr". "\r\n";;
    // send email
    mail($client_email, $subject ,$msgToClient, $headers);
    */
    echo "미팅 신청이 완료되었습니다";
}
else{
   echo "이미 두 명의 프리랜서 미팅을 신청하셨습니다";
}
?>