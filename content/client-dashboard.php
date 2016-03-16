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

require_once('../class/project_list.php');

// SECTION 1. Project List
$load_project_list = new project_list();
$load_project_list->getDB()


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
							<td class="subject" data-title=''>어떻게 하면 되겠습니까?</td>
							<td data-title='날짜' class='nums'>16.02.03</td>
							<td data-title='전달자' class='nums'>philoz3231</td>
						</tr>
					</tbody>
					<tbody>
						<tr>
							<td class="subject" class='nums'>프로젝트 관련하여 질문</td>
							<td data-title='날짜' class='nums'>16.02.01</td>
							<td data-title='전달자' class='nums'>philoz3231</td>
						</tr>
					</tbody>
					<tbody>
						<tr>
							<td class="subject">계약 파기 및 법적 소송 관련</td>
							<td data-title='날짜' class='nums'>16.01.31</td>
							<td data-title='전달자' class='nums'>philoz3231</td>
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
					<tbody>
					<tr>
						<td class="subject">Makebuy 회원 5명 달성!</td>
						<td data-title='날짜'>16.02.03</td>
					</tr>
					</tbody>
					<tbody>
					<tr>
						<td class="subject">Makebuy가 시작하였습니다!</td>
						<td data-title='날짜'>16.02.01</td>
					</tr>
					</tbody>
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
											<td>10 건</td>
										</tr>
										<tr>
											<th>모집중인 프로젝트</th>
											<td>2 건</td>
										</tr>
										<tr>
											<th>진행중인 프로젝트</th>
											<td>1 건</td>
										</tr>
										<tr>
											<th>마감 된 프로젝트</th>
											<td>7 건</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="skill-part">
								<h3 class="content-subject">&nbsp;&nbsp; 진행중인 프로젝트<a href="#" class="rr m-button active"><span>전체 모집중인 프로젝트 보기</span></a></h3>
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
										<tbody>
											<tr>
												<td data-title="프로젝트 이름">중고차거래 앱디자인 기획</td>
												<td data-title="모집마감일">2월 31일</td>
												<td data-title="지원자수">3 명</td>
											</tr>
										</tbody>
										<tbody>
											<tr>
												<td data-title="프로젝트 이름">대학교 학과 앱 제작 기획</td>
												<td data-title="모집마감일">3월 5일</td>
												<td data-title="지원자수">5 명</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="divide_r">
							<div class="portfolio-part">
								<h3 class="content-subject">&nbsp;&nbsp;등록중인 프로젝트<a href="#" class="rr m-button active"><span>전체 등록중인 프로젝트 보기</span></a></h3>
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
										<tbody>
											<tr>
												<td data-title="프로젝트 이름">직방과 같은 앱 기획</td>
												<td data-title="상태">임시저장</td>
											</tr>
										</tbody>
									</table>
								</div>
								
							</div>
							<div class="row career-part">
								<h3 class="content-subject">&nbsp;&nbsp;모집중인 프로젝트<a href="#" class="rr m-button active"><span>전체 진행중 프로젝트 보기</span></a></h3>
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
										<tbody>
											<tr>
												<td class="subject">야구게임 앱 기획</td>
												<td data-title="완료예상일">5월 31일</td>
												<td data-title="프로젝트 완료">프로젝트 완료</td>
											</tr>
										</tbody>
										<tbody>
											<tr>
												<td class="subject">실시간 온라인게임 앱 기획</td>
												<td data-title="완료예상일">6월 2일</td>
												<td data-title="프로젝트 완료">프로젝트 완료</td>
											</tr>
										</tbody>
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
								<tbody>
									<tr>
										<td class="subject">프로젝트 이름</td>
										<td data-title="모집마감일">모집마감일</td>
										<td data-title="예상기간">예상기간</td>
										<td data-title="예산">예산</td>
										<td data-title="상태">상태</td>
									</tr>
								</tbody>
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
								<tbody>
									<tr>
										<td class="subject">프로젝트 이름</td>
										<td data-title="모집마감일">모집마감일</td>
										<td data-title="예상기간">예상기간</td>
										<td data-title="예산">예산</td>
										<td data-title="지원자">지원자</td>
									</tr>
								</tbody>
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
								<tbody>
									<tr>
										<td class="subject">프로젝트 이름</td>
										<td data-title="완료예정일">완료예정일</td>
										<td data-title="예상기간">예상기간</td>
										<td data-title="계약금액">계약금액</td>
										<td data-title="프로젝트 완료">프로젝트 완료</td>
									</tr>
								</tbody>
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
								<tbody>
									<tr>
										<td class="subject">프로젝트 이름</td>
										<td data-title="완료일">완료일</td>
										<td data-title="소요기간">소요기간</td>
										<td data-title="계약금액">계약금액</td>
										<td data-title="프리랜서 평가">프리랜서 평가</td>
									</tr>
								</tbody>
							</table>
						</div>
					</section>
				</div>
			</div>
		</section>
