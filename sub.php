<?php

$config = parse_ini_file(__DIR__.'/config/config.ini');
$address = $config['local'];

$page = $_GET['page'];
$sec = $_GET['sec'];
$sub_title = $_GET['sub_title'];
$sub_msg = $_GET['sub_msg'];
$sub_btn1 = $_GET['sub_btn1'];
$sub_btn2 = $_GET['sub_btn2'];

session_start();

SWITCH ($page) {
    case 'create-project':
        $sub_title = "프로젝트 등록하기";
        $sub_msg = "메이크바이의 프로젝트 도우미와 함께 <li></li>당신의 아이디어에 힘을 더해 주세요.";
        $sub_btn1 = array("#", "프로젝트 도우미로 시작하기", "ion-help", "btn-projectHelper-banner","projectHelper();");
        echo "
<script>
    function projectHelper(){
        alert(\"준비 중입니다. 이제 곧 만나보실 수 있습니다!\");
    }
</script>";
        if(!isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=login");
            exit();
        } else if($_SESSION['user_type'] == 'freelancer'){
            header("Location: ".$address."sub.php?page=freelancer-dashboard");
            exit();
        }
        break;
    case 'project-regist':
        $sub_title = "프로젝트 지원하기";
        //$sub_msg = "메이크바이의 프로젝트 도우미와 함께 당신의 아이디어에 힘을 더해 주세요.";
        //$sub_btn1 = array("#","프로젝트 도우미로 시작하기","ion-help");

        if(!isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=login");
            exit();
        } else if($_SESSION['user_type'] == 'client'){
            header("Location: ".$address."sub.php?page=client-dashboard");
            exit();
        }

        break;
    case 'project-intro':
        $sub_title = "프로젝트 상세보기";
        $sub_msg = "메이크바이의 프로젝트 도우미와 함께 <li></li>당신의 아이디어에 힘을 더해 주세요.";
        //$sub_btn1 = array("./sub.php?page=freelancer-dashboard","대쉬보드","ion-easel");
        //$sub_btn2 = array("./sub.php?page=freelancer-profile","프로필","ion-information");

        if(!isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=login");
            exit();
        }

        break;
    case 'search-projects':
        $sub_title = "프로젝트 찾기";
        $sub_msg = "당신의 능력을 필요로 하는 <li></li>프로젝트가 한 곳에 모여있습니다.";
        //$sub_btn1 = array("./sub.php?page=freelancer-dashboard", "대쉬보드", "ion-easel");
        //$sub_btn2 = array("./sub.php?page=freelancer-profile", "프로필", "ion-information");

        if(!isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=login");
            exit();
        }
        break;
    case 'guide':
        $sub_title = "이용안내";
        $sub_msg = "메이크바이는 앱에 특화된 가장 안전하고 <li></li>효율적인 아웃소싱 플랫폼입니다.";
        $sub_btn1 = array("#", "페이스북으로 로그인", "ion-social-facebook", "facebook", "checkLoginState();");
        if(isset($_SESSION['user_key'])){
            $sub_btn1 = null;
        }
        break;
    case 'login':
        $sub_title = "로그인";
        $sub_msg = "환영합니다! 일도 좋지만 <li></li>기지개 한 번 피고 시작할까요?";
        $sub_btn1 = array("#", "페이스북으로 로그인", "ion-social-facebook", "facebook", "checkLoginState();");

        if(isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=".$_SESSION['user_type']."-dashboard");
            exit();
        }
        break;
    case 'signup':
        $sub_title = "회원가입";
        $sub_msg = "메이크바이와 함께라면 안심하세요. <li></li>당신은 재능이 가장 빛나게 됩니다.";
        $sub_btn1 = array("#", "페이스북으로 회원가입", "ion-social-facebook", "facebook", "checkLoginState();");

        if(isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=".$_SESSION['user_type']."-dashboard");
            exit();
        }
        break;
    case 'fb-signup':
        $sub_title = "회원가입";
        $sub_msg = "메이크바이와 함께라면 안심하세요. <li></li>당신은 재능이 가장 빛나게 됩니다.";
        //$sub_btn1 = array("#", "페이스북으로 회원가입", "ion-social-facebook", "facebook", "checkLoginState();");

        break;
    case 'freelancer-dashboard':
        $sub_title = "프리랜서 대쉬보드";

        if(!isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=login");
            exit();
        } else if($_SESSION['user_type'] == 'client'){
            header("Location: ".$address."sub.php?page=client-dashboard");
            exit();
        }

        break;
    case 'freelancer-profile':
        $sub_title = "프리랜서 프로필";
        //$session = "login";
        //$user_type = "freelancer";

        if(!isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=login");
            exit();
        } else if($_SESSION['user_type'] == 'client'){
            header("Location: ".$address."sub.php?page=client-dashboard");
            exit();
        }
        break;
    case 'client-dashboard':
        $sub_title = "클라이언트 대쉬보드";
        //$session = "login";
        //$user_type = "client";
        if(!isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=login");
            exit();
        } else if($_SESSION['user_type'] == 'freelancer'){
            header("Location: ".$address."sub.php?page=freelancer-dashboard");
            exit();
        }
        break;
    case 'client-profile':
        $sub_title = "클라이언트 프로필";
        $sub_msg = "메이크바이와 함께라면 안심하세요. <li></li>당신은 재능이 가장 빛나게 됩니다.";
        //$sub_btn1 = array("./sub.php?page=client-dashboard","대쉬보드","ion-easel");
        //$sub_btn2 = array("./sub.php?page=client-profile","프로필","ion-information");
        //$session = "login";
        //$user_type = "client";
        if(!isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=login");
            exit();
        } else if($_SESSION['user_type'] == 'freelancer'){
            header("Location: ".$address."sub.php?page=freelancer-dashboard");
            exit();
        }
        break;
    case 'user-security':
        $sub_title = "개인정보 보호방침";
        $sub_msg = "메이크바이는 앱에 특화된 가장 안전하고 <li></li>효율적인 아웃소싱 플랫폼입니다.";
       // $sub_btn1 = array("#", "페이스북으로 로그인", "ion-social-facebook", "facebook", "checkLoginState();");
        break;
    case 'user-agreement':
        $sub_title = "이용약관";
        $sub_msg = "메이크바이는 앱에 특화된 가장 안전하고 <li></li>효율적인 아웃소싱 플랫폼입니다.";
       // $sub_btn1 = array("#", "페이스북으로 로그인", "ion-social-facebook", "facebook", "checkLoginState();");
        break;
    case 'service':
        $sub_title = "서비스 소개";
        $sub_msg = "메이크바이와 함께 당신의 아이디어에 힘을 더해 주세요.";
        break;
    case 'client':
        $sub_title = "클라이언트 이용안내";
        $sub_msg = "";
        break;
    case 'freelancer':
        $sub_title = "프리랜서 이용안내";
        $sub_msg = "";
        break;
    case 'price':
        $sub_title = "비용안내";
        $sub_msg = "";
        break;
    case 'company':
        $sub_title = "회사소개";
        $sub_msg = "진심을 잇습니다";
        break;
    case 'faq':
        $sub_title = "자주 묻는 질문";
        $sub_msg = "";
        break;
    case 'notice_list':
        $sub_title = "공지사항";
        $sub_msg = "";
        break;
    case 'notice_view':
        $sub_title = "공지사항";
        $sub_msg = "";
        break;
    case 'participant-list':
        $sub_title = "지원자목록";
        $sub_msg = "";
        break;
    case 'project-helper-intro':
        $sub_title = "프로젝트 도우미";
        $sub_msg = "당신의 아이디어에 완벽을 더합니다";
        if(!isset($_SESSION['user_key'])){
            header("Location: ".$address."sub.php?page=login");
            exit();
        } else if($_SESSION['user_type'] == 'freelancer'){
            header("Location: ".$address."sub.php?page=freelancer-dashboard");
            exit();
        }
        break;
    case 'freelancer-detail':
        $sub_title = "프리랜서 프로필";
        $sub_msg = "";
        break;
    case 'user-profile':
        $sub_title = "프로필 변경";
        $sub_msg = "";
        if(!isset($_SESSION['user_key'])) {
            header("Location: " . $address . "sub.php?page=login");
            exit();
        }
        break;
    case 'user-password':
        $sub_title = "비밀번호 변경";
        $sub_msg = "";
        if(!isset($_SESSION['user_key'])) {
            header("Location: ".$address."sub.php?page=login");
            exit();
        }
        break;
}
include_once("_header.php");
include_once("_top.php");
?>
<div class="<?php if ($sub_btn1) {
    echo "sub";
} else {
    echo "mini";
} ?>_visual sub_visual_<?php echo $_GET['page']; ?>">
    <div class="container">
        <div class="welcome">
            <h2><?php if ($sub_title) {
                    echo $sub_title;
                } else {
                    echo $page;
                } ?></h2>
            <h3><?php echo $sub_msg; ?></h3>
        </div>
        <div class='board_button'>
            <?php if ($sub_btn1) { ?>
                <a href="<?php echo $sub_btn1[0]; ?>" class="b-button color <?php echo $sub_btn1[3]; ?>"
                   onclick="<?php echo $sub_btn1[4]; ?>"><span><?php if ($sub_btn1[2]) echo "<i class='" . $sub_btn1[2] . "'></i>"; ?><?php echo $sub_btn1[1]; ?></span></a>
            <?php } ?>
            <?php if ($sub_btn2) { ?>
                <a href="<?php echo $sub_btn2[0]; ?>" class="b-button color"><span><i
                            class="<?php echo $sub_btn2[2]; ?>"></i><?php echo $sub_btn2[1]; ?></span></a>
            <?php } ?>
        </div>
    </div>
</div>
<div class="sec1">
    <div class="container">
        <!--
		<div class="sixteen columns page-title">
			<div class="eight columns alpha">
				<h3 class="stitle"><span><?php echo $sub_title; ?></span></h3>
			</div>
			<div class="eight columns omega">
				<nav class="breadcrumbs">
					<ul class="pos">
						<li><a>Home</a></li>
						<li>-</li>
						<li>-</li>
					</ul>
				</nav>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		-->
        <?php
        if ($sec) {
            $pages = $page . "_" . $sec;
        } else {
            $pages = $page;
        }
        include_once "content/" . $pages . ".php";
        ?>
    </div>
</div>
<!-- container -->

<?php
include_once("_tail.php");
include_once("_footer.php");
?>

