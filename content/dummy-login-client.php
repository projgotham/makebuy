<?php
/**
 * Created by PhpStorm.
 * User: projg
 * Date: 2016-03-20
 * Time: 오후 8:34
 */

session_start();
if (isset($_SESSION['user_key'])) {
    if ($_SESSION['user_type'] == 'client') {
        header("Location: http://localhost/makebuy_web/content/client-dashboard.php");
    } else {
        header("Location: http://localhost/makebuy_web/content/freelancer-dashboard.php");
    }
}
?>
<script>$(document).ready(function(){  menu_over("","","4","");  })</script>
<section class="section-signup-form js--section-signup-form">
    <div class='title'>
        <h3 style='padding-bottom:10px;'>또는</h3>
        <h2>
            Makebuy_client_dummy_login
            <div class='border'><span></span></div>
        </h2>
    </div>
    <form method="post" action="./lib/login_process.php">
        <div class="form_table" >
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                <col width='20%' />
                <col width='*' />
                <tr>
                    <th>이메일</th>
                    <td><input type="email" name="email" id="email" placeholder="이메일을 입력하세요" value="client@makebuy.co.kr" required></td>
                </tr>
                <tr>
                    <th>비밀번호</th>
                    <td><input type="password" name="password" id="password" placeholder="비밀번호를 입력하세요" value="asdf1234" required></td>
                </tr>
            </table>
        </div>
        <div class="board_button">
		<span class="b-button color">
			<input type="submit" value="로그인" id="login-button" />
		</span>
            <p style="padding-top:20px;">
                <a href="#">비밀번호를 잊어버렸습니까?</a>
            </p>
        </div>
    </form>
</section>