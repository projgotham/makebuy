<?php
/*
 * check session
 */
/*
session_start();
if(isset($_SESSION['user_key'])){
	if($_SESSION['user_type']=='client'){
		header("Location: http://localhost/makebuy/content/client-dashboard.php");
	}
	else{
		header("Location: http://localhost/makebuy/content/freelancer-dashboard.php");
	}
}
*/
$name = $_POST['name'];
$email = $_POST['email'];
$fbid = $_POST['facebookId'];
$facebook = $_POST['facebook'];

if($facebook != 1){
    header("Location: http://www.makebuy.co.kr");
    exit();
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
    <section class="section-signup-form js--section-signup-form">
        <form id="signup-form" method="post" action="./lib/signup_process.php" class="signup-form"/>
        <div class='title'>
            <h3 style='padding-bottom:10px;'></h3>
            <h2>
                페이스북 회원가입
                <div class='border'><span></span></div>
            </h2>
        </div>
        <div class="form_table">
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                <col width='20%' />
                <col width='*' />
                <tr>
                    <th>닉네임</th>
                    <td><input type="text" name="nickname" id="nickname" placeholder="닉네임을 입력하세요"  required></td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td><input type="email" name="email" id="email" value="<?php echo $email?>" placeholder="이메일을 입력하세요" readonly></td>
                </tr>
                <tr>
                    <th>이름</th>
                    <td><input type="text" name="name" id="name" value="<?php echo $name?>" placeholder="이름을 입력하세요" readonly></td>
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
                <input type="hidden" name="fbid" id="fbid" value="<?php echo $fbid?>" >
                <input type="hidden" name="fblogin" id="fblogin" value='facebook'>
            </table>
        </div>
        <div class="board_button">
		<span class="b-button color">
			<input type="submit" value="회원가입" id="signup-button">
		</span>
        </div>
        </form>
    </section>