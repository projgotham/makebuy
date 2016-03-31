<?php
/*
 * check session
 */
session_start();
if (!isset($_SESSION['user_key'])) {
	header("Location: http://localhost/makebuy_web/index.php");
	exit();
} else if ($_SESSION['user_type'] == 'freelancer') {
	header("Location: http://localhost/makebuy_web/content/freelancer-dashboard.php");
}

require_once(__DIR__.'/../class/project_list.php');
require_once(__DIR__.'/../class/participant_list.php');
require_once (__DIR__."/../class/announce_list.php");

//SECTION. Announce_list
$load_announce_list = new announce_list();
$load_announce_list->getDB();
$announce_list = $load_announce_list->getAnnounceList();
// Project List
$load_project_list = new project_list();
$load_project_list->getDB('clientKey', $_SESSION['user_key']);
$project_list = $load_project_list->getProjList();

$register_project_list = array(); // List of Projects in REGISTRATION(Confirmation or Saving) Process
$progress_project_list = array(); // List of Projects in PROGRESSING Process
$recruit_project_list = array(); // List of Projects in RECRUITING Process
$finish_project_list = array(); // List of Projects in FINISH Progress
$cancel_project_list = array(); // List of Projects in CANCEL Progress

foreach($project_list as $project){
	if($project->getProjState() == 'save' OR $project->getProjState() == 'test' OR $project->getProjState() == 'deny'){
		array_push($register_project_list, $project);
	} else if($project->getProjState() == 'progress'){
		array_push($progress_project_list, $project);
	} else if($project->getProjState() == 'recruit'){
		array_push($recruit_project_list, $project);
	} else if($project->getProjState() == 'finish'){
		array_push($finish_project_list, $project);
	} else if($project->getProjState() == 'cancel'){
		array_push($cancel_project_list, $project);
	}
}

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
			<div class="tbl_type bbs_list">
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
			<div class="tabs">
				<div class="tab_list">
					<ul>
						<li class="active"><a href="#tab1-summary">개요</a></li>
						<li><a href="#tab2-waiting">등록중인 프로젝트</a></li>
						<li><a href="#tab3-recruit">모집중인 프로젝트</a></li>
						<li><a href="#tab4-current">진행중인 프로젝트</a></li>
						<li><a href="#tab5-finish">마감된 프로젝트</a></li>
					</ul>
				</div>

				<div class="tab-content">
					<section id="tab1-summary" class="tab active">
						<div class="divide_l">
							<div class="summary-part">
								<h3 class="content-subject">&nbsp;&nbsp;현황</h3>
								<div class="form_table">
									<table class="summary-table">
										<col width="35%" />
										<col width="" />
										<tr>
											<th>총 프로젝트 의뢰 수</th>
											<?php
											echo "<td>";
											echo count($project_list)-count($cancel_project_list);
											echo "&nbsp;건</td>";
											?>
										</tr>
										<tr>
											<th>모집중인 프로젝트</th>
											<?php
											echo "<td>";
											echo count($recruit_project_list);
											echo "&nbsp;건</td>";
											?>
										</tr>
										<tr>
											<th>진행중인 프로젝트</th>
											<?php
											echo "<td>";
											echo count($progress_project_list);
											echo "&nbsp;건</td>";
											?>
										</tr>
										<tr>
											<th>마감 된 프로젝트</th>
											<?php
											echo "<td>";
											echo count($finish_project_list);
											echo "&nbsp;건</td>";
											?>
										</tr>
									</table>
								</div>
							</div>
							<div class="skill-part">
								<h3 class="content-subject">&nbsp;&nbsp; 모집중인 프로젝트<a href="javascript:void(0);" class="rr m-button active" id="btn-seeRecruit"><span>전체 모집중인 프로젝트 보기</span></a></h3>
								<div class="tbl_type">
									<table>
										<col width="" />
										<col width="20%" />
										<col width="20%" />
										<thead>
											<tr>
												<th>프로젝트 이름</th>
												<th>모집마감일</th>
												<th>지원자수</th>
											</tr>
										</thead>
										<?php
										foreach($recruit_project_list as $project){
											$project_name = $project->getProjName();
											$project_deadline = $project->getProjDeadline();
											$project_key = $project->getProjKey();
											$project->getParticipantList($project_key);
											$project_participant_list = $project->getProjParticipants();
											$project_participant_count = count($project_participant_list);
											echo "<tbody>";
											echo "<tr>";
											echo "<td data-title='프로젝트 이름'>$project_name</td>";
											echo "<td data-title='모집마감일'>$project_deadline</td>";
											echo "<td data-title='지원자수'>";
											echo $project_participant_count;
											echo "&nbsp;명</td>";
											echo "</tr>";
											echo "</tbody>";
										}
										?>
									</table>
								</div>
							</div>
						</div>
						<div class="divide_r">
							<div class="portfolio-part">
								<h3 class="content-subject">&nbsp;&nbsp;등록중인 프로젝트<a href="javascript:void(0);" class="rr m-button active" id="btn-seeWaiting"><span>전체 등록중인 프로젝트 보기</span></a></h3>
								<div class="tbl_type">
									<table>
										<col width="" />
										<col width="20%" />
										<thead>
											<tr>
												<th>프로젝트 이름</th>
												<th>상태</th>
											</tr>
										</thead>
										<!-- TODO html -->
										<?php
										foreach($register_project_list as $project){
											$project_name = $project->getProjName();
											$project_state = $project->getProjState();
											echo "<tbody>";
											echo "<tr>";
											echo "<td data-title='프로젝트 이름'>$project_name</td>";
											echo "<td data-title='상태'>$project_state</td>";
											echo "</tr>";
											echo "</tbody>";
										}
										?>
									</table>
								</div>
								
							</div>
							<div class="row career-part">
								<h3 class="content-subject">&nbsp;&nbsp;진행중인 프로젝트<a href="javascript:void(0);"  class="rr m-button active" id="btn-seeCurrent"><span>전체 진행중 프로젝트 보기</span></a></h3>
								<div class="tbl_type">
									<table>
										<col width="" />
										<col width="20%" />
										<col width="20%" />
										<thead>
											<tr>
												<th>프로젝트 이름</th>
												<th>완료예상일</th>
												<th>프로젝트 완료</th>
											</tr>
										</thead>
										<!-- TODO html -->
										<?php
										foreach($progress_project_list as $project){
											$project_name = $project->getProjName();
											$project_exp_period = $project->getProjExpPeriod();
											echo "<tbody>";
											echo "<tr>";
											echo "<td class='subject'>$project_name</td>";
											echo "<td data-title='완료예상일'>$project_exp_period</td>";
											echo "<td data-title='프로젝트 완료'>프로젝트 완료</td>";
											echo "</tr>";
											echo "</tbody>";
										}
										?>
									</table>
								</div>
								
							</div>
						</div>
						<div class="clearfix"></div>
					</section>

					<section id="tab2-waiting" class="tab">
						<h3 class="content-subject">&nbsp;&nbsp;등록중인 프로젝트</h3>
						<div class="tbl_type">
							<table>
								<col width="" />
								<col width="15%" />
								<col width="15%" />
								<col width="15%" />
								<col width="15%" />
								<thead>
									<tr>
										<th>프로젝트 이름</th>
										<th>모집마감일</th>
										<th>예상기간</th>
										<th>예산</th>
										<th>상태</th>
									</tr>
								</thead>
								<!-- TODO html -->
								<?php
								foreach($register_project_list as $project){
									$project_name = $project->getProjName();
									$project_deadline = $project->getProjDeadLine();
									$project_exp_period = $project->getProjExpPeriod();
									$project_exp_price = $project->getProjExpPrice();
									$project_state = $project->getProjState();
									echo "<tbody>";
									echo "<tr>";
									echo "<td class='subject'>$project_name</td>";
									echo "<td data-title='모집마감일'>$project_deadline</td>";
									echo "<td data-title='예상기간'>$project_exp_period</td>";
									echo "<td data-title='예산'>&#8361;&nbsp;".number_format($project_exp_price)."</td>";
									echo "<td data-title='상태'>$project_state</td>";
									echo "</tr>";
									echo "</tbody>";
								}
								?>
							</table>
						</div>
					</section>

					<section id="tab3-recruit" class="tab">
						<h3 class="content-subject">&nbsp;&nbsp;모집중인 프로젝트</h3>
						<div class="tbl_type">
							<table>
								<col width="" />
								<col width="15%" />
								<col width="15%" />
								<col width="15%" />
								<col width="15%" />
								<thead>
									<tr>
										<th>프로젝트 이름</th>
										<th>모집마감일</th>
										<th>예상기간</th>
										<th>예산</th>
										<th>지원자</th>
									</tr>
								</thead>
								<!-- TODO html -->
								<?php
								foreach($recruit_project_list as $project){
									$project_name = $project->getProjName();
									$project_deadline = $project->getProjDeadLine();
									$project_exp_period = $project->getProjExpPeriod();
									$project_exp_price = $project->getProjExpPrice();
									$project->getParticipantList($project_key);
									$project_participant_list = $project->getProjParticipants();
									$project_participant_count = count($project_participant_list);
									echo "<tbody>";
									echo "<tr>";
									echo "<td class='subject'>$project_name</td>";
									echo "<td data-title='모집마감일'>$project_deadline</td>";
									echo "<td data-title='예상기간'>$project_exp_period</td>";
									echo "<td data-title='예산'>&#8361;&nbsp;".number_format($project_exp_price)."</td>";
									echo "<td data-title='지원자'>$project_participant_count&nbsp;명</td>";
									echo "</tr>";
									echo "</tbody>";
								}
								?>
							</table>
						</div>
					</section>

					<section id="tab4-current" class="tab">
						<h3 class="content-subject">&nbsp;&nbsp;진행중인 프로젝트</h3>
						<div class="tbl_type">
							<table>
								<col width="" />
								<col width="15%" />
								<col width="15%" />
								<col width="15%" />
								<col width="15%" />
								<thead>
									<tr>
										<th>프로젝트 이름</th>
										<th>완료예정일</th>
										<th>예상기간</th>
										<th>계약금액</th>
										<th>프로젝트 완료</th>
									</tr>
								</thead>
								<!-- TODO html -->
								<?php
								foreach($progress_project_list as $project){
									$project_name = $project->getProjName();
									$project_exp_period = $project->getProjExpPeriod();
									$project_act_period = $project->getProjActPeriod();
									$project_act_price = $project->getProjActPrice();
									echo "<tbody>";
									echo "<tr>";
									echo "<td class='subject'>$project_name</td>";
									echo "<td data-title='완료예정일'>$project_exp_period</td>";
									echo "<td data-title='계약기간'>$project_act_period</td>";
									echo "<td data-title='계약금액'>&#8361;&nbsp;".number_format($project_act_price)."</td>";
									echo "<td data-title='프로젝트 완료'>프로젝트 완료</td>";
									echo "</tr>";
									echo "</tbody>";
								}
								?>
							</table>
						</div>
					</section>

					<section id="tab5-finish" class="tab">
						<h3 class="content-subject">&nbsp;&nbsp;마감된 프로젝트</h3>
						<div class="tbl_type">
							<table>
								<col width="" />
								<col width="15%" />
								<col width="15%" />
								<col width="15%" />
								<col width="15%" />
								<thead>
									<tr>
										<th>프로젝트 이름</th>
										<th>완료일</th>
										<th>소요기간</th>
										<th>계약금액</th>
										<th>프리랜서 평가</th>
									</tr>
								</thead>
								<!-- TODO html -->
								<?php
								foreach($finish_project_list as $project){
									$project_name = $project->getProjName();
									$project_finish = $project->getProjFinishDate();
									$project_act_period = $project->getProjActPeriod();
									$project_act_price = $project->getProjActPrice();
									echo "<tbody>";
									echo "<tr>";
									echo "<td class='subject'>$project_name</td>";
									echo "<td data-title='완료일'>$project_finish</td>";
									echo "<td data-title='소요기간'>$project_act_period</td>";
									echo "<td data-title='계약금액'>&#8361;&nbsp;".number_format($project_act_price)."</td>";
									echo "<td data-title='프리랜서 평가'>프리랜서 평가</td>";
									echo "</tr>";
									echo "</tbody>";
								}
								?>
							</table>
						</div>
					</section>
				</div>
			</div>
		</section>
