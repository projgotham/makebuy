<?php
/*
 * check session
 */
/*
session_start();
if (!isset($_SESSION['user_key'])) {
    header("Location: http://localhost/makebuy/index.php");
    exit();
} else if ($_SESSION['user_type'] == 'client') {
//header("Location: http://localhost/makebuy_web/client-dashboard.php");
    header("Location: http://localhost/makebuy_web/content/client-dashboard.php");
    exit();
}
*/

require_once(__DIR__ . '/../class/user_info.php');
require_once(__DIR__ . '/../class/fl_career_list.php');
require_once(__DIR__ . '/../class/fl_portfolio_list.php');
require_once(__DIR__ . '/../class/fl_rating_list.php');
require_once(__DIR__ . '/../class/fl_skill_list.php');
require_once(__DIR__ . '/../class/participant_list.php');

require(__DIR__ . './../config/aws_start.php');

// User Object Class
$user_info = new user_info();
$user_career = new fl_career_list();
$user_portfolio = new fl_portfolio_list();
$user_rating = new fl_rating_list();
$user_skill = new fl_skill_list();
$participant_project = new participant_list();

$user_info->getDB($_SESSION['user_key']);
$user_career->getDB($_SESSION['user_key']);
$user_portfolio->getDB($_SESSION['user_key']);
$user_rating->getDB($_SESSION['user_key']);
$user_skill->getDB($_SESSION['user_key']);
$participant_project->getDB('b_flag', 1);

// Result Values (Use this to ECHO in HTML)
$current_user = $user_info->getCurrentUser();
$user_career_list = $user_career->getCareerList();
$user_portfolio_list = $user_portfolio->getPortfolioList();
$user_rating_list = $user_rating->getRatingList();
$user_skill_list = $user_skill->getSkillList();
$participant_project_list = $participant_project->getPartList();

// Rating Values
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

//count user participated projects
$participant_project_count = count($participant_project_list);

?>


<link rel="stylesheet" type="text/css" href="./js/jquery.fancybox.css?v=1.0.7"/>
<script type="text/javascript" src="./js/jquery.fancybox.js?v=1.0.7"></script>

<script>
    $(document).ready(function () {
        jQuery('.tabs ul li a').on('click', function (e) {
            var currentAttrValue = jQuery(this).attr('href');
            // Show/Hide Tabs
            jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
            // Change/remove current tab to active
            jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

            e.preventDefault();
        });
        menu_over("", "", "5", "2");
        $('.fancybox-thumbs').fancybox({
            wrapCSS: 'fancybox-custom',
            prevEffect: 'none',
            nextEffect: 'none',

            closeBtn: true,
            arrows: true,
            nextClick: true,

            type: "image",

            helpers: {
                thumbs: {
                    width: 50,
                    height: 50
                },
                title: {
                    type: 'outside'
                },
                overlay: {
                    speedOut: 0
                }
            },
            afterLoad: function () {
                var number = this.index;
                var titleName = '#title' + number;
                var explainName = '#explain' + number;
                //this.title = '포트폴리오 ' + (this.index + 1) + ' of ' + this.group.length +
                this.title = ($(titleName)[0].value ? '  ' + $(titleName)[0].value : '') + '<br/><br/>' + $(explainName)[0].value;
            }
        });
    })
</script>
<section class="section-fl-profile js--section-fl-profile">
    <div class='title'>
        <h2>
            <?php
            $userId = $current_user->getUserId();
            echo "&nbsp;$userId&nbsp;&nbsp;&#124;";
            ?>
            <div class='border'><span></span></div>
            프리랜서
        </h2>

    </div>
    <!--<h3 class='user-auth' style='padding-bottom:10px;'>신원이 확인되었습니다</h3> -->
    <div class="fl-intro" id="fl-profile">
        <div class="col span-2-of-3 intro-box">
            <figure class="photo-box">
                <!-- TODO Insert Image -->
                <?php
                $imageUrl = $current_user->getUserImage();
                echo "<img src='$imageUrl'>";
                ?>
            </figure>
            <?php
            $userDesc = $current_user->getUserDesc();
            $userDesc = nl2br(htmlentities($userDesc, ENT_QUOTES, 'UTF-8'));
            echo "<h4>$userDesc</h4>";
            ?>
        </div>
        <div class="board_button">
            <a href="#" id="editProfile-button" class="b-button color"><span><i class="ion-edit"></i>프로필 수정하기</span></a>
        </div>
    </div>

