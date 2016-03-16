<?php
/**
 * Created by PhpStorm.
 * User: soari
 * Date: 2016-02-10
 * Time: 오후 7:58
 */

session_start();
//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'freelancer') {
        echo "<script>
            alert('프로젝트 등록은 클라이언트만 가능합니다');
            location.href='../index.php';
            </script>";
    } else {
    }
} //주소창으로 접근하는경우
else {
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../pages/login.php';
            </script>";
}

// java_require('../resources/js/script.js');
require('../class/db.php');
$db = new db();
$connection = $db->connect();

$projName = $db->quote($_POST['proj-name']);
$budget = $db->quote($_POST['budget']);
$projBudget = $db->quote($_POST['proj-budget']);
$projBudget = str_replace(",", "", $projBudget);
$projBudget = str_replace("\\", "", $projBudget);
$projDue = $db->quote($_POST['proj-due']);
$projClass = $db->quote($_POST['proj-class']);
$projFieldIos = $db->quote($_POST['proj-field-ios']);
$projFieldAndroid = $db->quote($_POST['proj-field-android']);
$projFieldHybrid = $db->quote($_POST['proj-field-hybrid']);
$projSkill = $_POST['proj_skill'];
$projSkill = explode(',', $projSkill);

$projDescription = "1.프로젝트 진행방식 <br/>" . $db->quote($_POST['proj-desc-no1']) . "<br/>" . "2.프로젝트 현재상황 <br/>" . $db->quote($_POST['proj-desc-no2']) . "<br/>" . "3.참고자료 <br/>" . $db->quote($_POST['proj-desc-no3']);
$projMeeting = $db->quote($_POST['proj-meeting']);
$projOffline = false;
if ($projMeeting != 'online') {
    $projOffline = true;
}
$projEtc = $db->quote($_POST['proj-etc']);
$projAdmit = false;
//check fields
$projIos = false;
$projAndroid = false;
$projHybrid = false;
if ($projFieldIos == 'iOS') {
    $projIos = true;
}
if ($projFieldAndroid == 'Android') {
    $projAndroid = true;
}
if ($projFieldHybrid == 'Hybrid') {
    $projHybrid = true;
}
$userKey = $_SESSION['user_key'];
//calculate deadline
$times = mktime();
$projDeadline = date("Y-m-d h:i:s", $times + 1209600);
//check whether it is temporary saving or register
$projKey = $_SESSION['project'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //there isn't temp saved data
    if (!isset($_SESSION['project'])) {
        //when submit button clicked
        if(isset($_POST['projSubmit'])){
            $projAdmit = true;
        }
        //insert into project_tb
        $sql = "INSERT INTO project_tb (clientKey, proj_state, proj_price, proj_deadline, proj_upload, proj_period, proj_nm, proj_desc, proj_plan, proj_meet, proj_a_sido, proj_sc, proj_api, proj_admit, proj_etc, proj_ios, proj_android, proj_hybrid, proj_class) VALUES ('$userKey', 'test', '$projBudget', '$projDeadline', now(), '$projDue', '$projName', '$projDescription', 'file', '$projOffline', '$projMeeting', true, true, '$projAdmit', '$projEtc','$projIos', '$projAndroid', '$projHybrid', '$projClass')";
        $result = $db->query($sql);
        //insert into project_type_tb
        $sql = "SELECT projKey FROM project_tb WHERE projKey = (SELECT MAX(projKey) FROM project_tb)";
        $rows = $db->select($sql);
        $projKey = $rows[0]['projKey'];
        $sql = "INSERT INTO project_type_tb (projKey, t_skill) VALUES ('$projKey', '$projSkill')";
        $result = $db->query($sql);
        //already have saved data
    } else{
        //when submit button clicked
        if(isset($_POST['projSubmit'])){
            $projAdmit = true;
        }
        //update project_tb
        $projKey = $_SESSION['project'];
        $sql = "UPDATE project_tb SET proj_price = '$projBudget', proj_deadline = '$projDeadline', proj_upload ='$times', proj_period='$projDue', proj_nm='$projName', proj_desc='$projDescription', proj_meet='$projOffline', proj_a_sido='$projMeeting', proj_admit='$projAdmit',proj_etc='$projEtc', proj_ios='$projIos', proj_android='$projAndroid', proj_hybrid='$projHybrid', proj_class='$projClass' WHERE projKey ='$projKey'";
        $result = $db->query($sql);
        //update project_type_tb
        $sql = "UPDATE project_type_tb SET t_skill = '$projSkill' WHERE projKey = '$projKey'";
        $result = $db->query($sql);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['projSubmit'])) {
        echo "<script>
            alert('프로젝트가 등록되었습니다. 검수 후 24시간 이내에 모집을 시작합니다');
            location.href='../pages/client-dashboard.php';
            </script>";
    } else {
        echo "<script>
            alert('프로젝트가 임시저장되었습니다.');
            location.href='../pages/client-dashboard.php';
            </script>";
    }
}

?>