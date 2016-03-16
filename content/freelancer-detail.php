<link rel="stylesheet" type="text/css" href="./js/jquery.fancybox.css?v=1.0.7" />
<script type="text/javascript" src="./js/jquery.fancybox.js?v=1.0.7"></script>

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
		$('.fancybox-thumbs').fancybox({
			wrapCSS    : 'fancybox-custom',
				prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : true,
			arrows    : true,
			nextClick : true,

			helpers : {
				thumbs : {
					width  : 50,
					height : 50
				},
				title : {
					type : 'outside'
				},
				overlay : {
					speedOut : 0
				}
			},
			afterLoad : function() {
				this.title = '포트폴리오 ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			}
		});
	})
</script>
        <section class="section-fl-profile js--section-fl-profile">
			<div class='title'>
				<h2>
					makebuy
					프리랜서팀
					<div class='border'><span></span></div>
				</h2>
			</div>
			<!-- <h3 class='user-auth' style='padding-bottom:10px;'>신원이 확인되었습니다</h3> -->
			<div class="fl-intro" id="fl-profile">
				<div class="col span-2-of-3 intro-box">
					<figure class="photo-box">
						<img src='https://tv.pstatic.net/thm?size=120x150&quality=9&q=http://sstatic.naver.net/people/84/201405081026047371.jpg' />
					</figure>
					<h4>안녕하세요 프리랜서팀 메이크바이입니다. 앞으로 열심히 하겠습니다.</h4>
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
								<h3 class="content-subject">평가<a href="#" class="m-button active rr"><span>전체 참여 프로젝트 보기</span></a></h3>
								<div class="row inside-value">
									<p>클라이언트 만족도</p>
									<!-- TODO PROGRESS BAR-->
									<progress value='60' min="0" max='100' class="" ><strong>Progress: 60% done.</strong></progress>
									<p class='overall-value'><strong>9</strong>점</p>
									<p>총 참여 프로젝트 100건</p>
								</div>
							</div>
							<div class="row skill-part">
								<h3 class="content-subject">기술 및 자격증<a href="#" class="m-button active rr"><span>전체 기술 보기</span></a></h3>
								<div class="tbl_type">
									<table>
										<thead>
											<tr>
												<th>종류</th>
												<th>숙련도</th>
												<th>사용기간</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td data-title="종류">컴퓨터활용능력</td>
												<td data-title="숙련도">3급</td>
												<td data-title="사용기간">2년</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="divide_r">
							<div class="row portfolio-part">
								<h3 class="content-subject">포트폴리오<a href="#" class="m-button active rr"><span>전체 포트폴리오 보기</span></a></h3>
								<div class="tbl_type collection-center-small">
									<ul>
										<li><img src='./images/portfolio/sample_01.jpg' class='port-image-small'></li>
										<li><img src='./images/portfolio/sample_02.jpg' class='port-image-small'></li>
										<li><img src='./images/portfolio/sample_03.jpg' class='port-image-small'></li>
										<li><img src='./images/portfolio/sample_04.jpg' class='port-image-small'></li>
										<li><img src='./images/portfolio/sample_05.jpg' class='port-image-small'></li>
									</ul>
								</div>
								
							</div>
							<div class="row career-part">
								<h3 class="content-subject">경력 / 학력<a href="#" class="m-button active rr"><span>전체 경력 보기</span></a></h3>
								<div class="tbl_type">
									<table>
										<thead>
										<tr>
											<th>이름</th>
											<th>기간</th>
											<th>직책</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td data-title="이름">$carrName</td>
											<td data-title="기간">$carrPeriod</td>
											<td data-title="직책">$carrType</td>
										</tr>
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					</div>

					<div id="tab2-eval">
						<div class="divide_l">
							<div class="row summary-part">
								<h3 class="content-subject">평가 개요<a href="#" class="m-button active rr"><span>전체 참여 프로젝트 보기</span></a></h3>
								<div class="row inside-value">
									<progress value='60' max='100'></progress>
									<p class='overall-value'><strong>9</strong>점</p>
									<p>총 참여 프로젝트&nbsp;100건</p>
									<p>총 계약 금액 30,500,000 원</p>
								</div>
								
							</div>

						</div>
						<div class="divide_r">
							<div class="row portfolio-part">
								<h3 class="content-subject">세부 평가</h3>
								<div class="form_table">
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<col width='25%' />
										<col width='75%' />
										<tr>
											<th>전문성</th>
											<td><progress value='90' max='100' class='green2'></progress></td>
										</tr>
										<tr>
											<th>의사소통</th>
											<td><progress value='60' max='100' class='green1'></progress></td>
										</tr>
										<tr>
											<th>마감준수</th>
											<td><progress value='40' max='100' class='yellow'></progress></td>
										<tr>
											<th>적극성</th>
											<td><progress value='10' max='100' class='orange'></progress></td>
										</tr>
										<tr>
											<th>제품만족도</th>
											<td><progress value='30' max='100' class='red'></progress></td>
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
									<tbody>
									<tr>
										<td class="subject" data-title=""><a href=./project-intro.php?project=$projKey>$projName</a></td>
										<td data-title="계약 금액">$projPrice&nbsp;원</td>
										<td data-title="계약 기간">$projPeriod&nbsp;일</td>
										<td data-title="클라이언트 평가">미정</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div id="tab3-port">
						<h3 class="content-subject">포트폴리오</h3>
						<div class="tbl_type collection-center-large">
							<ul>
								<li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="네이버" href="./images/portfolio/sample_01.jpg"><img src='./images/portfolio/sample_01.jpg' class='port-image-large'><p>네이버</p></a></li>
								<li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="카카오네비게이션" href="./images/portfolio/sample_02.jpg"><img src='./images/portfolio/sample_02.jpg' class='port-image-large'><p>카카오네비게이션</p></a></li>
								<li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="롯데인터넷면세점 모바일" href="./images/portfolio/sample_03.jpg"><img src='./images/portfolio/sample_03.jpg' class='port-image-large'><p>롯데인터넷면세점 모바일</p></a></li>
								<li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="배달의 민족" href="./images/portfolio/sample_04.jpg"><img src='./images/portfolio/sample_04.jpg' class='port-image-large'><p>배달의 민족</p></a></li>
								<li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="캔디 카메라" href="./images/portfolio/sample_05.jpg"><img src='./images/portfolio/sample_05.jpg' class='port-image-large'><p>캔디 카메라</p></a></li>
								<li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="레고® 프렌즈 아트 메이커" href="./images/portfolio/sample_06.jpg"><img src='./images/portfolio/sample_06.jpg' class='port-image-large'><p>레고® 프렌즈 아트 메이커</p></a></li>
								<li><a class="fancybox-thumbs" data-fancybox-group="thumb" title="Colorfy - 무료 색칠 공부" href="./images/portfolio/sample_07.jpg"><img src='./images/portfolio/sample_07.jpg' class='port-image-large'><p>Colorfy - 무료 색칠 공부</p></a></li>
							</ul>
						</div>
					</div>

					<div id="tab4-skill">
						<h3 class="content-subject">보유 기술 및 자격증</h3>
						<div class="tbl_type" id="fl-skill">
							<table class="table-full">
								<thead>
								<tr>
									<th>기술명</th>
									<th>숙련도 및 등급</th>
									<th>사용기간(자격증의 경우 미기재)</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td data-title="기술명">$skillName</td>
									<td data-title="숙련도 및 등급">$skillLevel</td>
									<td data-title="사용기간">$skillPeriod</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div id="tab5-career">
						
						<h3 class="content-subject">경력 및 학력</h3>
						<div class="tbl_type" id="fl-career">
							<table class="table-full">
								<thead>
								<tr>
									<th>경력/학력명</th>
									<th>기간</th>
									<th>직책</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td data-title="경력/학력명">$carrName</td>
									<td data-title="기간">$carrPeriod</td>
									<td data-title="직책">$carrType</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
        </section>