</section>


</div>
</div>
<div class="sec2">
    <div class="container">
        <section class="section-status js--section-status">
            <div class="tabs">
                <div class="tab_list">
                    <ul>
                        <li class="active"><a href="#tab1-summary">개요</a></li>
                        <li><a href="#tab2-eval">평가</a></li>
                        <li><a href="#tab3-port">포트폴리오</a></li>
                        <li><a href="#tab4-skill">기술 및 자격증</a></li>
                        <li><a href="#tab5-career">경력 및 학력</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div id="tab1-summary" class="tab active">
                        <div class="divide_l">
                            <div class="row summary-part">
                                <h3 class="content-subject">평가<a href="javascript:void(0);"
                                                                 class="m-button active rr" id="btn-seeEval"><span>전체 평가 보기</span></a>
                                </h3>
                                <div class="row inside-value">
                                    <p>클라이언트 만족도</p>
                                    <!-- TODO PROGRESS BAR-->
                                    <?php
                                    echo "<progress value='$overallAverage' min=\"0\" max='5' class=\"\"><strong>Progress: 60% done.</strong>
                                    </progress>
                                    <p class='overall-value'><strong>$overallAverage</strong>점</p>
                                     <p>총 참여 프로젝트 $participant_project_count 건</p>"
                                    ?>

                                </div>
                            </div>
                            <div class="row skill-part">
                                <h3 class="content-subject">기술 및 자격증<a href="javascript:void(0);"
                                                                       class="m-button active rr"
                                                                       id="btn-seeSkill"><span>전체 기술 보기</span></a>
                                </h3>
                                <div class="tbl_type">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>종류</th>
                                            <th>숙련도</th>
                                            <th>사용기간</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        foreach ($user_skill_list as $skill) {
                                            $skillKey = $skill->getSkillKey();
                                            $skillName = $skill->getSkillNm();
                                            $skillLevel = $skill->getSkillLvl();
                                            $skillPeriod = $skill->getSkillPeriod();
                                            switch ($skillLevel) {
                                                case 'level_1':
                                                    $skillLevel = '1급';
                                                    break;
                                                case 'level_2':
                                                    $skillLevel = '2급';
                                                    break;
                                                case 'level_3':
                                                    $skillLevel = '3급';
                                                    break;
                                                case 'level_low':
                                                    $skillLevel = '초급';
                                                    break;
                                                case 'level_middle':
                                                    $skillLevel = '중급';
                                                    break;
                                                case 'level_high':
                                                    $skillLevel = '고급';
                                                    break;
                                                case 'level_etc':
                                                    $skillLevel = '기타';
                                                    break;
                                            }
                                            $skillPeriod = $skill->getSkillPeriod();
                                            switch ($skillPeriod) {
                                                case 'veryshort':
                                                    $skillPeriod = '1년 미만';
                                                    break;
                                                case 'short':
                                                    $skillPeriod = '1년 이상 3년 미만';
                                                    break;
                                                case 'middle':
                                                    $skillPeriod = '3년 이상 5년 미만';
                                                    break;
                                                case 'long':
                                                    $skillPeriod = '5년 이상 7년 미만';
                                                    break;
                                                case 'verylong':
                                                    $skillPeriod = '7년 이상 10년 미만';
                                                    break;
                                                case 'expert':
                                                    $skillPeriod = '10년 이상';
                                                    break;
                                            }
                                            echo "<tbody>";
                                            echo "<tr>";
                                            // Skill Name
                                            echo "<td>$skillName</td>";
                                            // Skill Level
                                            echo "<td>$skillLevel</td>";
                                            // Skill Period0
                                            echo "<td>$skillPeriod</td>";
                                            echo "</tr>";
                                            echo "</tbody>";
                                        }

                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="divide_r">
                            <div class="row portfolio-part">
                                <h3 class="content-subject">포트폴리오<a href="javascript:void(0);"
                                                                    class="m-button active rr" id="btn-seePort"><span>전체 포트폴리오 보기</span></a>
                                </h3>
                                <div class="tbl_type collection-center-small">
                                    <!-- TODO Insert Portfolio Thumbnail -->
                                    <ul>
                                        <?php
                                        /*
                                         * Download Images from the S3 Server
                                         * For Portfolio Usage
                                         */
                                        $userKey = $current_user->getUserKey();

                                        $images = $s3->getIterator('ListObjects', array(
                                            'Bucket' => $aws_config['s3']['bucket'],
                                            'Prefix' => "upload/portfolio/{$userKey}/"
                                        ));

                                        foreach ($images as $image) {
                                            echo "<li>";
                                            $img_link = $s3->getObjectUrl($aws_config['s3']['bucket'], $image['Key']);
                                            echo "<img src='$img_link' class='port-image-small'>";
                                            // echo "<a href='$img_link'>Download</a>";
                                            echo "</li>";
                                        }


                                        ?>
                                        <!-- <li><img src='./images/portfolio/sample_01.jpg' class='port-image-small'></li> -->
                                    </ul>
                                </div>

                            </div>
                            <div class="row career-part">
                                <h3 class="content-subject">경력 / 학력<a href="javascript:void(0);"
                                                                      class="m-button active rr"
                                                                      id="btn-seeCareer"><span>전체 경력 보기</span></a>
                                </h3>
                                <div class="tbl_type">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>이름</th>
                                            <th>기간</th>
                                            <th>직책</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        foreach ($user_career_list as $career) {
                                            $carrName = $career->getCarrNm();
                                            $carrPeriod = $career->getCarrPeriod();
                                            $carrType = $career->getCarrType();
                                            echo "<tbody>";
                                            echo "<tr>";
                                            echo "<td>$carrName</td>";
                                            echo "<td>$carrPeriod</td>";
                                            echo "<td>$carrType</td>";
                                            echo "</tr>";
                                            echo "</tbody>";
                                        }
                                        ?>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="tab2-eval">
                        <div class="divide_l">
                            <div class="row summary-part">
                                <h3 class="content-subject">평가 개요<a href="#"
                                                                    class="m-button active rr"><span>전체 평가 보기</span></a>
                                </h3>
                                <div class="row inside-value">
                                    <!-- DUMMY
                                    <progress value='60' max='100'></progress>
                                    <p class='overall-value'><strong>9</strong>점</p>
                                    <p>총 참여 프로젝트&nbsp;100건</p>
                                    <p>총 계약 금액 30,500,000 원</p>
                                    -->
                                    <?php
                                    echo "<progress value='$overallAverage' max='5'></progress>";
                                    echo "<p class='overall-value'><strong>$overallAverage</strong></p>";
                                    echo "<p>총 참여 프로젝트&nbsp;";
                                    echo count($user_rating_list);
                                    echo "&nbsp;건</p>";
                                    // TODO: MUST ADD 'Money earned' into the Database
                                    //echo "<p>총 계약 금액 30,500,000 원</p>";
                                    ?>
                                </div>


                            </div>

                        </div>
                        <div class="divide_r">
                            <div class="row portfolio-part">
                                <h3 class="content-subject">세부 평가</h3>
                                <div class="form_table">
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                        <col width='25%'/>
                                        <col width='75%'/>
                                        <tr>
                                            <th>전문성</th>
                                            <?php
                                            echo "<td><progress value='$profAverage' max='5'></progress></td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>의사소통</th>
                                            <?php
                                            echo "<td><progress value='$commAverage' max='5'></progress></td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>마감준수</th>
                                            <?php
                                            echo "<td><progress value='$timeAverage' max='5'></progress></td>";
                                            ?>
                                        <tr>
                                            <th>적극성</th>
                                            <?php
                                            echo "<td><progress value='$passionAverage' max='5'></progress></td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>제품만족도</th>
                                            <?php
                                            echo "<td><progress value='$workAgainAverage' max='5'></progress></td>";
                                            ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <h3 class="content-subject">참여한 프로젝트</h3>
                            <div class="tbl_type">
                                <table class="table-full">
                                    <thead>
                                    <tr>
                                        <th>프로젝트 제목</th>
                                        <th>계약 금액</th>
                                        <th>계약 기간</th>
                                        <th>클라이언트 평가</th>
                                    </tr>
                                    </thead>
                                    <!-- DUMMY
                                    <tbody>
                                    <tr>
                                        <td class="subject" data-title=""><a href=./project-intro.php?project=$projKey>$projName</a></td>
                                        <td data-title="계약 금액">$projPrice&nbsp;원</td>
                                        <td data-title="계약 기간">$projPeriod&nbsp;일</td>
                                        <td data-title="클라이언트 평가">미정</td>
                                    </tr>
                                    </tbody>
                                    -->
                                    <?php
                                    foreach ($user_rating_list as $user_rating) {
                                        require_once(__DIR__ . '/../class/project_list.php');
                                        $project_class = new project_list();
                                        $project_class->getDB(projKey, $user_rating->getProjKey());
                                        $project = $project_class->getProjList()[0];

                                        $projKey = $project->getProjKey();
                                        $projName = $project->getProjName();
                                        $projPrice = $project->getProjActPrice();
                                        $projPeriod = $project->getProjActPeriod();

                                        echo "<table>";
                                        echo "<tr>";
                                        echo "<td><a href=./project-intro.php?project=$projKey>$projName</a></td>";
                                        echo "<td>$projPrice&nbsp;원</td>";
                                        echo "<td>$projPeriod&nbsp;일</td>";
                                        echo "<td>미정</td>";
                                        echo "</tr>";
                                        echo "</table>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tab3-port">
                        <h3 class="content-subject">포트폴리오<a href="#" class="m-button active rr"
                                                            onclick="window.open('./content/portfolio_write.php', '포트폴리오추가', 'width=500, height=550, location=no, menubar=no, status=no, toolbar=no, left=400, top=100');"><span>포트폴리오 추가하기</span></a>
                        </h3>
                        <div class="tbl_type collection-center-large">
                            <!-- TODO Insert Image LARGE PORTFOLIO -->
                            <ul class="port-list">

                                <!-- <li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="네이버"
                                       href="./images/portfolio/sample_01.jpg"><img
                                            src='./images/portfolio/sample_01.jpg' class='port-image-large'>
                                        <p>네이버</p></a></li> -->
                                <?php
                                $portfolio_key = 0;
                                //$full_images = $images->rewind();
                                $userKey = $current_user->getUserKey();
                                $full_images = $s3->getIterator('ListObjects', array(
                                    'Bucket' => $aws_config['s3']['bucket'],
                                    'Prefix' => "upload/portfolio/{$userKey}"
                                ));
                                foreach ($full_images as $image) {
                                    $current_portfolio = $user_portfolio_list[$portfolio_key];
                                    $title = $current_portfolio->getPortNm();
                                    $explain = $current_portfolio->getPortExplain();
                                    $img_link = $s3->getObjectUrl($aws_config['s3']['bucket'], $image['Key']);
                                    echo "<li>";
                                    echo "<a class=\"fancybox-thumbs\" data-fancybox-group=\"thumb\" title=$title type='image' href=$img_link><img src=$img_link class='port-image-large'>";
                                    echo "<p>$title</p></a>";
                                    echo "<input type=\"hidden\" name=explain$portfolio_key id=explain$portfolio_key value='$explain'>";
                                    echo "<input type=\"hidden\" name=title$portfolio_key id=title$portfolio_key value='$title'>";
                                    echo "</li>";
                                    $portfolio_key = $portfolio_key + 1;
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div id="tab4-skill">
                        <h3 class="content-subject">보유 기술 및 자격증<a href="#"
                                                                  class="m-button active rr" id="js--add-skill"><span>기술 추가하기</span></a>
                        </h3>
                        <div class="tbl_type" id="fl-skill">
                            <table class="table-full">
                                <col width='50%'/>
                                <col width='20%'/>
                                <col width='20%'/>
                                <col width='10%'/>
                                <thead>
                                <tr>
                                    <th>기술명</th>
                                    <th>숙련도 및 등급</th>
                                    <th>사용기간(자격증의 경우 미기재)</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <!-- DUMMY
                                <tbody>
                                <tr>
                                    <td data-title="기술명">$skillName</td>
                                    <td data-title="숙련도 및 등급">$skillLevel</td>
                                    <td data-title="사용기간">$skillPeriod</td>
                                </tr>
                                </tbody>
                                -->
                                <?php
                                foreach ($user_skill_list as $skill) {
                                    $skillKey = $skill->getSkillKey();
                                    $skillName = $skill->getSkillNm();
                                    $skillLevel = $skill->getSkillLvl();
                                    switch ($skillLevel) {
                                        case 'level_1':
                                            $skillLevel = '1급';
                                            break;
                                        case 'level_2':
                                            $skillLevel = '2급';
                                            break;
                                        case 'level_3':
                                            $skillLevel = '3급';
                                            break;
                                        case 'level_low':
                                            $skillLevel = '초급';
                                            break;
                                        case 'level_middle':
                                            $skillLevel = '중급';
                                            break;
                                        case 'level_high':
                                            $skillLevel = '고급';
                                            break;
                                        case 'level_etc':
                                            $skillLevel = '기타';
                                            break;
                                    }
                                    $skillPeriod = $skill->getSkillPeriod();
                                    switch ($skillPeriod) {
                                        case 'veryshort':
                                            $skillPeriod = '1년 미만';
                                            break;
                                        case 'short':
                                            $skillPeriod = '1년 이상 3년 미만';
                                            break;
                                        case 'middle':
                                            $skillPeriod = '3년 이상 5년 미만';
                                            break;
                                        case 'long':
                                            $skillPeriod = '5년 이상 7년 미만';
                                            break;
                                        case 'verylong':
                                            $skillPeriod = '7년 이상 10년 미만';
                                            break;
                                        case 'expert':
                                            $skillPeriod = '10년 이상';
                                            break;
                                    }
                                    echo "<tbody>";
                                    echo "<tr>";
                                    // Skill Name
                                    echo "<td>$skillName</td>";
                                    // Skill Level
                                    echo "<td>$skillLevel</td>";
                                    // Skill Period
                                    echo "<td>$skillPeriod</td>";
                                    // Delete Skill
                                    echo "<td>";
                                    echo "<form method='post' action='' class='project-form'>";
                                    echo "<input type='hidden' name='skillKey' id='skillKey' value='$skillKey'>";
                                    echo "<a href='#' class='t-button color' id='btn-skillDelete'><span><i class='ion-close-round'></i>&nbsp;삭제</span></a>";
                                    echo
                                    '<script>
                                    $("#btn-skillDelete").click(function(){
                                       var skillKey = $("#skillKey").val();
                                      $.post("./lib/skill_delete_process.php", {skillKey: skillKey}).done(function (data) {
                                             alert(data);
                                            location.href="./sub.php?page=freelancer-profile";
                                           });
                                         });

                                    </script>';
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                    echo "</tbody>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>

                    <div id="tab5-career">

                        <h3 class="content-subject">경력 및 학력<a href="#" class="m-button active rr"
                                                              id="js--add-career"><span>경력 추가하기</span></a></h3>
                        <div class="tbl_type" id="fl-career">
                            <table class="table-full">
                                <thead>
                                <tr>
                                    <th>경력/학력명</th>
                                    <th>기간</th>
                                    <th>직책</th>
                                    <th>관리</th>
                                </tr>
                                </thead>
                                <!-- DUMMY
                                <tbody>
                                <tr>
                                    <td data-title="경력/학력명">$carrName</td>
                                    <td data-title="기간">$carrPeriod</td>
                                    <td data-title="직책">$carrType</td>
                                </tr>
                                </tbody>
                                -->
                                <?php
                                foreach ($user_career_list as $career) {
                                    $careerKey = $career->getCareerKey();
                                    $carrName = $career->getCarrNm();
                                    $carrPeriod = $career->getCarrPeriod();
                                    $carrType = $career->getCarrType();
                                    echo "<tbody>";
                                    echo "<tr>";
                                    echo "<td>$carrName</td>";
                                    echo "<td>$carrPeriod</td>";
                                    echo "<td>$carrType</td>";
                                    echo "<td>";
                                    echo "<form method='post' action='' class='project-form'>";
                                    echo "<input type='hidden' name='careerKey' id='careerKey' value='$careerKey'>";
                                    echo "<a href='#' class='t-button color' id='btn-careerDelete'><span><i class='ion-close-round'></i>&nbsp;삭제</span></a>";
                                    echo
                                    '<script>
                                    $("#btn-careerDelete").click(function(){
                                       var careerKey = $("#careerKey").val();
                                      $.post("./lib/career_delete_process.php", {careerKey: careerKey}).done(function (data) {
                                             alert(data);
                                            location.href="./sub.php?page=freelancer-profile";
                                           });
                                         });

                                    </script>';
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                    echo "</tbody>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
