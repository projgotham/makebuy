<?php
/*
 * check session
 */
session_start();
if(isset($_SESSION['user_key'])){
	if($_SESSION['user_type']=='client'){
		header("Location: http://localhost/makebuy/content/client-dashboard.php");
	}
	else{
		header("Location: http://localhost/makebuy/content/freelancer-dashboard.php");
	}
}
?>

<script>$(document).ready(function(){  menu_over("회원가입","회원가입","3","0");  })</script>
<!-- facebook signup code -->
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v2.5&appId=1060974943923782";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<script>
	function statusChangeCallback(response) {
		console.log('statusChangeCallback');
		console.log(response);
		if (response.status === 'connected') {
			handleFacebookRegist(response);
		} else if (response.status === 'not_authorized') {
			FB.login(function (response) {
					handleFacebookRegist(response);
				},
				{scope: 'email, user_likes'});
		}
		else {
			FB.login(function (response) {
					handleFacebookRegist(response);
				},
				{scope: 'email, user_likes'});
		}
	}
	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '{your-app-id}',
			cookie     : true,  // enable cookies to allow the server to access
								// the session
			xfbml      : true,  // parse social plugins on this page
			version    : 'v2.2' // use version 2.2
		});
	};
	// 회원가입 핸들러
	function handleFacebookRegist(response) {
		var accessToken = response.authResponse.accessToken;
		var userId, userName, fbId, fblogin;
		FB.api('/me', {fields: 'id, name, email'}, function (user) {
			userId = user.email;    // 페이스북 email
			userName = user.name;   // 페이스북 name
			fbId = user.id;         // 페이스북 id
			fblogin = "facebook";
			if(accessToken){
				if (confirm("Facebook 계정으로 가입하시겠습니까?\n\rFacebook 계정으로 가입시 추가정보를 입력하셔야 합니다.")) {
					$('.btn-facebook').remove();
					$('.signup-form').replaceWith('<form method="post" action="../lib/signup_process.php" class="signup-form"/>');
					$('.signup-form').append('<div class="row"><div class="col span-1-of-3"> <label for="email">이메일</label></div><div class="col span-2-of-3"><input type="email" name="email" id="email" value=' + userId + ' readonly></div></div>');
					$('.signup-form').append('<div class="row"><div class="col span-1-of-3"> <label for="name">이름</label></div><div class="col span-2-of-3"><input type="text" name="name" id="name" value=' + userName + ' readonly></div></div>');
					$('.signup-form').append('<div class="row"><div class="col span-1-of-3"> <label for="password">비밀번호</label></div><div class="col span-2-of-3"><input type="password" name="password" id="password" required></div></div>');
					$('.signup-form').append('<div class="row"><div class="col span-1-of-3"> <label for="password-check">비밀번호확인</label></div><div class="col span-2-of-3"><input type="password" name="password-check" id="password-check" required></div></div>');
					$('.signup-form').append('<div id="pwdCheck_text"></div>');
					$('#password-check').on('blur', function(event){
						if( $('#password')[0].value != $('#password-check')[0].value){
							$('#pwdCheck_text').replaceWith('<div id="pwdCheck_text" style="color:#cf3310"><p>비밀번호가 틀립니다<p></div>');
						}else{
							$('#pwdCheck_text').replaceWith('<div id="pwdCheck_text" style="color:#50c582"><p>비밀번호가 확인되었습니다<p></div>');
						}
					});
					$('.signup-form').append('<div class="row"><div class="col span-1-of-3"> <label for="phone">연락번호</label></div><div class="col span-2-of-3"><input type="text" name="phone" id="phone" required></div></div>');
					$('.signup-form').append('<div class="row"><div class="col span-1-of-2"><p>저는 앱 개발 전문가를 찾고 있습니다</p><input type="radio" name="user-type" value="client" required></div><div class="col span-1-of-2"><p>저는 좋은 프로젝트를 찾고 있습니다</p><input type="radio" name="user-type" value="freelancer" required></div></div>');
					$('.signup-form').append('<div class="row"><div class="col span-1-of-3"> <label for="fbid"></label></div><div class="col span-2-of-3"><input type="hidden" name="fbid" id="fbid" value=' + fbId + '></div></div>');
					$('.signup-form').append('<div class="row"><div class="col span-1-of-3"> <label for="fblogin"></label></div><div class="col span-2-of-3"><input type="hidden" name="fblogin" id="fblogin" value=' + fblogin + '></div></div>');
					$('.signup-form').append(' <div class="row submit-button"> <input type="submit" value="회원가입" id="signup-button"></div>');
					$('.signup-form').submit(function(event){
						if( $('#password')[0].value != $('#password-check')[0].value){
							alert('비밀번호를 확인해주세요');
							return false;
						}
					})
				}
			}
		});
	}
</script>
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
