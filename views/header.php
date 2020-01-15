<!DOCTYPE html>
<html lang="ko">
<head>
	<script src="/js/jquery.js"></script>
	<link rel="stylesheet" href="/css/main.css">
	<meta charset="UTF-8">
	<title>정재성 SNS</title>
</head>
<body>
	<div class="container">
		<div class="logo-container">
			<img src="/imgs/logo.png" alt="logo" id="logo">
			<i class="fas fa-bars"></i>
		</div>
		<header>
			<form class="search-box" method="POST" action="/" onsubmit="return search();">
				<input type="submit" id="search-submit" style="display: none;">
				<button id="search-btn">
					<i class="fas fa-search"></i>
				</button>
				<input type="text" name="value" placeholder="" id="search-input">
			</form>

			<div class="user-box">
				<div class="user-container">
					<div class="user-info">
						<img src="/imgs/vkeod1.jpg" alt="" class="user-img">
						<!-- <i class="user-img far fa-user-circle"></i> -->

						<div class="user-text">
							<span class="username">
								정재성인척하는정재성인척하는정재성
							</span>

							<span class="usernick">
								다른모든눈송이와아주비슷하게생긴단하나의눈송이
							</span>
						</div>
					</div>

					<div class="user-menu">
						<i class="fas fa-bars"></i>
					</div>
				</div>
			</div>
		</header>

		<nav>
			<div class="tab1" id="tab-menu">
				<h1>MENU</h1>

				<div class="tab2">
					<div class="tab2-top">
						<i class="far fa-newspaper"></i>
						<span>Dashboards</span>
						<i class="fas fa-angle-down"></i>
					</div>

					<ul>
						<li class="active">
							<a href="/">TEST</a>
						</li>
						<li>
							<a href="/">TEST2</a>
						</li>
					</ul>
				</div>

				<div class="tab2">
					<div class="tab2-top">
						<i class="fas fa-gamepad"></i>
						<span>MapleStory</span>
						<i class="fas fa-angle-down"></i>
					</div>
					<ul>
						<li>
							<a href="/">MaeWoo</a>
						</li>
						<li>
							<a href="/">JaeMitNun</a>
						</li>
						<li>
							<a href="/">Game</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="tab1" id="tab-test">
				<h1>PROFILE</h1>
				<div class="tab2">
					<div class="tab2-top">
						<i class="fas fa-user-graduate"></i>
						<span>JungJaeSeong</span>
						<i class="fas fa-angle-down"></i>
					</div>

					<ul>
						<li>
							<a href="/">AhJoo</a>
						</li>
						<li>
							<a href="/">JalSaeng</a>
						</li>
						<li>
							<a href="/">Kin NamJa</a>
						</li>
					</ul>
				</div>

				<div class="tab2">
					<div class="tab2-top">
						<i class="fas fa-user-injured"></i>
						<span>AhnJinu</span>
						<i class="fas fa-angle-down"></i>
					</div>

					<ul>
						<li>
							<a href="/">MinMeori</a>
						</li>
						<li>
							<a href="/">DaeMeori</a>
						</li>
						<li>
							<a href="/">MandleMandle</a>
						</li>
						<li>
							<a href="/">PpakPpakI</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<section id="main">
			<div id="main-container">
				
			</div>
		</section>

		<script>
			$("nav > .tab1 > .tab2 > ul > li").on("click",(e)=> e.target.querySelector("a").click());

			$(".tab2-top > i:last-child").on("click",(e)=>{
				$($(e.target).parent().parent()[0].querySelector("ul")).slideToggle(300);
				if($(e.target).hasClass("fa-angle-down")){
					$(e.target).removeClass("fa-angle-down");
					$(e.target).addClass("fa-angle-up");
				}
				else {
					$(e.target).addClass("fa-angle-down");
					$(e.target).removeClass("fa-angle-up");	
				}
			});

			let searchMod = false;

			function search(){
				let value = $("#search-input").val();
				$("#search-input").val("");
				return value!="";
			}

			$("#search-btn").on("click",(e)=>{
				if(!searchMod){
					document.querySelector("#search-input").style.display = "block";
					document.querySelector("#search-input").style.width = "65px";
					document.querySelector("#search-input").focus();
					searchMod = true;
				}
			});

			$("#search-input").on("input",(e)=>{
				let value = e.target.value;
				$(e.target).parent().append('<div id="virtual_dom">' + value + '</div>');
				let inputWidth = $("#virtual_dom").width()+55;
				$(e.target).css('width',inputWidth);
				$('#virtual_dom').remove();
			});

			$("#search-input").on("focusout",(e)=>{
				searchMod = !e.target.value=="";
				if(!searchMod) e.target.style.display = "none";
			});
		</script>