		<section>
			<div class="form_table">
				<table>
					<col width='20%' />
					<col width='*' />
						<tr>
							<th>제목</th>
							<td data-title='제목'><input type="text" name="subject" id="subject" placeholder="제목" required /></td>
						</tr>
						<tr>
							<th>내용</th>
							<td data-title='내용'>
								<textarea class="" name="bid-content" id="bid-content" placeholder="내용 " required></textarea>
							</td>
						</tr>
				</table>
			</div>
			<div class="board_button">
				<a href="./sub.php?page=notice_list" class="b-button color"><span><i class="ion-ios-list"></i>목록</span></a>
				<?php
					session_start();
					$user = $_SESSION['user_key'];
					//display write button when user is admin
					if($user == 1){
						echo "<a href=\"./sub.php?page=$page&sec=write\" class=\"b-button active\"><span><i class=\"ion-arrow-up-c\"></i>업로드</span></a>";
					}
				?>

			</div>
