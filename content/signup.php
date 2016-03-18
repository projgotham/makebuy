<?php
/*
 * check session
 */
session_start();
if(isset($_SESSION['user_key'])){
	if($_SESSION['user_type']=='client'){
		header("Location: http://localhost/makebuy_web/content/client-dashboard.php");
	}
	else{
		header("Location: http://localhost/makebuy_web/content/freelancer-dashboard.php");
	}
}
?>

<script>$(document).ready(function(){  menu_over("회원가입","회원가입","3","0");  })</script>
<section class="section-signup-form js--section-signup-form">
    <form method="post" action="./lib/signup_process.php" class="signup-form"/>
	<div class='title'>
		<h3 style='padding-bottom:10px;'>또는</h3>
		<h2>
			신규 회원가입
			<div class='border'><span></span></div>
		</h2>
	</div>
    <div class="form_table">
		<table cellpadding='0' cellspacing='0' border='0' width='100%'>
			<col width='20%' />
			<col width='*' />
			<tr>
				<th>이메일</th>
				<td><input type="email" name="email" id="email" placeholder="이메일을 입력하세요" required></td>
			</tr>
			<tr>
				<th>이름</th>
				<td><input type="text" name="name" id="name" placeholder="이름을 입력하세요" required></td>
			</tr>
			<tr>
				<th>비밀번호</th>
				<td><input type="password" name="password" id="password" placeholder="비밀번호를 입력하세요" required></td>
			</tr>
			<tr>
				<th>비밀번호 확인</th>
				<td>
					<input type="password" name="password-check" id="password-check" placeholder="비밀번호를 다시 입력하세요" required>
					<!-- display whether password rignt or wrong -->
					<div id="pwdCheck_text"></div>
				</td>
			</tr>
			<tr>
				<th>연락번호</th>
				<td><input type="text" name="phone" id="phone" placeholder="번호를 입력하세요" required></td>
			</tr>
			<tr>
				<th></th>
				<td>
					<input type="radio" name="user-type" value="client" required>
					</label>저는 앱 개발 전문가를 찾고 있습니다</label>
					<br>
					<input type="radio" name="user-type" value="freelancer" required>
					</label>저는 좋은 프로젝트를 찾고 있습니다</label>
				</td>
			</tr>
		</table>
	</div>
	<div class="board_button">
		<span class="b-button color">
			<input type="submit" value="회원가입" id="signup-button">
		</span>
	</div>
    </form>
</section>
