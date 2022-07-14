<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="description" content="스테이다다는 아파트에 비해 지금껏 소외 되었던 다세대,연립,단독주택 시장의 가치에 더 나은 주거환경을 제공하는 프리미엄 주택 구독 플랫폼입니다.">
<meta name="keywords" content="스테이다다, staydada, 익선다다, 주택, 플랫폼">
<meta property="og:url" content="http://staydada.com">
<meta property="og:title" content="Welcome to Staydada">
<meta property="og:image" content="/images/sign_staydada.png">
<meta property="og:description" content="스테이다다는 아파트에 비해 지금껏 소외 되었던 다세대,연립,단독주택 시장의 가치에 더 나은 주거환경을 제공하는 프리미엄 주택 구독 플랫폼입니다.">
<meta property="og:type" content="website">
<link rel="shortcut icon" href="/images/favicon_staydada.ico">

<link rel="stylesheet" type="text/css" href="/css/font.css" />
<link rel="stylesheet" type="text/css" href="/css/common.css" />
<link rel="stylesheet" type="text/css" href="/css/jquery.fullPage.css" />
<link rel="stylesheet" type="text/css" href="/css/header_footer.css">
<link rel="stylesheet" type="text/css" href="/css/slick_style.css">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/responsive.css">

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="/js/fadeinup.js"></script>
<script type="text/javascript" src="/js/TweenMax.js"></script> 
<script type="text/javascript" src="/js/UI.menu.js"></script>
<script type="text/javascript" src="/js/slick.js"></script>
<script type="text/javascript" src="/js/jquery.leanModal.min.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">	 

<script>
$(document).ready(function() {
	var max = 100; 
	$(window).scroll(function(){
		var scrollPX = $(this).scrollTop();
		if( scrollPX  < max ) {
			$("#header").removeClass("change");
			$(".btn_top").css({"opacity": "0"});
		}else{
			$("#header").addClass("change");
			$(".btn_top").css({"opacity": "1"});
		}	
	});
	$('.btn_top').bind('click', function() {
		$('html, body').animate({scrollTop:0},400);
		return false;
	});
	$('.wish_icon').click(function(){
		$(this).toggleClass('on');
	});
	$('.pointer_faq').click(function(){
		$(this).toggleClass('content-visible');
	});
}); 
</script>

