<?php
/*
 * check session
 */
$project_key = $_GET['projId'];

session_start();

if (!isset($_SESSION['user_key'])) {
	header("Location: http://localhost/makebuy_web/index.php");
	exit();
}

require_once(__DIR__.'/../class/project_list.php');
require_once(__DIR__.'/../class/user_info.php');
require_once(__DIR__.'/../class/participant_list.php');

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
$projDescription = $project->getProjDescription();

$project->getProjectType($project_key);
$projTypes = $project->getProjTypes();
$projTypeList = "";

foreach($projTypes as $projType){
	$projTypeName = $projType->getProjType();
	$projTypeList = $projTypeList.$projTypeName."&nbsp;";
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
$participant_list_class->getDB('projKey',$project_key);

$participant_list = $participant_list_class->getPartList();
$participant_number = count($participant_list);
if($participant_number == null){
	$participant_number = 0;
}
?>

    <script>
        $(document).ready(function(){
			menu_over("프로젝트 찾기","프로젝트 찾기","1","0");
        })
    </script>
		<section class="section-project js--section-project">
			<div class='title' style='padding-bottom:30px;'>
				<h2>
					<?php echo $projName; ?>
					<div class='border'><span></span></div>
				</h2>
				<h3>
					<?php echo $projTypeList; ?>
					&nbsp;필요
					<span class="m-button active"><span><?php echo $projState; ?></span></span>
				</h3>
			</div>
			<div class="form_table">
				<table>
					<col width="15%">
					<col width="35%">
					<col width="15%">
					<col width="">
					<thead>
						<tr>
							<th>예상금액</th>
							<td><?php echo $projExpPrice; ?></td>
							<th>예상기한</th>
							<td><?php echo $projExpPeriod; ?></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>지원마감</th>
							<td><?php echo $projDeadLine; ?></td>
							<th>지원자</th>
							<td><?php echo $participant_number; ?>&nbsp;명</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>
<div class="sec2">
	<div class="container">
		<div class="tab-content">
            <div class='divide_l'>
				<h3 class="content-subject">&lt; 프로젝트 개요 &gt;</h3>
				<div class='tbl_type'>
					<table cellpadding='0' cellspacing='0' border='0' width='100%'>
						<tr>
							<td class='subject' style="height:74px;">
								<b><?php echo $projDescription; ?></b><br /><br />
								<br /><br />
							</td>
						</tr>
					</table>
				</div>
			</div>
            <div class='divide_r'>
				<h3 class="content-subject">&lt; 클라이언트 정보 &gt;</h3>
				<div class='form_table'>
					<table cellpadding='0' cellspacing='0' border='0' width='100%'>
						<col width="15%">
						<col width="">
						<tr>
							<th>이름:</th>
							<td><?php echo $client_name; ?></td>
						</tr>
						<tr>
							<th>평점:</th>
							<td>X 점</td>
						</tr>
						<tr>
							<th>소개</th>
							<td><?php echo $client_desc; ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="board_button">
				<?php echo "<a href='./sub.php?page=project-regist&projId=$project_key' class='b-button color'><span><i class='ion-checkmark-round'></i>프로젝트 지원하기</span></a>" ?>
				<a href="./sub.php?page=search-projects" class="b-button active"><span><i class="ion-refresh"></i>목록으로 돌아가기</span></a>
			</div>
		</div>
	</div>
</section>
