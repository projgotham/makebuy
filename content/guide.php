<script>$(document).ready(function(){  menu_over("","","2","0");  })</script>
<style>
	.process { margin-top:20px; width:100%; height:180px;position:relative; text-align:center;background:url("./images/common/gnb_line.png") repeat-x 0 60px; }
	.process li { 
		z-index:2;
		width:120px; height:120px; 
		display:inline-block;
		margin:0 30px;
		border:1px solid #09b262; 
		background:#09b262 url("./images/common/bg-light.png") repeat-x 0 0; 
		background-size:auto 100%; 
		-moz-border-radius: 50%;	-webkit-border-radius: 50%; border-radius:  50%;  
	}
	.process li p { color:#fff; font-weight:700; font-size:20px; padding:35% 15px 0px 15px; text-align:center; line-height:110%; font-family:"Noto Sans Kr";}
	.process:before, .process:after { font-size:20px; padding:20px 0;position:absolute; top:140px;background-color:#fff; }
	.process:before  { content:"기획부터 다릅니다."; clear:both; float:left; left:0;}
	.process:after  { content:"확실하게 끝낼 수 있습니다.";  float:right; right:0;}
	@media only screen and (min-width: 768px) {
		#howtouse section { }
		#howtouse section .title, #price section .title { padding-left:0; padding-right:250px;text-align:right }
		#howtouse section .image, #price section .image { float:right; }
		section.content#service > .image { width:40%; height:auto; }
		section.content#service > .title { padding-left:45%;}
	#process section .title { padding:0; }
		#price .tbl_type * { font-size:16px }
	}
	@media only screen and (max-width: 767px) {
		section.content#service > .image { width:100%;height:auto; max-width:100%; }
		section.content#service > .image img { max-width:100%; max-height:999px;}
		.process {  height:auto; background-position:center 0px; background-image:url("./images/common/gnb_line.png"); background-repeat:repeat-y; }
		.process:before, .process:after { position:relative;display:block; width:100%; text-align:center; top:auto;}
		.process li { clear:both;width:100px; height:100px; margin:0 auto 15px auto; display:block;}
		.process li p {  font-size:16px; }
		#price .tbl_type td { padding-left:20%; }
		section .title h3 { font-size:14px;}
		section .title h3 * { font-size:14px;}
	}
</style>
		<section class="content" id="service">
			<div class='image'><img src='./images/content/service.jpg' align='absmiddle' /></div>
			<div class='title'>
				<h2>
					Makebuy는 어떤 서비스인가요?
					<div class='border'><span></span></div>
				</h2>
				<h3>
					Makebuy는 앱을 만들고 싶은 사람(클라이언트)와
					<li></li>앱을 만들어줄 수 있는 사람(프리랜서)를
					<li></li>연결해 주는 중개서비스입니다.<br>
					Makebuy와 함께라면 이제 내가 원하던 앱을
					<li></li>‘make’하고 ‘buy’할 수 있습니다.
				</h3>
			</div>
		</section>
	</div>
</div>
<div class="sec2" id="howtouse">
	<div class="container">
		<section class="content">
			<div class='image'>
				<img src='./images/content/guide_01.png' align='absmiddle' />
			</div>
			<div class='title'>
				<h2>
					앱을 만들고 싶은 사람
					<div class='border'><span></span></div>
				</h2>
				<h3>
					프로젝트 등록 화면에서
					<li></li>프로젝트를 등록해 주세요.<br>
					기획 및 프로젝트 등록을
					<li></li>메이크바이가 도와드립니다.
				</h3>
			</div>
		</section>
		<section class="content">
			<div class='image'>
				<img src='./images/content/guide_02.png' align='absmiddle' />
			</div>
			<div class='title'>
				<h2>
					앱을 만들어줄 수 있는 사람
					<div class='border'><span></span></div>
				</h2>
				<h3>
					프로젝트 찾기 화면에서
					<li></li>원하는 프로젝트에 지원해 보세요.<br>
					당신의 능력이 정당하게 평가 받도록
					<li></li>메이크바이가 도와 드릴게요.
				</h3>
			</div>
		</section>
	</div>
</div>
<div class='sec1' id="process">
    <div class="container">
		<section class="content">
			<div class='title'>
				<h2>
					서비스 프로세스
					<div class='border'><span></span></div>
				</h2>
				<ul class='process'>
					<li><p>기획<br>도우미</p></li>
					<li><p>프리랜서<br>선정</p></li>
					<li><p>미팅<br>주선</p></li>
					<li><p>프로젝트<br>진행</p></li>
					<li><p>대금지급<br>사후관리</p></li>
					<div></div>
				</ul>
			</div>
		</section>
	</div>
</div>
<div class='sec2' id="price">
    <div class="container">
		<section class="content">
			<div class='image'>
				<img src='./images/content/service_price.png' align='absmiddle' />
			</div>
			<div class='title'>
				<h2>
					서비스 비용안내
					<div class='border'><span></span></div>
				</h2>
				<h3>클라이언트 이용요금</h3>
				<h4>무료</h4>
				<h3>프리랜서 이용요금</h3>
				<div class='tbl_type'>
					<table cellpadding='0' cellspacing='0' border='0' width='100%'>
						<thead>
						<tr>
							<th>기업</th>
							<th>개인</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td data-title="기업">프로젝트 대금의 10%</td>
							<td data-title="개인">프로젝트 대금의 10% (원천징수 3.3% 공제)</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>