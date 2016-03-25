<?php
$list = $_GET['list'];
$id = $_GET['id'];

require_once (__DIR__."/../class/announce_list.php");

$load_announce_list = new announce_list();
$load_announce_list->getSelectedDB($id);

$announce_list = $load_announce_list->getAnnounceList();

$topic = $announce_list[0]->getTopic();
$date = $announce_list[0]->getDate();
$content = $announce_list[0]->getContent();
?>
<section>
			<h3 class='content-subject'><?php echo $topic ?></h3>
			<div class="form_table">
				<table>
					<col width='20%' />
					<col width='*' />
						<tr>
							<th>날짜</th>
							<td data-title='날짜'><?php echo $date ?></td>
						</tr>
						<tr>
							<th>작성자</th>
							<td data-title='조회'>메이크바이</td>
						</tr>
					<tbody>
						<tr>
							<td colspan="2">
								<div id="article_txt">

									<!-- <img alt="" width="500" height="342" categoryid="5000000000000" src="http://img.segye.com/content/image/2016/03/13/20160313001286_0.jpg"><br><br>
									<font style="font-size: 12px; font-family: arial">사진=바둑TV 방송화면 캡쳐/ 유투브 캡쳐/ 왼쪽 김여원, 오른쪽 정다원 캐스터</font><br>
									<div id="divBox" style="clear:both;text-align:center;">
									</div> -->
                                    <?php echo $content ?>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="board_button">
				<a href="./sub.php?page=notice_list&list=<?php echo $list ?>" class="b-button color"><span><i class="ion-ios-list"></i>목록</span></a>
                <?php
                session_start();
                $user = $_SESSION['user_key'];
                //display write button when user is admin
                if($user == 1){
                    echo "<a href=\"./sub.php?page=notice_write\" class=\"b-button active\"><span><i class=\"ion-arrow-up-c\"></i>글쓰기</span></a>";
                }
                ?>
			</div>
