<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>메이크바이 - 앱 전문 아웃소싱 플랫폼</title>
	<meta name="description" content="메이크바이는 앱에 특화된 가장 안전하고 효율적인 아웃소싱 플랫폼입니다.">
	<meta name="author" content="">

<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Naver WebMaster Metas
      ================================================== -->
	<meta name="naver-site-verification" content="6affb5c7044edcfafb7da34999998f4ef8368bd3"/>

<!-- CSS
 ================================================== 
	<link rel="stylesheet" type="text/css" href="css/idangerous.swiper.css">
 -->
	<link rel="stylesheet" href="css/style.css?ver=20160307">
	<link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
	<link rel="stylesheet" type="text/css" href="css/settings.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/datepicker.css" />
	<!-- Favicon
 ================================================== -->
	<link rel="apple-touch-icon" sizes="57x57" href="images/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="images/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="images/favicons/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="images/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="images/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="images/favicons/manifest.json">
	<link rel="mask-icon" href="images/favicons/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="images/favicons/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
<!-- JS
================================================== 
	<script type="text/javascript" src="js/idangerous.swiper-2.1.min.js"></script>
-->
    <script src="js/jquery-1.11.0.min.js" type="text/javascript"></script> <!-- jQuery -->
	<script src="js/jquery.easing.1.3.js" type="text/javascript"></script> <!-- jQuery easing -->
	<script src="js/modernizr.custom.js" type="text/javascript"></script> <!-- Modernizr -->
    <script src="js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script> <!-- tabs, toggles, accordion -->
    <script src="js/custom.js" type="text/javascript"></script> <!-- jQuery initialization -->
    <script src="js/script.js" type="text/javascript"></script> <!-- jQuery initialization -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webshim/1.15.10/minified/polyfiller.js"></script>
    <!-- Responsive Menu -->
    <script src="js/jquery.meanmenu.js"></script> 
    <script>
		jQuery(document).ready(function () {
			jQuery('.header nav').meanmenu();
		});

		function menu_over(m1,m2,m3,m4){
			if(m2==""){
				$('.container nav.breadcrumbs ul li:eq(1)').text(m1).css({'color':'#333'});
				$('.container nav.breadcrumbs ul li:eq(2)').remove();
			}else{
				$('.container nav.breadcrumbs ul li:eq(1)').text(m1);
				$('.container nav.breadcrumbs ul li:eq(2)').text(m2).css({'color':'#333'});
			}
			$('.container h3.stitle span').html(m2);
			$('.gnb ul.menu li:eq('+m3+')').addClass('active')
			$('.main_menu ul.mmm li.ss1:eq('+m3+') ul.sub li:eq('+m4+')').addClass('active')
			$('.main_menu ul.mmm li.ss1:eq('+m3+')').addClass('current_page_item')
			$('.lnb ul.lnb'+m3).css({'display':'block'})
			$('.lnb ul.lnb'+m3+' li:eq('+m4+')').addClass('active')
		}
		/*
		*/
	</script>
	<!-- Google Analytics -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-76288858-1', 'auto');
		ga('send', 'pageview');
	</script>
	<!-- End Google Analytics -->
</head>

<body>

