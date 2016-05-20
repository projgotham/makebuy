<?php
/**
 * Created by PhpStorm.
 * User: projgotham
 * Date: 2016-05-20
 * Time: 오후 1:42
 */
?>
<section class="section-signup-form js--section-signup-form">
    <div class='title'>
        <h3 style='padding-bottom:10px;'></h3>
        <h2>
            비밀번호 찾기
            <div class='border'><span></span></div>
        </h2>
    </div>
    <form method="post" action="./lib/password_find_process.php">
        <div class="form_table">
            <h4>가입시 사용하였던 이메일을 입력해주세요.</h4><br/>
            <h4>해당 이메일로 임시 비밀번호를 보내드립니다</h4><br/>
            <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                <col width='20%'/>
                <col width='*'/>
                <tr>
                    <th>이메일</th>
                    <td><input type="email" name="email" id="email" placeholder="이메일을 입력하세요" required></td>
                </tr>
            </table>
        </div>
        <div class="board_button">
		<span class="b-button color">
			<input type="submit" value="비밀번호 찾기" id="find-button"/>
		</span>
        </div>
    </form>
</section>

