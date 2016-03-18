<?php
/*
 * check session
 */
session_start();
if (!isset($_SESSION['user_key'])) {
	header("Location: http://localhost/makebuy_web/index.php");
	exit();
}

require('../class/db.php');
$db = new db();
$connection = $db->connect();
$userKey = $_SESSION['user_key'];

$sql = "SELECT projKey, proj_state, proj_price, proj_deadline, proj_period, proj_nm, proj_desc, proj_ios, proj_android, proj_hybrid FROM project_tb WHERE proj_state='recruit' or proj_state='finish'";
$rows = $db->select($sql);

$i = 0;
$j = count($rows);

?>
<style>
	@media only screen and (max-width: 767px) {
		section .title { padding-bottom:10px; }
		.divide_r { padding-top:0px; }
		.divide_r table { border-top:none; }
		.tab-content section table tbody { padding-bottom:10px; }
		.tab-content section table tbody tr td:last-child { border-bottom:1px solid #e1e5e3; }
	}
</style>
    <script>
        $(document).ready(function(){
			menu_over("프로젝트 찾기","프로젝트 찾기","1","0");
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
				<col width='20%' />
				<col width='*' />
				<col width='15%' />
				<tr>
					<th>이름</th>
					<td>
						<input type="text" name="name" id="name">
					</td>
					<td style='border-left:none;'>
						<a class="t-button color" href="#"><span>검색</span></a>
					</td>
				</tr>
			</table>
		</div>
		<div class='divide_r'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<col width='20%' />
				<col width='*' />
				<col width='15%' />
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
			총 <b class="color1">5</b>건의 검색 결과를 찾았습니다.
			<div class='border'><span></span></div>
		</h2>
	</div>
    <div class="row">
		<div class='tab_list'>
			<ul>
				<li><a href="#">최신 순</a></li>
				<li><a href="#">내 기술에 맞게</a></li>
				<li><a href="#">마감임박 순</a></li>
				<li><a href="#">금액 순</a></li>
			</ul>
		</div>
        <div class="tab-content">
			<section>
				<div class="tbl_type">
					<table>
						<col />
						<col width="15%" />
						<col width="15%" />
						<col width="12%" />
						<col width="12%" />
						<thead>
							<tr>
								<th>프로젝트명(내용)</th>
								<th>예상금액</th>
								<th>지원마감</th>
								<th>예상기한</th>
								<th>지원자</th>
							</tr>
						</thead>
						<tbody class="disable">
							<tr>
								<td class="subject"><span class="t-button active"><span>마감</span></span>&nbsp;<a href="./sub.php?page=project-intro"><b>프로젝트 타이틀</b></a>&nbsp;(Android, iOS, HTML 필요)</p></td>
								<td data-title="예상금액"><?php echo number_format("5000000");?></td>
								<td data-title="지원마감">6일 전</td>
								<td data-title="예상기한">10일</td>
								<td data-title="지원자">52명</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td class="subject"><span class="t-button color"><span>모집중</span></span>&nbsp;<a href="./sub.php?page=project-intro"><b>프로젝트 타이틀</b></a>&nbsp;(Android, iOS, HTML 필요)</p></td>
								<td data-title="예상금액"><?php echo number_format("15000000");?></td>
								<td data-title="지원마감">15일 전</td>
								<td data-title="예상기한">40일</td>
								<td data-title="지원자">187명</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td class="subject"><span class="t-button color"><span>모집중</span></span>&nbsp;<a href="./sub.php?page=project-intro"><b>프로젝트 타이틀</b></a>&nbsp;(Android, iOS, HTML 필요)</p></td>
								<td data-title="예상금액"><?php echo number_format("15000000");?></td>
								<td data-title="지원마감">15일 전</td>
								<td data-title="예상기한">40일</td>
								<td data-title="지원자">187명</td>
							</tr>
						</tbody>
						<tbody class="disable">
							<tr>
								<td class="subject"><span class="t-button active"><span>마감</span></span>&nbsp;<a href="./sub.php?page=project-intro"><b>프로젝트 타이틀</b></a>&nbsp;(Android, iOS, HTML 필요)</p></td>
								<td data-title="예상금액"><?php echo number_format("5000000");?></td>
								<td data-title="지원마감">6일 전</td>
								<td data-title="예상기한">10일</td>
								<td data-title="지원자">52명</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td class="subject"><span class="t-button color"><span>모집중</span></span>&nbsp;<a href="./sub.php?page=project-intro"><b>프로젝트 타이틀</b></a>&nbsp;(Android, iOS, HTML 필요)</p></td>
								<td data-title="예상금액"><?php echo number_format("15000000");?></td>
								<td data-title="지원마감">15일 전</td>
								<td data-title="예상기한">40일</td>
								<td data-title="지원자">187명</td>
							</tr>
						</tbody>
					 </table>
				</div>
				<div class="col span-5-of-7 result-detail result-detail-spec"></div>
			</section>
		</div>
    </div>
</section>
