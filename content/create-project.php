<?php
/*
 * check session
 */
/*
session_start();
if (!isset($_SESSION['user_key'])) {
    header("Location: http://localhost/makebuy_web/index.php");
    exit();
} else if ($_SESSION['user_type'] == 'freelancer') {
    echo "<script>
                alert('프로젝트 등록은 클라이언트만 가능합니다');
                location.href='../content/freelancer-dashboard.php';
           </script>";
}
*/

/* in case of temporary saved */
if (isset($_GET['project'])) {

    /*
    require('../class/db.php');
    $db = new db();
    $connection = $db->connect();
    $projKey = $db->quote($_GET['project']);
    $_SESSION['project'] = $projKey; // save for temporary saved
    $sql = "SELECT * FROM project_tb WHERE projKey='$projKey'";
    $rows = $db->select($sql);

    $projName = $rows[0]['proj_nm'];
    //$budget = $rows[0]['']; just radio button
    $projBudget = $rows[0]['proj_price'];
    $projDue = $rows[0]['proj_period'];
    $projClass = $rows[0]['proj_class'];
    $projFieldIos = $rows[0]['proj_ios'];
    $projFieldAndroid = $rows[0]['proj_android'];
    $projFieldHybrid = $rows[0]['proj_hybrid'];
    $projDescription = $rows[0]['proj_desc'];
    $projMeeting = $rows[0]['proj_a_sido'];
    $projOffline = false;
    if ($projMeeting != 'online') {
        $projOffline = true;
    }
    $projEtc = $rows[0]['proj_etc'];
    $projAdmit = $rows[0]['proj_admit'];

    $sql = "SELECT * FROM project_type_tb WHERE projKey='$projKey'";
    $rows = $db->select($sql);
    $projSkillList = array();

    $i = 0;
    $j = count($rows);
//읽어온 데이터를 배열에 넣는다.
    while ($j > 0) {
        $row = $rows[$i];
        array_push($projSkillList, $row['t_skill']);
        $i = $i + 1;
        $j = $j - 1;
    }
    $projSill = $projSkillList[0]; //tag apply 전에 임시로 표시해놓은거임
    */

    $project_key = $db->quote($_GET['project']);
    $_SESSION['project'] = $project_key;

    require_once(__DIR__ . '/../class/project_list.php');
    $project_list_class = new project_list();
    $project_list_class->getDB('projKey', $_GET['project']);

    $project = $project_list_class->getProjList();
    $project = $project[0];

    $project_name = $project->getProjName();
    $project_scale = $project->getProjScale(); // TODO: Add in project.php & project_list.php
    $project_exp_price = $project->getProjExpPrice();
    $project_exp_period = $project->getProjExpPeriod();
    $project_deadline = $project->getProjDeadLine();
    $project_sort = $project->getProjSort(); // TODO: Add in project.php & project_list.php
    $project_desc = $project->getProjDesc();
    $project_planning = $project->getProjPlanning();
    $project_meeting = $project->getProjMeeting();
    $project_sc = $project->getProjSourceCode();

    $project_is_native = $project->getProjNative(); // TODO: Add in project.php & project_list.php
    $project_is_hybrid = $project->getProjHybrid();
    $project_is_mobile = $project->getProjMobile();

    $project_type = $project->getProjTypes();

}

?>


<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="./css/jquery.tagit.css">

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> -->

<script src="./js/tag-it.js"></script>
<!-- <script src="./js/script.js"></script> -->
<!--<script src="js/jquery.meanmenu.js"></script> -->
<script>
    $(document).ready(function(){
        jQuery('.tabs ul li a').on('click', function(e)  {
            var currentAttrValue = jQuery(this).attr('href');
            // Show/Hide Tabs
            jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
            // Change/remove current tab to active
            jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

            e.preventDefault();
        });
        menu_over("","","5","2");
    })