<title>Staydada</title>
</head>
<body>
<div class="btn_top"><img src="/images/btn_top.svg"></div>
<div id="container">
	<header id="header">				
		<!-- 데스크탑메뉴 -->
		<section>
			<a href="/main/main.php"><div class="top_logo"></div></a>
			<div class="menu_list pc_only_1024">
				<a href="/main/about.php" onMouseOver='this.innerHTML="사업소개"' onMouseOut='this.innerHTML="About"'>About</a>
				<a href="/stay/stay.php"  onMouseOver='this.innerHTML="지점소개"' onMouseOut='this.innerHTML="Stay"'>Stay</a>
				<!-- <a href="shop/shop.html"><span>α-Shop</span></a> -->
				<a href="/apply/apply.php"  onMouseOver='this.innerHTML="상담문의"' onMouseOut='this.innerHTML="Contact"'>Contact</a>
			</div>
			<div class="side_menu pc_only_1024">
				<ul>
					<li onMouseOver='this.innerHTML="건물주 상담"' onMouseOut='this.innerHTML="Franchise"'><a href="/main/franchise.php" >Franchise</a></li>
					<!-- <li><a href="member/join.html">Join</a></li> -->
					<!-- 로그인후노출
					<li><a href="#">Mypage</a>
						<ul>
							<li><a href="member/wish_list.html">관심리스트</a></li>
							<li><a href="member/apply_list.html">입주신청내역</a></li>
							<li><a href="member/my_modify.html">회원정보수정</a></li>
						</ul>
					</li>-->
					<!-- <li><a href="member/login.html">Login</a></li> -->
					<!-- <li><a href="#">Logout</a></li> -->
				</ul>
			</div>
		</section>
		<!--/ 데스크탑메뉴 -->
		<!-- 나의관심리스트 숨김처리 
		<section id="gnb" class="">
			<div class="menu_open wish_list"></div>
				<section class="gnb_wrap" style="height: 100%;">
					<div id="wish_container" class="gnb_container">
						<h2 class="wish"><strong>나의 관심 리스트</strong></h2>
						<div class="mb60">
							<h1 class="wish blue">관심지점</h1>
							<ul class="half_wrap_small">
								<li>
									<p><span class="wish_close"></span><a href="stay/stay_detail.html"><img src="../images/img_stay_photo01.jpg"></a></p>
									<p class="shop_ti ti">신월1호점</p>
									<p>입주가능</p>
								</li>
								<li>
									<p><span class="wish_close"></span></span><a href="stay/stay_detail.html"><img src="../images/img_stay_photo02.jpg"></a></p>
									<p class="shop_ti ti">왕십리점</p>
									<p>입주가능</p>
								</li>
								<li>
									<p><span class="wish_close"></span></span><a href="stay/stay_detail.html"><img src="../images/img_stay_photo03.jpg"></a></p>
									<p class="shop_ti ti">서울대입구점</p>
									<p>입주불가</p>
								</li>
								<li>
									<p><span class="wish_close"></span></span><a href="stay/stay_detail.html"><img src="../images/img_stay_photo04.jpg"></a></p>
									<p class="shop_ti ti">사당점</p>
									<p>입주가능</p>
								</li>
							</ul>
						</div>
						<div class="">
							<h1 class="wish blue">관심호실</h1>
							<ul class="half_wrap_small">
								<li>
									<p><span class="wish_close"></span><a id="go" rel="leanModal" name="m_pop01" href="#m_pop01"><img src="../images/img_stay_photo_ho01.jpg"></a></p>
									<p class="shop_ti ti">신월1호점 201호</p>
									<p>입주가능</p>
								</li>
								<li>
									<p><span class="wish_close"></span></span><a id="go" rel="leanModal" name="m_pop01" href="#m_pop01"><img src="../images/img_stay_photo_ho02.jpg"></a></p>
									<p class="shop_ti ti">낙성대점 201호</p>
									<p>입주가능</p>
								</li>
								<li>
									<p><span class="wish_close"></span></span><a id="go" rel="leanModal" name="m_pop01" href="#m_pop01"><img src="../images/img_stay_photo_ho03.jpg"></a></p>
									<p class="shop_ti ti">왕십리점 201호</p>
									<p>입주불가</p>
								</li>
							</ul>
						</div>
					</div>
					<!--/ wish_container -->
					<!-- 숨김 처리 
					<p class="close"><span class="blind">메뉴 닫기</span></p>
				</section>
			<div class="over_back"></div>
		</section>
		<!--/ 나의관심리스트 -->
		<!-- 모바일메뉴 -->
		<section class="partner mo_only_1024">
			<div class="menu_open"><img src="/images/btn_top_menu.png" alt="좌측메뉴"></div>
				<!-- 좌측사이드바 -->			
				<div class="partner_wrap" style="height: 100%;">
					<div class="gnb_container side_menu_wrap">
						<!-- 메뉴 -->
								<div class="cd-faq-items">
									<ul id="side_menu" class="cd-faq-group">
										<li><a href="/main/about.php"><span>About</span></a></li>
										<li><a href="/stay/stay.php"><span>Stay</span></a></li>
										<!-- <li><a href="shop/shop.html"><span>α-Shop</span></a></li> -->
										<li><a href="/apply/apply.php"><span>Application</span></a></li>

										<li class="mt40"><a href="/main/franchise.php">Franchise</a></li>
										<!-- <li><a href="../member/join.php">Join</a></li>
										<li><a href="../member/login.php">Login</a></li>
										<li class="pointer_faq">
											<a href="#"><span class="cd-faq-trigger">Mypage</span></a>
											<ul class="cd-faq-content">
												<li><a href="../member/wish_list.php">관심리스트</a></li>
												<li><a href="../member/apply_list.php">입주신청내역</a></li>
												<li><a href="../member/my_modify.php">회원정보수정</a></li>
											</ul>
										</li> -->
									</ul>
								</div>
						<!--/ 메뉴 -->
					</div>
					<p class="close"><span class="blind">닫기</span></p>
				</div>
				<!--/ 좌측사이드바 -->	
			<div class="over_back"></div>
		</section>
		<!--/ 모바일메뉴 -->
	</header>
