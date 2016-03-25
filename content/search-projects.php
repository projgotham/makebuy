<?php
/*
 * check session
 */
session_start();
if (!isset($_SESSION['user_key'])) {
    header("Location: http://localhost/makebuy_web/index.php");
    exit();
}

require_once(__DIR__.'/../class/project_list.php');

// Project List
$load_project_list = new project_list();
//if there isn't search query, select all projects data
if(!isset($_GET['query'])){
    $load_project_list->getDisplayDB();
}
else{
    $load_project_list->getNameSearchDB($_GET['query']);
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

?>
<style>
    @media only screen and (max-width: 767px) {
        section .title {
            padding-bottom: 10px;
        }

        .divide_r {
            padding-top: 0px;
        }

        .divide_r table {
            border-top: none;
        }

        .tab-content section table tbody {
            padding-bottom: 10px;
        }

        .tab-content section table tbody tr td:last-child {
            border-bottom: 1px solid #e1e5e3;
        }
    }
</style>
<script>
    $(document).ready(function () {
        menu_over("프로젝트 찾기", "프로젝트 찾기", "1", "0");
    })
</script>
<section class="section-project-search js--section-project-search">
    <div class='title'>
        <h2>
            분류별 검색
            <div class='border'><span></span></div>
        </h2>
    </div>
    <div class="form_table">
        <div class='divide_l'>
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                <col width='20%'/>
                <col width='*'/>
                <col width='15%'/>
                <form id="name-search-form" action="" method="post">
                    <tr>
                        <th>이름</th>
                        <td>
                            <input type="text" name="name" id="name" value="<?php echo $_GET['query'];?>"><!-- //leave it for user recognize he or she searched what -->
                        </td>
                        <td style='border-left:none;'>
                            <a class="t-button color" id="name-search" href="#"><span>검색</span></a>
                            <script>
                                $(function() {
                                    $("#name-search").bind('click',function() {
                                        var value = $('#name').val();
                                        //if there isn't search data, just refresh current page
                                            window.location.href = './sub.php?page=search-projects&query=' + value;
                                    });
                                });
                            </script>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
        <div class='divide_r'>
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                <col width='20%'/>
                <col width='*'/>
                <col width='15%'/>
                <tr>
                    <th>기술명</th>
                    <td>
                        <input type="text" name="skill" id="skill">
                    </td>
                    <td style='border-left:none;'>
                        <a class="t-button color" href="#"><span>검색</span></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</section>
</div>
</div>
<div class='sec2'>
    <div class='container'>
        <section class="section-search-result js--section-search-result">
            <div class='title'>
                <h2 style='font-size:20px;'>
                    총 <b class="color1"><?php echo count($project_list) ?></b>건의 프로젝트가 등록되었습니다.
                    <div class='border'><span></span></div>
                </h2>
            </div>
            <div class="tabs">
                <div class='tab_list'>
                    <ul>
                        <li class="divide-recent"><a href="#tab1-recent">최신 순</a></li>
                        <script>
                            $(function() {
                                $(".divide-recent").bind('click',function() {
                                    var value = $('#name').val();
                                    $.post('./lib/name_search.php', {name: value, type: 'recent'},function(data){

                                        $("#tab1-recent").html(data);
                                    });
                                    return false;
                                });
                            });
                        </script>
                        <li class="divide-high"><a href="#tab2-high">높은 금액 순</a></li>
                        <script>
                            $(function() {
                                $(".divide-high").bind('click',function() {
                                    var value = $('#name').val();
                                    $.post('./lib/name_search.php', {name: value, type: 'high'},function(data){

                                        $("#tab2-high").html(data);
                                    });
                                    return false;
                                });
                            });
                        </script>
                        <li class="divide-low"><a href="#tab3-low">낮은 금액 순</a></li>
                        <script>
                            $(function() {
                                $(".divide-low").bind('click',function() {
                                    var value = $('#name').val();
                                    $.post('./lib/name_search.php', {name: value, type: 'low'},function(data){

                                        $("#tab3-low").html(data);
                                    });
                                    return false;
                                });
                            });
                        </script>
                        <li class="divide-deadline"><a href="#tab4-deadline">마감임박 순</a></li>
                        <script>
                            $(function() {
                                $(".divide-deadline").bind('click',function() {
                                    var value = $('#name').val();
                                    $.post('./lib/name_search.php', {name: value, type: 'deadline'},function(data){

                                        $("#tab4-deadline").html(data);
                                    });
                                    return false;
                                });
                            });
                        </script>
                    </ul>
                </div>

                <div class="tab-content">
                    <section id="tab1-recent" class="tab active">
                        <div class="tbl_type">
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
                                </thead>
                                <?php
                                //sort project by upload time
                                function compare_upload($a, $b)
                                {
                                    if ($a->getProjUploadDate() == $b->getProjUploadDate()) {
                                        return 0;
                                    }
                                    return ($a->getProjUploadDate() > $b->getProjUploadDate()) ? -1 : 1;
                                }

                                usort($project_list, 'compare_upload');

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
                                        echo '<td data-title=\"예상금액\">' . number_format($projExpPrice) . '</td>';
                                        echo "<td data-title=\"지원마감\">$projDeadLine 전</td>";
                                        echo "<td data-title=\"예상기한\">$projExpPeriod 일</td>";
                                        echo '<td data-title=\"지원자\">' . count($project_participant_list) . ' 명</td>';
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
                                        echo '<td data-title=\"예상금액\">' . number_format($projExpPrice) . '</td>';
                                        echo "<td data-title=\"지원마감\">$projDeadLine 전</td>";
                                        echo "<td data-title=\"예상기한\">$projExpPeriod 일</td>";
                                        echo '<td data-title=\"지원자\">' . count($project_participant_list) . ' 명</td>';
                                        echo "</tr>";
                                        echo "</tbody>";
                                    }
                                }
                                ?>
                            </table>
                        </div>
                        <div class="col span-5-of-7 result-detail result-detail-spec"></div>
                    </section>

                    <section id="tab2-high" class="tab">
                        <div class="tbl_type">
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
                                </thead>
                            </table>
                        </div>
                        <div class="col span-5-of-7 result-detail result-detail-spec"></div>
                    </section>

                    <section id="tab3-low" class="tab">
                        <div class="tbl_type">
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
                                </thead>
                            </table>
                        </div>
                        <div class="col span-5-of-7 result-detail result-detail-spec"></div>
                    </section>

                    <section id="tab4-deadline" class="tab">
                        <div class="tbl_type">
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
                                </thead>
                            </table>
                        </div>
                        <div class="col span-5-of-7 result-detail result-detail-spec"></div>
                    </section>

                </div>
            </div>
        </section>
