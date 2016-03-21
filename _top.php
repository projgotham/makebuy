<?php
session_start();
	if(isset($_SESSION['user_key'])) {
		$session = "login";
	}
	$user_type = $_SESSION['user_type'];
?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
<header class="header">
	<div class="top_gnb">
		<div class="container">
			<div class="logo">
				<a href="index.php"><img src="images/common/makebuy_logo.png" alt="Makebuy" />&nbsp;makebuy</a>
			</div>
			<!-- logo -->
			<div class="top_menu">
				<ul>
					<?php if($session != "login"){?>
						<li class="ss2">
							<a href="sub.php?page=login">로그인</a>
						</li>
					<?php }else{?>
						<li class="ss2">                                                                                  
							<a href="sub.php?page=logout">로그아웃</a>
						</li>
					<?php }?>
				</ul>
			</div>
			<!-- navigation -->
			<nav class="main_menu">
				<ul class="mmm">
					<li class="ss1">
						<a href="sub.php?page=create-project">프로젝트 등록</a>
					</li>
					<li class="ss1">
						<a href="sub.php?page=search-projects">프로젝트 찾기</a>
					</li>
					<li class="ss1">
						<a href="sub.php?page=guide">이용안내</a>
						<!--
						<ul class="sub">
							<li><a href="./sub.php?page=service">서비스 소개</a></li>
							<li><a href="./sub.php?page=client">클라이언트 이용안내</a></li>
							<li><a href="./sub.php?page=freelancer">프리랜서 이용안내</a></li>
							<li><a href="./sub.php?page=price">비용안내</a></li>
						</ul>
						-->
					</li>
					<?php 
						//echo "session = ".$session;
						//echo "&nbsp;";
						//echo "user_type = ".$user_type; 
					?>
					<?php if($session != "login"){?>
						<li class="ss1">                                                                                  
							<a href="sub.php?page=signup">회원가입</a>
						</li>
					<?php }else{?>
						<li class="ss1">
							<a href="#">
								<?php
									if ($user_type == 'client') {
										echo "클라이언트";

									} else {
										echo "프리랜서";
									}
								?>
								회원
							</a>
							<ul class="sub">
								<?php
								if ($user_type == 'client') {
									echo "<li><a href=\"./sub.php?page=client-dashboard\">대쉬보드</a></li>";
									echo "<li><a href=\"./sub.php?page=client-profile\">프로필</a></li>";

								} else {
									echo "<li><a href=\"./sub.php?page=freelancer-dashboard\">대쉬보드</a></li>";
									echo "<li><a href=\"./sub.php?page=freelancer-profile\">프로필</a></li>";
								}
								?>
							</ul>
						</li>
					<?php }?>
				</ul>
			</nav>
			<div class="clearfix"></div>
		</div>
	</div>
</header>