</script>
<section class="section-create-form js--section-signup-form">
    <form method="post" action="./lib/project_process.php" class="project-form" enctype="multipart/form-data">
    <div class='title'>
        <h3 style='padding-bottom:10px;'>이미 기획안이 있으신가요? 그렇다면</h3>
        <h2>
            프로젝트 일반
            <div class='border'><span></span></div>
        </h2>
    </div>
    <div class="form_table">
        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
            <col width='20%'/>
            <col width='*'/>
            <tr>
                <th>프로젝트 이름</th>
                <td><input type="text" name="proj-name" id="proj-name" placeholder="프로젝트명을 입력하세요"
                           value="<?php echo $project_name; ?>" required/></td>
            </tr>
            <tr>
                <th>프로젝트 규모</th>
                <td>
                    <form class="likert-scale">
                        <input type="radio" name="proj-scale" value="tiny"
                               id="tiny" <?php if ($project_scale == 'tiny') {
                            echo checked;
                        } ?>><label for="tiny">매우 작음</label>
                        <input type="radio" name="proj-scale" value="small"
                               id="small" <?php if ($project_scale == 'small') {
                            echo checked;
                        } ?>><label for="small">작음</label>
                        <input type="radio" name="proj-scale" value="medium"
                               id="medium" <?php if ($project_scale == 'medium') {
                            echo checked;
                        } ?>><label for="medium">중간</label>
                        <input type="radio" name="proj-scale" value="big" id="big" <?php if ($project_scale == 'big') {
                            echo checked;
                        } ?>><label for="big">큼</label>
                        <input type="radio" name="proj-scale" value="group"
                               id="group" <?php if ($project_scale == 'group') {
                            echo checked;
                        } ?>><label for="group">그룹</label>
                    </form>
                </td>
            </tr>
            <tr>
                <th>프로젝트 예산</th>
                <td>
                    <!-- AUTO NUMERIC LIBRARY GOES HERE -->
                    <input type="text" name="proj-exp-price" id="proj-exp-price" placeholder="예산을 입력하세요"
                           value="<?php echo $project_exp_price; ?>" required>
                </td>
            </tr>
            <tr>
                <th>프로젝트 기간</th>
                <td>
                    <input type="text" name="proj-exp-period" id="proj-exp-period" placeholder="기간을 입력하세요"
                           value="<?php echo $project_exp_period; ?>" required>
                </td>
            </tr>
        </table>
    </div>
    <div class='title' style='padding-top:50px;'>
        <h2>
            프로젝트 기획
            <div class='border'><span></span></div>
        </h2>
    </div>
    <div class="form_table">
        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
            <col width='20%'/>
            <col width='*'/>
            <tr>
                <th>프로젝트 분류</th>
                <td>
                    <select class="dropdown" name="proj-sort">
                        <option value="new" <?php if ($project_sort == 'new') {
                            echo "selected = selected";
                        } ?>>신규 제작
                        </option>
                        <option value="main" <?php if ($project_sort == 'main') {
                            echo "selected = selected";
                        } ?>>유지보수
                        </option>
                        <option value="module" <?php if ($project_sort == 'module') {
                            echo "selected = selected";
                        } ?>>부분 제작
                        </option>
                        <option value="modify" <?php if ($project_sort == 'modify') {
                            echo "selected = selected";
                        } ?>>개선
                        </option>
                        <option value="consult" <?php if ($project_sort == 'consult') {
                            echo "selected = selected";
                        } ?>>상담 및 조언
                        </option>
                        <option value="etc" <?php if ($project_sort == 'etc') {
                            echo "selected = selected";
                        } ?>>기타
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>프로젝트 분야</th>
                <td>
                    <input type="checkbox" name="proj-class-native" id="proj-field"
                           value="native" <?php if ($project_is_native) {
                        echo "checked";
                    } ?>>
                    <label>네이티브</label>
                    <input type="checkbox" name="proj-class-hybrid" id="proj-field"
                           value="hybrid" <?php if ($project_is_hybrid) {
                        echo "checked";
                    } ?>>
                    <label>하이브리드</label>
                    <input type="checkbox" name="proj-class-mobile" id="proj-field"
                           value="mobile" <?php if ($project_is_mobile) {
                        echo "checked";
                    } ?>>
                    <label>모바일웹-앱</label>
                </td>
            </tr>
            <tr>
                <th>필요 기술</th>
                <td>
                    <ul id="proj-skill" class="tagit ui-widget ui-widget-content ui-corner-all"></ul>
                </td>
            </tr>
            <tr>
                <th>프로젝트 설명</th>
                <td>
                    <textarea name="proj-desc" id="proj-desc" placeholder="&nbsp;< 프로젝트 진행방식 >"
                              style='width:99%;'><?php echo $project_desc; ?></textarea>
                </td>
            </tr>
            <tr>
                <th>프로젝트 기획서</th>
                <td class='board_button'>
                    <a href="javascript:void(0);" class="m-button active" onclick="projectHelper();"><span><i class="ion-help"></i>프로젝트 도우미</span></a>
                    <script>
                        function projectHelper(){
                            alert("준비 중입니다. 이제 곧 만나보실 수 있습니다!");;
                        }
                    </script>
                    <a href="javascript:void(0);" id="upload-planning" class="m-button active"><span><i class="ion-arrow-up-c"></i>기획서 업로드</span></a>
                    <input type="file" id="project-plan" name="project-plan" style="display: none;">
                    <div id="plan-filename"></div>
                    <script>
                        $("#upload-planning").on('click', function(){
                            $('#project-plan').trigger('click');
                            $('input[type=file]').change(
                                function(e){
                                    var name = e.target.files[0].name;
                                    $('#plan-filename').replaceWith('<div id="plan-filename" style="color:#000;margin-top:1%"><p>'+ name +'<p></div>');
                                }
                            )
                        })

                    </script>
                    <!-- <a href="#" class="m-button normal"><span><i class="ion-checkmark-round"></i>업로드 완료</span></a> -->
                </td>
            </tr>
        </table>
    </div>
    <div class='title' style='padding-top:50px;'>
        <h2>
            프로젝트 진행사항
            <div class='border'><span></span></div>
        </h2>
    </div>
    <div class="form_table">
        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
            <col width='20%'/>
            <col width='*'/>
            <tr>
                <th>프로젝트 회의 장소</th>
                <td>
                    <select name="proj-meeting" class="dropdown">
                        <option value="online" <?php if ($project_meeting == 'online') {
                            echo "selected = selected";
                        } ?>>온라인 회의
                        </option>
                        <option value="none" <?php if ($project_meeting == 'none') {
                            echo "selected = selected";
                        } ?>>해당사항 없음
                        </option>
                        <option value="seoul" <?php if ($project_meeting == 'seoul') {
                            echo "selected = selected";
                        } ?>>서울
                        </option>
                        <option value="kyunggi" <?php if ($project_meeting == 'kyunggi') {
                            echo "selected = selected";
                        } ?>>경기도
                        </option>
                        <option value="kangwon" <?php if ($project_meeting == 'kangwon') {
                            echo "selected = selected";
                        } ?>>강원도
                        </option>
                        <option value="chungcheong" <?php if ($project_meeting == 'chungcheong') {
                            echo "selected = selected";
                        } ?>>충청도
                        </option>
                        <option value="jeolla" <?php if ($project_meeting == 'jeolla') {
                            echo "selected = selected";
                        } ?>>전라도
                        </option>
                        <option value="kyungsang" <?php if ($project_meeting == 'kyungsang') {
                            echo "selected = selected";
                        } ?>>경상도
                        </option>
                        <option value="jeju" <?php if ($project_meeting == 'jeju') {
                            echo "selected = selected";
                        } ?>>제주도
                        </option>
                    </select>
    </div>
    </tr>
    <tr>
        <th>소스코드 제공</th>
        <td>
            <input type="checkbox" name="proj-sc" id="proj-sc" value="proj_sc" <?php if ($project_sc) {
                echo "checked";
            } ?>>
        </td>
    </tr>
    </table>
    </div>
    <div class="board_button">
        <span class="b-button color"><input type="submit" value="프로젝트 등록" id="project-button" name="projSubmit"/></span>
        <span class="b-button active"><input type="submit" value="임시저장" id="project-button" name="tmpSave"></span>
    </div>
    </form>

    <script>
        $(document).ready(function () {

            $("#proj-skill").tagit();
            menu_over("", "", "0", "0");

            var skills = [];
            var skill_list;
            $("#project-button").on('click', function (event) {
                $("#proj-skill .tagit-label").each(function (index, el) {
                    // alert($(el).html());
                    skills.push($(el).html());
                });
                skills = skills.join(',');
                $.post("./lib/project_type_process.php", {proj_skill: skills});
            });
        })
    </script>
</section>
