<?php
/*
 * check session
 */
session_start();
if (!isset($_SESSION['user_key'])) {
	header("Location: http://localhost/makebuy_web/index.php");
	exit();
} else if ($_SESSION['user_type'] == 'freelancer') {
	header("Location: http://localhost/makebuy_web/content/freelancer-dashboard.php");
	exit();
}

require_once('../class/user_info.php');

$user_information = new user_info();
$user_information->getDB($_SESSION['user_key']);

$current_user = $user_information->getCurrentUser();
?>

<script>
	$(document).ready(function(){  
		jQuery('.tabs ul li a').on('click', function(e)  {
			var currentAttrValue = jQuery(this).attr('href');
			// Show/Hide Tabs
			jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
			// Change/remove current tab to active
			jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

			e.preventDefault();
		});
		menu_over("","","5","2");  
	})
</script>
        <section class="section-fl-profile js--section-fl-profile">
			<div class='title'>
				<h2>
					CreativeStudio
					<div class='border'><span></span></div>
				</h2>
				<h3 class='user-auth' style='padding-bottom:10px;'>신원이 확인되었습니다</h3>
                <div class="fl-intro" id="fl-profile">
					<div class="col span-2-of-3 intro-box">
						<?php
						echo "<h4>$current_user->getUserDesc()</h4>";
						?>
					</div>
                    <a href="#" id= "editProfile-button" class="b-button color"><span><i class="ion-edit"></i>프로필 수정하기</span></a>
                    <figure class="col span-1-of-3 photo-box">
                        <?php
                            echo "";
                            // <img src="../resources/img/dummyimg.png" alt="dummy">
                        ?>
                    </figure>
                </div>
        </section>



	</div>
</div>