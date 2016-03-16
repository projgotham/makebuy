<?php
?>
    <script>
        $(document).ready(function(){
			menu_over("프로젝트 등록","프로젝트 등록","0","0");
        })
    </script>
		<section class="section-project-search js--section-project-search">
			<div class='title'>
				<h2>
					앱프로젝트 지원하기
					<div class='border'><span></span></div>
				</h2>
			</div>
			<div class="form_table">
				<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<col width='15%' />
					<col width='35%' />
					<col width='15%' />
					<col width='*' />
					<tr>
						<th>예상금액</th>
						<td><?php echo number_format ("1000000");?> 원</td>
						<th>예상기한</th>
						<td><?php echo number_format ("40");?> 일</td>
					</tr>
					<tr>
						<th>지원마감</th>
						<td>03-01</td>
						<th>지원자</th>
						<td>2명</td>
					</tr>
					<tr>
						<th>평균입찰가</th>
						<td><?php echo number_format ("800000");?></td>
						<th>미팅지역</th>
						<td>서울</td>
					</tr>
				</table>
			</div>
			<div class="tab-content" style='margin-top:15px;'>
			<div class="tbl_type">
				<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<col width='33%' />
					<col width='33%' />
					<col width='*' />
					<thead>
						<tr>
							<th>지원자수</th>
							<th>평균입찰가</th>
							<th>예상금액</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-title="지원자수"><h3><?php echo number_format ("3");?></h3> 명</td>
							<td data-title="평균입찰가"><h3><?php echo number_format ("700000");?></h3> 원</td>
							<td data-title="예상금액"><h3><?php echo number_format ("500000");?></h3> 원</td>
						</tr>
					</tbody>
				</table>
			</div>
			</div>
		</section>
	</div>
</div>
<div class='sec2'>
	<div class='container'>
		<section class="section-search-result js--section-search-result">
			<div class='title' style="padding-bottom:0px;">
				<h2>
					지원서 작성하기
					<div class='border'><span></span></div>
				</h2>
			</div>
			<div class="tab-content">
				<section>
					<div class="form_table">
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<col width="20%" /><col />
							<tr>
								<th>지원&nbsp;금액</th>
								<td>
									<input type="text" name="bid-price" id="bid-price" placeholder="희망 금액을 원 단위로 입력해 주세요" required />
									<div  class="help-message">
										<p class="help-indicator">주의</p>
										<p class="price-message">메이크바이 수수료 10%를 포함한 가격입니다.</p>
									</div>
								</td>
							</tr>
							<tr>
								<th>지원&nbsp;기간</th>
								<td><input type="text" name="name" id="name" placeholder="희망 기간을 일 단위로 입력해주세요" required /></td>
							</tr>
							<tr>
								<th>지원&nbsp;내용</th>
								<td>
									<textarea class="" name="bid-content" id="bid-content" placeholder="프로젝트에 대한 분석 및 관련 경험 " required></textarea>
									<div class="help-message">
										<p class="help-indicator">주의</p>
										<p class="content-message">전화번호나 이메일을 게시하여 직거래 유도 시에는 서비스 이용에 제재를 받을 수 있습니다.</p>
									</div>
								</td>
							</tr>
							<tr>
								<th></th>
								<td>
								</td>
							</tr>
						</table>
					</div>

					<div class="board_button">
						<a href="#" class="b-button color"><span><i class="ion-checkmark"></i>지원하기</span></a>
						<a href="#" class="b-button active"><span><i class="ion-refresh"></i>취소</span></a>
					</div>
				</section>
			</div>
		</section>
	</div>
</div>
