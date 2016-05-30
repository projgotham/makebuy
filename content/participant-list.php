<?php
/*
 * check session
 */
/*
session_start();
if (!isset($_SESSION['user_key'])) {
    header("Location: http://localhost/makebuy/index.php");
    exit();
} else if ($_SESSION['user_type'] == 'freelancer') {
    header("Location: http://localhost/makebuy/sub.php?page=freelancer-dashboard");
}
*/

require_once(__DIR__ . '/../class/project_list.php');
require_once(__DIR__ . '/../class/participant_list.php');
require_once(__DIR__ . '/../class/user_info.php');
require_once(__DIR__ . '/../class/fl_rating_list.php');
$projKey = $_GET['projId'];
/**
 * Get project information by project key
 */
$load_project_list = new project_list();
$load_project_list->getDB('projKey', $projKey);
$project_list = $load_project_list->getProjList();
$project = $project_list[0];
$project_name = $project->getProjName();
$projExpPrice = $project->getProjExpPrice();
$projDeadLine = $project->getProjDeadLine();
$projExpPeriod = $project->getProjExpPeriod();
$project_participant_list = $project->getProjParticipants();
/**
 * Get participant info by project key
 */
$bid_average_price = 0;
$bid_average_period = 0;
foreach ($project_participant_list as $participant) {
    $bid_price = $participant->getBidPrice();
    $bid_period = $participant->getBidExpPeriod();
    $bid_average_price = $bid_average_price + $bid_price;
    $bid_average_period = $bid_average_period + $bid_period;
}
$bid_average_price = $bid_average_price / count($project_participant_list);
$bid_average_period = $bid_average_period / count($project_participant_list);
/**
 * load participant information from user table
 */
$user_information = new user_info();
$user_information->getDB($_SESSION['user_key']);
$current_user = $user_information->getCurrentUser();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
    $(document).ready(function () {
        menu_over("프로젝트 등록", "프로젝트 등록", "0", "0");
    })
</script>
<section class="section-project-search js--section-project-search" scroll="no">
    <div class="title">
        <h2>
            <qq style="color:#09b262;font-weight:600"><?php echo "'" . $project_name . "'" ?></qq>
            지원현황
            <div class="border"><span></span></div>
        </h2>
    </div>
    <div class="deadline-indicator">

    </div>
    <div class="meeting-explain">
        <h4>1. 지원자들의 입찰 가격, 기간, 포트폴리오를 확인해주세요<br/>
            2. 최대 2명까지 미팅신청이 가능합니다. 미팅을 신청하시면 메이크바이 팀에서 미팅을 주선해드립니다.<br/>
            3. 지원자를 선택한 후에, 고객센터(070-7500-5850, help@makebuy.co.kr)로 연락주세요.
        </h4>
    </div>
    <div class="tab-content" style="margin-top:15px;">
        <h3>총 지원자 수</h3>
        <h2><?php echo count($project_participant_list) ?></h2>
        <div class="tbl_type">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <col width="25%"/>
                <thead>
                <tr>
                    <th>예상금액</th>
                    <th>예상기간</th>
                    <th>평균금액</th>
                    <th>평균기간</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td data-title="예상금액"><h3><?php echo number_format($projExpPrice) ?></h3> 원</td>
                    <td data-title="예상기간"><h3><?php echo $projExpPeriod ?></h3> 일</td>
                    <td data-title="평균입찰가"><h3><?php echo number_format($bid_average_price) ?></h3> 원</td>
                    <td data-title="평균기간"><h3><?php echo $bid_average_period ?></h3> 일</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>
