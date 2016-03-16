    <script>
        $(document).ready(function(){
			menu_over("프로젝트 찾기","프로젝트 찾기","1","0");
        })
    </script>
		<section class="section-project js--section-project">
			<div class='title' style='padding-bottom:30px;'>
				<h2>
					$projName
					<div class='border'><span></span></div>
				</h2>
				<h3>
					Andorid 필요
					&nbsp;
					<span class="m-button active"><span>모집 중</span></span>
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
							<td><?php echo number_format("300000");?></td>
							<th>예상기한</th>
							<td>30일</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>지원마감</th>
							<td>2시간전</td>
							<th>지원자</th>
							<td>2명</td>
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
								<b>$projDescription</b><br /><br />
								프로젝트에 대한 설명입니다.<br /><br />
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
							<td>$email</td>
						</tr>
						<tr>
							<th>평점:</th>
							<td>$rate 점</td>
						</tr>
						<tr>
							<th>소개</th>
							<td>$desc</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="board_button">
				<a href="./sub.php?page=project-regist" class="b-button color"><span><i class="ion-checkmark-round"></i>프로젝트 지원하기</span></a>
				<a href="./sub.php?page=search-projects" class="b-button active"><span><i class="ion-refresh"></i>목록으로 돌아가기</span></a>
			</div>
		</div>
	</div>
</section>
