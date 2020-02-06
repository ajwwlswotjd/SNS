<!DOCTYPE html>
<html lang="ko">
<head>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
						<?php $profile = $_SESSION['user']->profile  ?>
						<?php if(trim($profile)!="") : ?>
							<img src="<?= $profile ?>" alt="<?= $_SESSION['user']->id ?>의 프로필">
						<?php else : ?>
							<i class="far fa-user-circle"></i>
						<?php endif; ?>

						<div class="user-text">
							<span class="username">
								<?= htmlentities($_SESSION['user']->name) ?>
							</span>

							<span class="usernick">
								<?= trim($_SESSION['user']->nick) == "" ? "프로필 설정에서 별명을 작성해주세요." : htmlentities($_SESSION['user']->nick) ?>
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
						<li>
							<a href="/">HOME</a>
						</li>
						<li>
							<a href="/form">FORM</a>
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