</div>
<div class="sec2">
    <div class="container">
        <section class="section-search-result js--section-search-result">
            <div class="title" style="padding-bottom:0px;">
                <h2>
                    지원자 목록
                    <div class="border"><span></span></div>
                </h2>
            </div>
            <?php
            $number = 0;
            foreach ($project_participant_list as $participant) {
                $number = $number + 1;
                $user_rating = new fl_rating_list();
                //get user info
                $user_information->getDB($participant->getFlkey());
                $current_user = $user_information->getCurrentUser();
                $user_key = $current_user->getUserKey();
                $user_id = $current_user->getUserId();
                $user_image = $current_user->getUserImage();
                //get rating info
                $user_rating->getDB($participant->getFlkey());
                $user_rating_list = $user_rating->getRatingList();
                $profSum = 0;
                $commSum = 0;
                $timeSum = 0;
                $passionSum = 0;
                $workAgainSum = 0;
                foreach ($user_rating_list as $user_rating) {
                    $profSum = $profSum + $user_rating->getIsProfessional();
                    $commSum = $commSum + $user_rating->getIsCommunicate();
                    $timeSum = $timeSum + $user_rating->getIsTime();
                    $passionSum = $passionSum + $user_rating->getIsPassion();
                    $workAgainSum = $workAgainSum + $user_rating->getIsWorkAgain();
                }
                $profAverage = $profSum / count($user_rating_list);
                $commAverage = $commSum / count($user_rating_list);
                $timeAverage = $timeSum / count($user_rating_list);
                $passionAverage = $passionSum / count($user_rating_list);
                $workAgainAverage = $workAgainSum / count($user_rating_list);
                $overallAverage = ($profAverage + $commAverage + $timeAverage + $passionAverage + $workAgainAverage) / 5;
                //get bid info
                $bid_price = $participant->getBidPrice();
                $bid_period = $participant->getBidExpPeriod();
                $bid_content = $participant->getBidContent();
                $bid_flag = $participant->getSelectedFlag();
                $bid_refer = $participant->getBidRefer();
                //count contracts done
                $load_participant_list = new participant_list();
                $load_participant_list->getSelectedDB('flKey', $user_key, 'selected');
                $participant_list = $load_participant_list->getPartList();
                echo ' <div class="card-content">
                <div class="parti-intro clearfix">
                    <img class= "part-photo" src=' . $user_image . '>
                    <div class="top-info">
                        <h3 id="team-name">' . $user_id . '</h3>
                        <div class="bottom-info">
                            <div class="info">
                                <strong>평점:</strong> ' . $overallAverage . ' / 5
                            </div>
                            <div class="info">
                                <strong>계약한 프로젝트</strong>&nbsp;&nbsp;' . count($participant_list) . '개
                            </div>
                            <div class="info">
                                <a href="./sub.php?page=freelancer-detail&id=' . $user_key . '" style="font-weight:900;cursor:pointer">프로필 보기</a>
                            </div>
                             <div class="info">
                                <a href="'.$bid_refer.'" style="font-weight:900;cursor:pointer" download>관련 포트폴리오 다운로드</a>
                            </div>
                        </div>
                    </div>
                    <div class="btn-parti-regist">';

                if ($bid_flag == 'apply') {
                    echo ' <a href="javascript:void(0);" class="b-button color btn-meeting" projId= "' . $projKey . '" id="' . $user_key . '");"><span><i class="ion-checkmark"></i>미팅신청</span></a>';
                } else {
                    echo ' <a href="javascript:void(0);" id="btn-finish-register" class="b-button btn-meeting active" projId= "' . $projKey . '" id="' . $user_key . '");"><span><i class="ion-checkmark"></i>신청완료</span></a>';

                }
                $bid_content = nl2br(htmlentities($bid_content, ENT_QUOTES, 'UTF-8'));
                echo '</div>

                </div>
                <div class="form_table" id="parti-pr">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <col width="20%" /><col />
                        <tr>
                            <th>지원&nbsp;내용</th>
                            <td>
                              ' . $bid_content . '
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="tbl_type">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <col width="50%" />
                        <thead>
                        <tr>
                            <th>예상금액</th>
                            <th>예상기간</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td data-title="예상금액"><h3>' . number_format($bid_price) . '</h3> 원</td>
                            <td data-title="예상기간"><h3>' . $bid_period . '</h3> 일</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>';


            }
            ?>
        </section>
    </div>
</div>

<div id="dialog" title="미팅신청" style="display:none">
    <h4><br/>미팅 신청은 최대 2명까지 가능합니다.<br/>신청 완료 후에는 일정조율을 위해 연락을 드립니다. <br/><br/>미팅을 신청하시겠습니까?</h4>
</div>