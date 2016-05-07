<!-- <script>$(document).ready(function(){  menu_over("회원가입","회원가입","3","0");  })</script> -->
<section class="section-signup-form js--section-signup-form">
    <form method="post" action="./lib/password_change_process.php">
        <div class="form_table">
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                <col width='20%' />
                <col width='*' />
                <tr>
                    <th>현재 비밀번호</th>
                    <td><input type="password" name="current_password" placeholder="현재 비밀번호를 입력하세요" required></td>
                </tr>
                <tr>
                    <th>신규 비밀번호</th>
                    <td><input type="password" name="new_password" id="password" placeholder="바꿀 비밀번호를 입력하세요" required></td>
                </tr>
                <tr>
                    <th>비밀번호 확인</th>
                    <td><input type="password" name="new_password_check" id="password-check" placeholder="바꿀 비밀번호를 확인하세요" required></td>
                    <div id="pwdCheck_text"></div>
                </tr>
            </table>
        </div>
        <div class="board_button">
		<span class="b-button color">
			<input type="submit" value="비밀번호 변경하기"">
		</span>
        </div>
    </form>
</section>