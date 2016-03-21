<?php
/*
 * check session

session_start();
if (!isset($_SESSION['user_key'])) {
	header("Location: http:/localhost/makebuy_web/index.php");
	exit();
}
*/

require_once('../class/announce_list.php');

$load_announce_list = new announce_list();
$load_announce_list->getDB('announceKey', 1);
$announce_list = $load_announce_list->getAnnounceList();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Makebuy는 앱에 특화된 가장 안전하고 효율적인 아웃소싱 플랫폼입니다.">

    <link rel="stylesheet" type="text/css" href="../vendors/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../vendors/css/grid.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/style.css">
    <link rel="stylesheet" type="text/css" href="../vendors/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="resources/css/queries.css">
    <link rel="stylesheet" type="text/css" href="../vendors/css/animate.css">


    <title>Makebuy - 앱 특화 아웃소싱 플랫폼</title>
</head>
<body>
<header class="header-default">
    <nav class="nav-default">
        <div class="row">
            <div class="main-logo">
                <img src="../resources/css/img/makebuy_logo.png" alt="makebuy logo" class="logo">
                <p>makebuy</p>
            </div>
            <ul class="main-nav js--main-nav">
                <li><a href="#reg_project">프로젝트 등록</a></li>
                <li><a href="#find_project">프로젝트 찾기</a></li>
                <li><a href="#find_freelancer">프리랜서 찾기</a></li>
            </ul>
            <a class="mobile-nav-icon js--nav-icon"><i class="ion-navicon-round"></i></a>
        </div>
    </nav>
    <nav class="nav-sub">
        <div class="row">
            <ul class="sub-nav js--sub-nav">
                <li><a href="#reg_project">대쉬보드</a></li>
                <li><a href="#find_project">프로필</a></li>
            </ul>
        </div>
    </nav>
</header>

<section class="section-message js--section-message">
    <div class="row">
        <h3 class="content-subject">공지사항</h3>
        <div class="topic-top">
            <p class="topic-lable">제목</p>
            <p class="topic-topic">메이크바이 베타서비스가 시작됩니다</p>
            <P class="topic-time">2015-02-26</P>
        </div>
        <div class="topic-middle">
            <p class="author-lable">글쓴이</p>
            <p class="topic-author">메이크바이</p>
        </div>
        <div class="topic-bottom">
            <?php

            $announce = $announce_list[0];
            $announce_content = $announce->getContent();
            echo $announce_content;

            ?>
        </div>
        <a href="#" id= "announce-button" class="btn btn-big">돌아가기</a>
    </div>

</section>



<footer>
    <div class="row">
        <div class="col span-1-of-2">
            <ul class="footer-legal">
                <li>Makebuy</li>
                <li>서울시 송파구 충정로 10 가든파이브 툴 5층</li>
            </ul>
        </div>

        <div class="col span-1-of-2">
            <div class="col span-1-of-3">
                <p>메이크바이</p>
                <ul class="footer-makebuy">
                    <li><a href="#">서비스 소개</a></li>
                    <li><a href="#">클라이언트 이용 안내</a></li>
                    <li><a href="#">프리랜서 이용 안내</a></li>
                    <li><a href="#">비용 안내</a></li>
                </ul>
            </div>
            <div class="col span-1-of-3">
                <p>About</p>
                <ul class="footer-about">
                    <li><a href="#">회사 소개</a></li>
                    <li><a href="#">자주 묻는 질문</a></li>
                </ul>
            </div>
            <div class="col span-1-of-3">
                <ul class="footer-social">
                    <li><a href="#"><i class="ion-social-facebook icon-small"></i></a></li>
                    <li><a href="#"><i class="ion-social-twitter icon-small"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../vendors/js/jquery.waypoints.min.js"></script>
<script src="../resources/js/script.js"></script>
</body>

</html>