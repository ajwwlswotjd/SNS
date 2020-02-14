<script>
	document.querySelector("#tab-menu > .tab2:last-child > ul > li:first-child").classList.add("active");
</script>
<link rel="stylesheet" href="/css/profile.css">
<section id="main"><div id="main-container">
	<div id="profile-section">
		<div class="profile-img-box">
			<div class="profile-img-blur" style="background-image: linear-gradient(to right,#0006,#0007), url('<?= $_SESSION['user']->profile ?>');"></div>	
			<div class="profile-img-container">
				<img src="<?= $_SESSION['user']->profile ?>" alt="">
				<p class="profile-user-name"><?= htmlentities($_SESSION['user']->name) ?></p>
				<button class="profile-user-btn">게시물 보기</button>
			</div>
		</div>
	</div>
</div></section>