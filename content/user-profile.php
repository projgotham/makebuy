<?php
/*
 * Created By: immigration9
 * All rights reserved to Ensemble Lab & makebuy Service
 */
/* SESSION_START is deprecated. The code has been moved to sub.php
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
$userKey = $_SESSION['user_key'];

require_once(__DIR__.'./../class/user_info.php');
$user_info_class = new user_info();
$user_info_class->getDB($userKey);

$current_user = $user_info_class->getCurrentUser();

?>

<!-- <script>$(document).ready(function(){  menu_over("회원가입","회원가입","3","0");  })</script> -->
<section class="section-signup-form js--section-signup-form">
    <form method="post" action="./lib/profile_change_process.php">
    <div class="form_table">
        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
            <col width='20%' />
            <col width='*' />
            <tr>
                <th>닉네임</th>
                <td><input type="text" name="nickname" id="nickname" placeholder="닉네임을 입력하세요" required><?php echo $current_user->getUserId(); ?></td>
            </tr>
            <tr>
                <th>이메일</th>
                <td><input type="email" name="email" id="email" placeholder="이메일을 입력하세요" required readonly><?php echo $current_user->getUserEmail(); ?></td>
            </tr>
            <tr>
                <th>이름</th>
                <td><input type="text" name="name" id="name" placeholder="이름을 입력하세요" required><?php echo $current_user->getUserName(); ?></td>
            </tr>
            <tr>
                <th>연락번호</th>
                <td><input type="text" name="phone" id="phone" placeholder="번호를 입력하세요" required><?php echo $current_user->getUserPhone(); ?></td>
            </tr>
        </table>
    </div>
    <div class="board_button">
		<span class="b-button color">
			<input type="submit" value="프로필 변경하기" id="profile-change-button">
		</span>
    </div>
    </form>
</section>
