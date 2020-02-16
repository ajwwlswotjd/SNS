<?php if(!$data[0]) : ?>
	<script>location.href="/error";</script>
<?php endif; ?>
<script src="/js/profile.js"></script>
<link rel="stylesheet" href="/css/profile.css">
<section id="main"><div id="main-container">
	<div id="profile-section">
		<div class="profile-img-box">
			<div class="profile-img-blur" style="background-image: linear-gradient(to right,#0006,#0007), url('<?= $data[0]->profile ?>');"></div>	
			<div class="profile-img-container">
				<img src="<?= $data[0]->profile ?>" alt="">
				<?php if($_SESSION['user']->id == $_GET['id']) : ?>
					<div class="profile-img-change">프로필 변경</div>
				<?php endif; ?>
				<p class="profile-user-name"><?= htmlentities($data[0]->name) ?></p>
				<p class="profile-user-email"><?= htmlentities($data[0]->email) ?></p>
				<div class="profile-user-btn-box">
					<?php if($_SESSION['user']->id != $_GET['id']) : ?>
						<button data-get="<?= $_GET['id'] ?>" class="profile-user-btn notMe" data-status="<?= $data[3] ?>">
							<?= $data[4] ?>
						</button>
					<?php endif; ?>
					<a href="/user/board/?id=<?= $_GET['id'] ?>" class="profile-user-btn">게시물 보기</a>
				</div>
			</div>
		</div>

		<div class="profile-right">
			<div class="profile-right-top">
				<div class="profile-right-top-show">
					<div><?= htmlentities($data[0]->nick == "" ? "별명 미작성" : $data[0]->nick) ?></div>
					<?php if($_SESSION['user']->id === $_GET['id']) : ?>
						<button class="profile-edit">별명 수정</button>
					<?php endif; ?>
				</div>
				<?php if($_SESSION['user']->id === $_GET['id']) : ?>
				<div class="profile-edit-box">
					<input type="text" placeholder="별명을 작성해주세요." value="<?= htmlentities($_SESSION['user']->nick) ?>" maxlength="20">
					<button class="profile-edit-input-edit">확인</button>
				</div>
				<?php endif; ?>
			</div>
			<div class="profile-right-flex">

				<div class="profile-date-box">
					<i class="far fa-calendar-alt"></i>	
					계정 생성일
					<span>
					<?php
						$arr = explode(":",$data[0]->date);
						echo $arr[0]."년 ";
						echo substr($arr[1],0,1) == "0" ? substr($arr[1],1) : $arr[1];
						echo "월 ";
						echo substr($arr[2],0,1) == "0" ? substr($arr[2],1) : $arr[2];
						echo "일 ";
					?>
					</span>
				</div>

				<div class="profile-friend-cnt-box">
					<i class="fas fa-user-friends"></i>
					친구<span><?= number_format($data[1]) ?>명</span>
				</div>

				<div class="profile-board-cnt-box">
					<i class="far fa-clipboard"></i>
					글<span><?= number_format($data[2]) ?>개</span>
				</div>
			</div>

			<div class="profile-right-content">
				<div class="profile-right-show">
					<textarea disabled class="profile-info-content"><?php echo $data[0]->info=="" ? "소개글이 존재하지 않습니다." : $data[0]->info ?></textarea>
					<?php if($_SESSION['user']->id === $_GET['id']) : ?>
					<button class="profile-info-edit">소개글 수정</button>
					<?php endif; ?>
				</div>

				<div class="profile-right-input">
					<textarea id="profile-right-textarea" placeholder="소개글을 작성해주세요 (최대 200자)" maxlength="200"><?= $data[0]->info ?></textarea>
					<button id="profile-right-input-btn">확인</button>
				</div>
			</div>
		</div>
	</div>
</div></section>