<?php
/**
 * Created by PhpStorm.
 * User: Junho
 * Date: 2016-03-25
 * Time: 오전 2:37
 */
session_start();
if (!isset($_SESSION['user_key'])) {
    // If no user logged in
    echo "<script>
            alert('로그인 후 이용해주십시오');
            location.href='../sub.php?page=login'";
} //주소창으로 접근하는경우

require_once(__DIR__ . '/../class/project_list.php');
require_once(__DIR__ . '/../class/project_type_list.php');
$name = '';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
};
$skill= '';
if (isset($_POST['skill'])) {
    $skill = $_POST['skill'];
};
$type = $_POST['type'];

// Project List
$load_project_list = new project_list();
//if there isn't search query, select all projects data
if($_POST['name'] == '' && $_POST['skill'] == ''){
    $load_project_list->getDisplayDB();
}
elseif($_POST['name'] != ''){
    $load_project_list->getNameSearchDB($_POST['name']);
}
elseif($_POST['skill'] != ''){
    //project_type_list
    $load_project_type_list = new project_type_list();
    $load_project_type_list->getSearchedDB($_POST['skill']);
    $project_type_list = array();
    $project_type_list = $load_project_type_list->getProjTypeList();

    $load_project_list->getSkillSearchDB($project_type_list);

}
$project_list = $load_project_list->getProjList();
$recruit_project_list = array(); // List of Projects in RECRUITING Process
$finish_project_list = array(); // List of Projects in FINISH Progress

foreach ($project_list as $project) {
    if ($project->getProjState() == 'recruit') {
        array_push($recruit_project_list, $project);
    } else if ($project->getProjState() == 'finish') {
        array_push($finish_project_list, $project);
    }
}
/////////////////////////////////
/*sort project with given condition(tab type)*/
switch($type){
    case 'recent':
        //sort project by upload time
        function compare_upload($a, $b)
        {
            if ($a->getProjUploadDate() == $b->getProjUploadDate()) {
                return 0;
            }
            return ($a->getProjUploadDate() > $b->getProjUploadDate()) ? -1 : 1;
        }

        usort($project_list, 'compare_upload');break;
    case 'high':
        //sort project by high price
        function compare_high($a, $b)
        {
            if ($a->getProjExpPrice() == $b->getProjExpPrice()) {
                return 0;
            }
            return ($a->getProjExpPrice() > $b->getProjExpPrice()) ? -1 : 1;
        }

        usort($project_list, 'compare_high');break;
    case 'low':
        //sort project by low
        function compare_low($a, $b)
        {
            if ($a->getProjExpPrice() == $b->getProjExpPrice()) {
                return 0;
            }
            return ($a->getProjExpPrice() < $b->getProjExpPrice()) ? -1 : 1;
        }

        usort($project_list, 'compare_low');break;
    case 'deadline':
        //sort project by deadline
        function compare_deadline($a, $b)
        {
            if ($a->getProjDeadLine() == $b->getProjDeadLine()) {
                return 0;
            }
            return ($a->getProjDeadLine() < $b->getProjDeadLine()) ? -1 : 1;
        }

        usort($project_list, 'compare_deadline');break;
    default: break;
}


echo '<div class="tbl_type">
                            <table>
                                <col/>
                                <col width="15%"/>
                                <col width="15%"/>
                                <col width="12%"/>
                                <col width="12%"/>
                                <thead>
                                <tr>
                                    <th>프로젝트명(내용)</th>
                                    <th>예상금액</th>
                                    <th>지원마감</th>
                                    <th>예상기한</th>
                                    <th>지원자</th>
                                </tr>
                                </thead>';

foreach ($project_list as $project) {
    $project_key = $project->getProjKey();
    $project_state = $project->getProjState();
    $project_name = $project->getProjName();
    $projExpPrice = $project->getProjExpPrice();
    $projDeadLine = $project->getProjDeadLine();
    $projExpPeriod = $project->getProjExpPeriod();
    $project_participant_list = $project->getProjParticipants();
    $project_type_list = $project->getProjTypes();
    if ($project_state == 'finish') {
        echo "<tbody class='disable'>";
        echo "<tr>";
        echo "<td class=\"subject\"><span class=\"t-button active\"><span>마감</span></span>&nbsp;<a href=\"./sub.php?page=project-intro&projid=$project_key\"><b>$project_name</b></a>&nbsp;";
        if ($project_type_list != null) {
            echo "(";
            foreach ($project_type_list as $project_type) {
                $type = $project_type->getProjType();
                echo "$type, ";
            }
            echo "필요)";
        }
        echo "</p></td>";
        echo '<td data-title=예상금액>' . number_format($projExpPrice) . '</td>';
        echo "<td data-title=지원마감>$projDeadLine 전</td>";
        echo "<td data-title=예상기한>$projExpPeriod 일</td>";
        echo '<td data-title=지원자>' . count($project_participant_list) . ' 명</td>';
        echo "</tr>";
        echo "</tbody>";
    } else {
        echo "<tbody>";
        echo "<tr>";
        echo "<td class=\"subject\"><span class=\"t-button color\"><span>모집중</span></span>&nbsp;<a href=\"./sub.php?page=project-intro&projid=$project_key\"><b>$project_name</b></a>&nbsp;";
        if ($project_type_list != null) {
            echo "(";
            foreach ($project_type_list as $project_type) {
                $type = $project_type->getProjType();
                echo "$type, ";
            }
            echo "필요)";
        }
        echo "</p></td>";
        echo '<td data-title=예상금액>' . number_format($projExpPrice) . '</td>';
        echo "<td data-title=지원마감>$projDeadLine 전</td>";
        echo "<td data-title=예상기한>$projExpPeriod 일</td>";
        echo '<td data-title=지원자>' . count($project_participant_list) . ' 명</td>';
        echo "</tr>";
        echo "</tbody>";
    }
}

echo '
</table>
</div>
<div class="col span-5-of-7 result-detail result-detail-spec"></div>'

?>