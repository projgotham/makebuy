<?php
$list = $_GET['list'];
if($list == null){
	$list = 1;
}

require_once "class/announce_list.php";
//require('/class/announce_list.php');

$load_announce_list = new announce_list();
$load_announce_list->getDB();

$announce_list = $load_announce_list->getAnnounceList();
$announce_count = count($announce_list);

//count pages, change to include_once for avoiding reload
$remainder = $announce_count % 10;
$pages_count = ($announce_count -($announce_count % 10))/10;
if($remainder != 0){
	$pages_count = $pages_count + 1;
}
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
						</tr>
					</thead>
					<?php
					$start = 10 * ($list -1 );
					foreach(array_slice($announce_list, $start, 10) as $announce_item){
						echo "<tbody>";
						echo "<tr>";
						$number = $announce_item->getKey();
						echo "<td data-title='번호' class='no'>".$number."</td>";
						$title = $announce_item->getTopic();
						echo "<td class='subject'><a href=./sub.php?page=notice_view&list=$list&id=$number>".$title."</a></td>";
						$date = $announce_item->getDate();
						echo "<td data-title='날짜' class=\"nums\">".$date."</td>";
						echo "</tr>";
						echo "</tbody>";
					}
					?>
				</table>
			</div>
			<div class="paginate">
				<?php
				$current_page = 0;
				$prev_page = $list;
				$next_page = $list;
				if($next_page < $pages_count){
					$next_page = $list + 1;
				}
				if($prev_page > 1){
					$prev_page = $list - 1;
				}
				echo "<a href=./sub.php?page=notice_list&list=$prev_page>&lt;&nbsp;Prev</a>";
				//need to change display only 10 pagination
				for($i=0; $i<$pages_count; $i++){
					$current_page = $current_page + 1;
					if($current_page != $list) {
						echo '<a href=./sub.php?page=notice_list&list='. $current_page .'>'.$current_page.'</a>';
					}
					else{
						echo "<strong class=\"current\">$current_page</strong>";
					}
				}
				echo "<a href=./sub.php?page=notice_list&list=$next_page>Next&nbsp;&gt;</a>";
				?>

				<!-- 모바일일 경우 5까지
				<a href="#">6</a>
				<a href="#">7</a>
				<a href="#">8</a>
				<a href="#">9</a>
				<a href="#">10</a>
				-->

			</div>
