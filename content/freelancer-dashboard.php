<?php
/*
 * check session
 */
session_start();
if (!isset($_SESSION['user_key'])) {
	header("Location: http:/localhost/makebuy_web/index.php");
	exit();
} else if ($_SESSION['user_type'] == 'client') {
	header("Location: http:/localhost/makebuy_web/content/client-dashboard.php");
	exit();
}

require_once(__DIR__.'/../class/project_list.php');
require_once(__DIR__.'/../class/participant_list.php');
require_once (__DIR__."/../class/announce_list.php");

//SECTION. Announce_list
$load_announce_list = new announce_list();
$load_announce_list->getDB();
$announce_list = $load_announce_list->getAnnounceList();

// SECTION 1. Participant_List
$load_participant_user = new participant_list();
$load_participant_user->getSelectedDB(flKey, $_SESSION['user_key'], 'apply');
$user_participation_list = $load_participant_user->getPartList();
// Project_List
$project_list = new project_list();

foreach($user_participation_list as $participation){
	$project_list->getDB("projKey", $participation->getProjKey());
}
// Result for Full Applied List (USE THIS FOR APPLY LIST)
$part_project_list = $project_list->getProjList();

// SECTION 2. Selected_Participant_List
$load_selected_user = new participant_list();
$load_selected_user->getSelectedDB(flKey, $_SESSION['user_key'], 1);
$user_selected_list = $load_selected_user->getPartList();
// Selected Project LIST
$selected_project_list = new project_list();

foreach($user_selected_list as $selected){
	$selected_project_list->getDB("projKey", $selected->getProjKey());
}
// Result for Full Selected List (USE THIS FOR ONLY SELECTED PROJECTS)
$fl_selected_project_list = $selected_project_list->getProjList();
?>

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
		<section class='divide_l'>
			<div class='title'>
				<h2>
					새로운 소식
					<div class='border'><span></span></div>
				</h2>
			</div>
			<div class="tbl_type">
				<table>
					<col width='*' />
					<col width='20%' />
					<col width='20%' />
					<thead>
					<tr>
						<th>전달내용</th>
						<th>전달자</th>
						<th>날짜</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td class="subject" data-title=''><a target="_blank" href="http://blog.naver.com/makebuy/220657670038">프리랜서01: 인기 있는 프리랜서가 되는 법</a></td>
						<td data-title='전달자'>메이크바이</td>
						<td data-title='날짜'>03-17</td>
					</tr>
					</tbody>
					<tbody>
					<tr>
						<td class="subject" data-title=''><a target="_blank" href="http://blog.naver.com/makebuy/220642483066">클라이언트02: 어떤 플랫폼에 만들어야할까?</a></td>
						<td data-title='전달자'>메이크바이</td>
						<td data-title='날짜'>03-01</td>
					</tr>
					</tbody>
					<tbody>
						<tr>
							<td class="subject" data-title=''><a target="_blank" href="http://blog.naver.com/makebuy/220639020678">클라이언트01: 내 앱은 어떻게 만들어야할까?</a></td>
							<td data-title='전달자'>메이크바이</td>
							<td data-title='날짜'>02-26</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
		<section class='divide_r'>
			<div class='title'>
				<h2>
					공지사항
					<div class='border'><span></span></div>
				</h2>
			</div>
			<div class="tbl_type">
				<table>
					<col width='*' />
					<col width='20%' />
					<thead>
					<tr>
						<th>공지내용</th>
						<th>날짜</th>
					</tr>
					</thead>
					<?php
					foreach(array_slice($announce_list, 0, 3) as $announce_item){
						echo "<tbody>";
						echo "<tr>";
						$title = $announce_item->getTopic();
						$number = $announce_item->getKey();
						echo "<td class='subject'><a target=\"_blank\" href=./sub.php?page=notice_view&list=1&id=$number>".$title."</a></td>";
						$date = $announce_item->getDate();
						$date =  date('m-d',strtotime($date));
						echo "<td data-title='날짜' class=\"nums\">".$date."</td>";
						echo "</tr>";
						echo "</tbody>";
					}
					?>
					</table>
			</div>
		</section>
	</div>
</div>
<div class="sec2">
	<div class="container">
		<section class="section-status js--section-status">
			<div class="tabs" style="clear:both;">
				<div class="tab_list">
					<ul>
                        <li class="active"><a href="#tab1-activity">나의 활동</a></li>
                        <li><a href="#tab2-auth">본인 인증</a></li>
					</ul>
				</div>

				<div class="tab-content">
					<section id="tab1-activity" class="active">
						<div class="row skill-part">
							<h3 class="content-subject">&nbsp;&nbsp;지원중인 프로젝트</h3>
							<div class="tbl_type">
								<table>
									<col width="" />
									<col width="15%" />
									<col width="15%" />
									<col width="15%" />
									<col width="15%" />
									<thead>
										<tr>
											<th class='subject'>프로젝트명</th>
											<th>마감일</th>
											<th>예상기한</th>
											<th>예산</th>
											<th>지원자</th>
										</tr>
									</thead>
									<?php
									foreach($part_project_list as $project){
										echo "<tbody>";
										echo "<tr>";
										echo "<td class='subject', data-title='프로젝트명'><a href=./project-intro.php?project=$projKey>".$projName."</a></td>";
										echo "<td data-title='마감일'>".date('m-d',strtotime($project->getProjDeadLine()))."</td>";
										echo "<td data-title='예상기한'>".$project->getProjExpPeriod()."</td>";
										echo "<td data-title='예산'>".$project->getProjExpPrice()."</td>";
										echo "<td data-title='지원자'>count($project->getParticipantList())&nbsp;명</td>";
										echo "</tr>";
										echo "</tbody>";
									}
									?>
								</table>
							</div>
						</div>
						<div class="row skill-part">
							<h3 class="content-subject">&nbsp;&nbsp;진행중인 프로젝트</h3>
							<div class="tbl_type">
								<table>
									<col width="" />
									<col width="15%" />
									<col width="15%" />
									<col width="15%" />
									<thead>
									<tr>
										<th>프로젝트명</th>
										<th>예상기한</th>
										<th>예상금액</th>
										<th>프로젝트 완료</th>
									</tr>
									</thead>
									<tbody>
									<?php
										echo "<tr>";
										// Project Name
										echo "<td data-title='프로젝트명' class='subject'><a href=./project-intro.php?project=$project->getProjKey>".$project->getProjName()."</a></td>";
										// Expected Date
										echo "<td data-title='예상기한'>".$projPeriod."</td>";
										// Expected Budget
										echo "<td data-title='예상금액'>".$projPrice."</td>";
										// No. Of Applicants
										echo "<td data-title=''>완료하기</td>";
										echo "</tr>";
									?>
									</tbody>
									<?php
									foreach($fl_selected_project_list as $project){
										echo "<tbody>";
										echo "<tr>";
										// Project Name
										echo "<td data-title='프로젝트명' class='subject'><a href=./project-intro.php?project=$project->getProjKey>".$project->getProjName()."</a></td>";
										// Expected Date
										echo "<td data-title='예상기한'>".$project->getProjExpPeriod()."</td>";
										// Expected Budget
										echo "<td data-title='예상금액'>".$project->getProjExpPrice()."</td>";
										// No. Of Applicants
										echo "<td data-title=''>완료하기</td>";
										echo "</tr>";
										echo "</tbody>";
									}
									?>
								</table>
							</div>
						</div>
					</section>

					<section id="tab2-auth">
						제공 예정입니다
					</section>
				</div>
			</div>
		</section>
