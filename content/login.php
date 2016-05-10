<?php
/*
 * check session
 */
/*
session_start();
if (isset($_SESSION['user_key'])) {
	if ($_SESSION['user_type'] == 'client') {
		header("Location: http://localhost/makebuy/sub.php?page=client-dashboard");
	} else {
		header("Location: http://localhost/makebuy/sub.php?page=freelancer-dashboard");
	}
}
*/
?>
<script>$(document).ready(function(){  menu_over("","","4","");
		/*
		var form = document.getElementById('formID'); // form has to have ID: <form id="formID">
		form.noValidate = true;
		form.addEventListener('submit', function(event) { // listen for form submitting
			if (!event.target.checkValidity()) {
				event.preventDefault(); // dismiss the default functionality
				alert('Please, fill the form'); // error message
			}
		}, false);
		*/
		webshim.activeLang('en');
		webshims.polyfill('forms');
		webshims.cfg.no$Switch = true;
	})
</script>
<!-- facebook login code -->
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
			$.post("./lib/fbLogin_process.php", {email: userId, name: userName, facebookId: fbId, facebook:1},
				function(postedData){
					//alert(postedData);
					if(postedData == 'client'){
						location.replace('./sub.php?page=client-dashboard');
					}
					else if(postedData == 'freelancer'){
						location.replace('./sub.php?page=freelancer-dashboard');
					}
					//in case of no user data. need to sign up
					else{
						location.replace('./sub.php?page=signup');
					}
				}, "json").fail( function(jqXHR, textStatus, errorThrown) {
				alert(textStatus);;
			});
		});
	}
</script>
<section class="section-signup-form js--section-signup-form">
	<div class='title'>
		<h3 style='padding-bottom:10px;'>또는</h3>
		<h2>
			메이크바이 로그인
			<div class='border'><span></span></div>
		</h2>
	</div>
    <form id="formID" method="post" action="./lib/login_process.php">
	<div class="form_table" >
		<table cellpadding='0' cellspacing='0' border='0' width='100%'>
			<col width='20%' />
			<col width='*' />
			<tr>
				<th>이메일</th>
				<td><input type="email" name="email" id="email" placeholder="이메일을 입력하세요" required/></td>
			</tr>
			<tr>
				<th>비밀번호</th>
				<td><input type="password" name="password" id="password" placeholder="비밀번호를 입력하세요" required/></td>
			</tr>
		</table>
	</div>
	<div class="board_button" style="padding-top:20px;">
		<span class="b-button color">
			<input type="submit" value="로그인" id="login-button" />
		</span>
		<p style="padding-top:20px;">
			<!-- <a href="#">비밀번호를 잊어버렸습니까?</a>-->
		</p>
	</div>
    </form>
</section>
