<?php
/*
 * Check Session
 */
$project_key = $_GET['projId'];

/*
session_start();

if (!isset($_SESSION['user_key'])) {
    header("Location: http://localhost/makebuy_web/index.php");
    exit();
}
*/

require_once(__DIR__ . '/../class/project_list.php');
require_once(__DIR__ . '/../class/user_info.php');
require_once(__DIR__ . '/../class/participant_list.php');

$_SESSION['project'] = $project_key;

// Load Project Info
$project_list_class = new project_list();
$project_list_class->getDB('projKey', $project_key);

$project = $project_list_class->getProjList();
$project = $project[0];

$projName = $project->getProjName();
$projExpPrice = $project->getProjExpPrice();
$projExpPeriod = $project->getProjExpPeriod();
$projState = $project->getProjState();
$projDeadLine = $project->getProjDeadLine();
$projMeeting = $project->getProjMeeting();

switch ($projMeeting) {
    case 'online':
        $projMeeting = "온라인";
        break;
    case 'none':
        $projMeeting = "희망하지 않음";
        break;
    case 'seoul':
        $projMeeting = "서울";
        break;
    case 'kyunggi':
        $projMeeting = "경기도";
        break;
    case 'kangwon':
        $projMeeting = "강원도";
        break;
    case 'kyungsang':
        $projMeeting = "경상도";
        break;
    case 'jeolla':
        $projMeeting = "전라도";
        break;
    case 'chungcheong':
        $projMeeting = "충청도";
        break;
    case 'jeju':
        $projMeeting = "제주도";
        break;
}
$projDescription = $project->getProjDescription();

$projNative = $project->getProjNative();
$projHybrid = $project->getProjHybrid();
$projMobile = $project->getProjMobile();

$projClassName = "";
if ($projNative == 1) {
    $projClassName = $projClassName . "네이티브 ";
}
if ($projHybrid == 1) {
    $projClassName = $projClassName . "하이브리드 ";
}
if ($projMobile == 1) {
    $projClassName = $projClassName . "웹앱";
}

$project->getProjectType($project_key);
$projTypes = $project->getProjTypes();
$projTypeList = "";

foreach ($projTypes as $projType) {
    $projTypeName = $projType->getProjType();
    $projTypeList = $projTypeList . $projTypeName . "&nbsp;";
}

// $projTypes = implode(", ", $projTypes);

// Load Client Info
$user_info_class = new user_info();
$user_info_class->getDB($project->getClientKey());

$user_info = $user_info_class->getCurrentUser();
$client_name = $user_info->getUserId();
$client_desc = $user_info->getUserDesc();

// Load Project Participant List
$participant_list_class = new participant_list();
$participant_list_class->getDB('projKey', $project_key);

$participant_list = $participant_list_class->getPartList();
$participant_number = count($participant_list);
if ($participant_number == null) {
    $participant_number = 0;
}

$projBidPrice = 0;
foreach ($participant_list as $participant) {
    $projBidPrice = $projBidPrice + ($participant->getBidPrice());
}

if ($participant_number != 0) {
    $projBidPrice = $projBidPrice / $participant_number;
}
?>
<script>
    $(document).ready(function () {
        menu_over("프로젝트 등록", "프로젝트 등록", "0", "0");
        webshim.activeLang('en');
        webshims.polyfill('forms');
        webshims.cfg.no$Switch = true;
    })
</script>
<section class="section-project-search js--section-project-search">
    <div class='title'>
        <h2>
            <qq style="color:#09b262;font-weight:600"><?php echo "'" . $projName . "'" ?></qq> 지원하기
            <div class='border'><span></span></div>
        </h2>
    </div>
    <div class="form_table">
        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
            <col width='15%'/>
            <col width='35%'/>
            <col width='15%'/>
            <col width='*'/>
            <tr>
                <th>프로젝트명</th>
                <td><?php echo $projName; ?></td>
                <th>필요기술</th>
                <td><?php echo $projTypeName; ?>&nbsp;필요</td>
            </tr>
            <tr>
                <th>예상기한</th>
                <td><?php echo $projExpPeriod; ?></td>
                <th>지원마감</th>
                <td><?php
                    $projDeadLine =  date('m-d',strtotime($projDeadLine));
                    echo $projDeadLine; ?></td>
            </tr>
            <tr>
                <th>분류</th>
                <td><?php echo $projClassName; ?></td>
                <th>미팅지역</th>
                <td><?php echo $projMeeting; ?></td>
            </tr>
        </table>
    </div>
    <div class="tab-content" style='margin-top:15px;'>
        <div class="tbl_type">
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                <col width='33%'/>
                <col width='33%'/>
                <col width='*'/>
                <thead>
                <tr>
                    <th>지원자수</th>
                    <th>평균입찰가</th>
                    <th>예상금액</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td data-title="지원자수"><h3><?php echo number_format($participant_number); ?></h3> 명</td>
                    <td data-title="평균입찰가"><h3><?php echo number_format($projBidPrice); ?></h3> 원</td>
                    <td data-title="예상금액"><h3><?php echo number_format($projExpPrice); ?></h3> 원</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>
</div>
<div class='sec2'>
    <div class='container'>
        <section class="section-search-result js--section-search-result">
            <form method="post" id="register-proj-form" action="./lib/project_register_process.php">
                <div class='title' style="padding-bottom:0px;">
                    <h2>
                        지원서 작성하기
                        <div class='border'><span></span></div>
                    </h2>
                </div>
                <div class="tab-content">
                    <section>
                        <div class="form_table">
                            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                <col width="20%"/>
                                <col/>
                                <tr>
                                    <th>지원&nbsp;금액</th>
                                    <td>
                                        <input type="text" name="bid-price" id="bid-price"
                                               placeholder="희망 금액을 원 단위로 입력해 주세요" required/>
                                        <div class="help-message">
                                            <p class="help-indicator">주의</p>
                                            <p class="price-message">메이크바이 수수료 10%를 포함한 가격입니다.</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>지원&nbsp;기간</th>
                                    <td><input type="text" name="bid-period" id="bid-period" placeholder="희망 기간을 일 단위로 입력해주세요"
                                               required/></td>
                                </tr>
                                <tr>
                                    <th>지원&nbsp;내용</th>
                                    <td>
                                        <textarea class="" name="bid-content" id="bid-content"
                                                  placeholder="프로젝트에 대한 분석 및 관련 경험 " required></textarea>
                                        <div class="help-message">
                                            <p class="help-indicator">주의</p>
                                            <p class="content-message">전화번호나 이메일을 게시하여 직거래 유도 시에는 서비스 이용에 제재를 받을 수
                                                있습니다.</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="board_button">
                            <!-- <span class="b-button color"><button type="submit" id="register-button" name="projRegister"><i class="ion-checkmark"></i>지원하기</button></span> -->
                            <!-- <span class="b-button active"><button type="submit" id="register-button" name="projRegister"><i class="ion-refresh"></i>돌아가기</button></span> -->
                             <a href="javascript:void(0);" id="btn-register-proj" class="b-button color"><span><i class="ion-checkmark"></i>지원하기</span></a>
                            <button type="submit" class="hide" style="display:none"></button>
                                <script>
                                    $('#btn-register-proj').click(function(){
                                        $('.board_button').find('[type="submit"]').trigger('click');
                                    })
                                </script>
                             <a href='./sub.php?page=project-intro&projId=<?php echo $project_key?>' class="b-button active"><span><i class="ion-refresh"></i>취소</span></a>
                        </div>
                    </section>
                </div>
            </form>
        </section>

    </div>
</div>
