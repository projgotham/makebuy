<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Makebuy - 앱 특화 아웃소싱 플랫폼</title>
	<meta name="description" content="Makebuy는 앱에 특화된 가장 안전하고 효율적인 아웃소싱 플랫폼입니다.">
	<meta name="author" content="">

<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- CSS
 ================================================== 
	<link rel="stylesheet" type="text/css" href="css/idangerous.swiper.css">
 -->
	<link rel="stylesheet" href="css/style.css?ver=20160307">
	<link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
	<link rel="stylesheet" type="text/css" href="css/settings.css" media="screen" />

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
	
	<!-- Revolution Slider
	 <script src="js/jquery.themepunch.plugins.min.js"></script> 
	<script src="js/jquery.themepunch.revolution.min.js"></script>
	<script src="js/revolution-slider-options.js"></script>
	 -->

	<!-- Favicons
	================================================== 
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">-->
</head>

<style>
.category-image .link-overlay { background: url('images/common/bg50.png') 0 0 ;}

</style>
<body>
