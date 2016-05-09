<?php
/**
 * Created by PhpStorm.
 * User: soari
 * Date: 2016-02-10
 * Time: 오후 7:58
 */

session_start();

use Aws\S3\Exception\S3Exception;
require (__DIR__.'./../config/aws_start.php');

//로그인이 되어있는 경우 프리랜서와 클라이언트 구별해야함
if (isset($_SESSION['user_key'])) {
    //if freelancer, direct to index
    if ($_SESSION['user_type'] == 'freelancer') {
        echo "<script>
            alert('프로젝트 등록은 클라이언트만 가능합니다');
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

// java_require('../resources/js/script.js');
require('../class/db.php');
$db = new db();
$connection = $db->connect();

// General: UserKey & Project Name
$userKey = $_SESSION['user_key'];
$projName = $db->quote($_POST['proj-name']);

// Project Scale and Expected Price
$projScale = $db->quote($_POST['proj-scale']);
$projExpPrice = $db->quote($_POST['proj-exp-price']);
$projExpPrice = str_replace(",", "", $projExpPrice);
$projExpPrice = str_replace("\\", "", $projExpPrice);

// Project Expected Period
$projExpPeriod = $db->quote($_POST['proj-exp-period']);

/* Project Sort & Class
 * Sort: Stating the TYPE of the project (New, Main, Module-Only, Modification, Consultation or Etc)
 * Class: Classification of the Application (Native, Hybrid, Mobile-Web)
 * Skill: Type of Skills needed to handle the project
 */
$projSort = $db->quote($_POST['proj-sort']);
$projClassNative = $db->quote($_POST['proj-class-native']);
$projClassHybrid = $db->quote($_POST['proj-class-hybrid']);
$projClassMobile = $db->quote($_POST['proj-class-mobile']);
$projSkills = $_SESSION['proj_skill'];

$projDescription = $db->quote($_POST['proj-desc']);
$projMeeting = $db->quote($_POST['proj-meeting']);
/*
DEPRECATED: $projDescription = "1.프로젝트 진행방식 <br/>" . $db->quote($_POST['proj-desc']) . "<br/>" . "2.프로젝트 현재상황 <br/>" . $db->quote($_POST['proj-desc-no2']) . "<br/>" . "3.참고자료 <br/>" . $db->quote($_POST['proj-desc-no3']);
$projOffline = false;
if ($projMeeting != 'online') {
    $projOffline = true;
}
$projEtc = $db->quote($_POST['proj-etc']);
$projAdmit = false;
*/

// Check the Project Class Status
$projIsNative = 0;
$projIsHybrid = 0;
$projIsMobile = 0;
if ($projClassNative == true) {
    $projIsNative = 1;
}
if ($projClassHybrid == 1) {
    $projIsHybrid = true;
}
if ($projClassMobile == 1) {
    $projIsMobile == true;
}

// Check Project SourceCode
$projSC = $db->quote($_POST['proj-sc']);
$projSourceCode = 0;
if ($projSC == 1) {
    $projSourceCode = 1;
}

// Calculate Deadline & Finish Date
$times = mktime();
$projDeadline = date("Y-m-d h:i:s", $times + 1209600);
$projFinish = date("Y-m-d h:i:s", $times + ($projExpPeriod * 24 * 60 * 60));

// Upload File Process
$uploaddir = '../uploads/' . $userKey . '/project/';
$filename = $_FILES['project-plan']['name'];

/*refer: http://sexy.pe.kr/tc/88
Create new file name
*/
$ext = substr(strrchr($filename, "."), 1);    //확장자앞 .을 제거하기 위하여 substr()함수를 이용
$ext = strtolower($ext);            //확장자를 소문자로 변환

$tmp_file = explode(' ', microtime());            //공백을 구분하여 마이크로초와 초를 구분
$tmp_file[0] = substr($tmp_file[0], 2, 6);            //마이크로초의 소수점 뒷부분부터 6자리만 이용
$upload_filename = $tmp_file[1] . $tmp_file[0] . '.' . $ext;    //$ext는 위에서 사용된 확장자 부분, $ext='jpg'

$uploadfile = $uploaddir . $upload_filename;
$uploadOk = 1;
$emptyFile = 1;
$db_upload_file="";
$db_upload_dir = './uploads/'.$userKey.'/project/';
//check if image file uploaded or not
if($_FILES['project-plan']['size'] == 0){
    $emptyFile = 0;
    $uploadOk = 0;
}

// PROJECT_PROCESS
// $projSubmit variable determines whether the user is trying to SAVE data or SUBMIT it.
$projSubmit = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Case1: No Save data found inside the Database
    // Determined by Whether there is a SESSION variable under the name 'project'
    if (!isset($_SESSION['project'])) {
        // Case 1-1: When Submit Button was Pressed
        if (isset($_POST['projSubmit'])) {
            $projSubmit = 1;
        }

        /*
         * UPLOAD EC2 TEMP Part (To be replaced with S3)
         */
        if($emptyFile != 0) {
            if (!is_dir('../uploads/' . $userKey)) {
                //mkdir('../uploads\\');
                mkdir('../uploads/' . $userKey, 0777, true);
                mkdir('../uploads/' . $userKey . '/project', 0777, true);
            }

            if (!is_dir('../uploads/' . $userKey . '/project')) {
                mkdir('../uploads/' . $userKey . '/project', 0777, true);
            }
            $success = move_uploaded_file($_FILES['project-plan']['tmp_name'], $uploadfile);
            if ($success) {
                $db_upload_dir = './uploads/' . $userKey . '/project/';
                $db_upload_file = $db_upload_dir . $upload_filename;
            }
        }
            // Insert into project_tb
            $sql = "INSERT INTO project_tb (clientKey, proj_state, proj_scale, proj_exp_price, proj_deadline, proj_upload, proj_finish, proj_exp_period, proj_nm, proj_sort, proj_is_native, proj_is_hybrid, proj_is_mobile, proj_desc, proj_plan, proj_meeting, proj_sc) VALUES ('$userKey', 'test', '$projScale', '$projExpPrice', '$projDeadline', now(), '$projFinish', '$projExpPeriod', '$projName', '$projSort', '$projIsNative', '$projIsHybrid', '$projIsMobile', '$projDescription', '$db_upload_file', '$projMeeting', '$projSourceCode')";
            $result = $db->query($sql);
            // Retrieve Project Key
            $sql = "SELECT projKey FROM project_tb WHERE projKey = (SELECT MAX(projKey) FROM project_tb)";
            $rows = $db->select($sql);
            $projKey = $rows[0]['projKey'];

            foreach ($projSkills as $projSkill) {
                $sql = "INSERT INTO project_type_tb (projKey, proj_type) VALUES ('$projKey', '$projSkill')";
                $result = $db->query($sql);
            }
        /*
         * Implementation of Amazon Web Service S3
         */
        /*
        if(isset($_FILES['file'])) {
            $file = $_FILES['file'];

            // File details
            $name = $file['name'];
            $tmp_name = $file['tmp_name'];

            $extension = explode('.', $name);
            $extension = strtolower(end($extension));
            $name = 'project-'.$projKey;

            // Temp details
            $key = md5(uniqid());
            $tmp_file_name = "{$key}.{$extension}";
            $tmp_file_path = "../files/{$tmp_file_name}";

            // Move the file
            move_uploaded_file($tmp_name, $tmp_file_path);

            try {
                $s3->putObject([
                    'Bucket' => $aws_config['s3']['bucket'],
                    'Key' => "upload/project/{$userKey}/{$name}",
                    'Body' => fopen($tmp_file_path, 'rb')
                ]);

            } catch(S3Exception $e) {
                die ("There was an error");
            }
        }
        */

        // Case 2: There is Save Data found inside the database
    } else {
        //when submit button clicked
        if (isset($_POST['projSubmit'])) {
            $projAdmit = 1;
        }
        //update project_tb
        $projKey = $_SESSION['project'];
        // $sql = "UPDATE project_tb SET proj_exp_price = '$projExpPrice', proj_deadline = '$projDeadline', proj_upload ='$times', proj_period='$projDue', proj_nm='$projName', proj_desc='$projDescription', proj_meet='$projOffline', proj_a_sido='$projMeeting', proj_admit='$projAdmit',proj_etc='$projEtc', proj_ios='$projIos', proj_android='$projAndroid', proj_hybrid='$projHybrid', proj_class='$projClass' WHERE projKey ='$projKey'";
        $sql = "UPDATE project_tb SET proj_exp_price = '$projExpPrice', proj_deadline = '$projDeadline', proj_upload = '$times', proj_exp_period = '$projExpPeriod', proj_nm = '$proj_nm', proj_sort = '$projSort', proj_is_native = '$projIsNative', proj_is_hybrid = '$projIsHybrid', proj_is_mobile = '$projIsMobile', proj_desc = '$projDescription', proj_plan = 'text', proj_meeting = '$projMeeting', proj_sc = '$projSourceCode', proj_submit = '$projSubmit' WHERE projKey = '$projKey'";
        $result = $db->query($sql);
        /*
         * DEPRECATED: Due to Database Corruption Issues
         * $sql = "UPDATE project_type_tb SET t_skill = '$projSkill' WHERE projKey = '$projKey'";
         * $result = $db->query($sql);
         */
        // DELETE all project_types & ADD new project_types
        $sql = "DELETE FROM project_type_tb WHERE projKey = '$projKey'";
        $db->query($sql);

        foreach ($projSkills as $projSkill) {
            $sql = "INSERT INTO project_type_tb (projKey, proj_type) VALUES ('$projKey', '$projSkill')";
            $result = $db->query($sql);
        }
    }
    
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['projSubmit'])) {
        /*send email to help@makebuy.co.kr && client*/
        // the message
        $msgToMakebuy = "유저가 프로젝트를 등록했습니다.\n클라이언트 아이디:".$userKey."\n프로젝트이름: ".$projName;
        // use wordwrap() if lines are longer than 70 characters
        $msgToMakebuy = wordwrap($msgToMakebuy,70);
        // send email
        mail("help@makebuy.co.kr","[웹사이트] '".$userKey."' 님이 '".$projName."' 프로젝트 지원",$msgToMakebuy);


        echo "<script>
            alert('프로젝트가 등록되었습니다. 검수 후 24시간 이내에 모집을 시작합니다');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    } else {
        echo "<script>
            alert('프로젝트가 임시저장되었습니다.');
            location.href='../sub.php?page=client-dashboard';
            </script>";
    }
}

?>