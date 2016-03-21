<?php
/*
 * check session

session_start();
if (!isset($_SESSION['user_key'])) {
	header("Location: http:/localhost/makebuy_web/index.php");
	exit();
}
*/
require_once "class/announce_list.php";
//require('/class/announce_list.php');

$load_announce_list = new announce_list();
$load_announce_list->getDB();
$announce_count = count($load_announce_list);
$announce_list = $load_announce_list->getAnnounceList();
?>

<div class='board_top'>
				Total <?php echo $announce_count ?> articles
			</div>
			<div class="tbl_type bbs_list">
				<table>
					<col width='5%' />
					<col width='*' />
					<col width='15%' />
					<col width='10%' />
					<thead>
						<tr>
							<th>번호</th>
							<th>공지내용</th>
							<th>날짜</th>
							<th>조회</th>
						</tr>
					</thead>
					<?php

					?>

					<tbody>
						<tr>
							<td data-title='번호' class="no">1</td>
							<td class="subject"><a href="./sub.php?page=<?php echo $page;?>&sec=view">Makebuy 회원 5명 달성!</a></td>
							<td data-title='날짜' class="nums">16.02.03</td>
							<td data-title='조회' class="nums">523</td>
						</tr>
					</tbody>

					<tbody>
						<tr>
							<td data-title='번호'>2</td>
							<td class="subject"><a href="./sub.php?page=<?php echo $page;?>&sec=view">Makebuy가 시작하였습니다!</a></td>
							<td data-title='날짜' class="nums">16.02.01</td>
							<td data-title='조회' class="nums">32</td>
						</tr>
					</tbody>

				</table>
			</div>
			<div class="paginate">
				<a href="#">&lt;&nbsp;Prev</a>
				<a href="#">1</a>
				<strong class="current">2</strong>
				<a href="#">3</a>
				<a href="#">4</a>
				<a href="#">5</a>
				<!-- 모바일일 경우 5까지
				<a href="#">6</a>
				<a href="#">7</a>
				<a href="#">8</a>
				<a href="#">9</a>
				<a href="#">10</a>
				-->
				<a href="#">Next&nbsp;&gt;</a>
			</div>
