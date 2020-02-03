<script src="/js/form.js"></script>
<section id="main">
	<?php  // echo $_SERVER['REMOTE_ADDR']; ?>
	<input type="color" id="bgc_input">
	<input type="color" id="color_input">
	<input type="file" id="form_file" multiple>
	<div class="form-form-box">
		<div class="form-form-container">
			<div class="form-form-title">글쓰기</div>
			<div class="form-button-box">
				<button class="bld form_btn" data-property="bold">B</button>
				<button class="it form_btn" data-property="Italic">T</button>
				<button class="udl form_btn" data-property="Underline">U</button>
				<button class="strk form_btn" data-property="StrikeThrough">S</button>
				<button class="jstfl form_btn" data-property="justifyleft">
					<i class="fas fa-align-left"></i>
				</button>
				<button class="jstfc form_btn" data-property="justifycenter">
					<i class="fas fa-align-center"></i>
				</button>
				<button class="jstfr form_btn" data-property="justifyright">
					<i class="fas fa-align-right"></i>
				</button>
				<button class="bgclr form_btn_color" data-property="backColor">
					<i class="fas fa-fill-drip"></i>
				</button>
				<button class="clr form_btn_color" data-property="foreColor">
					<i class="fas fa-tint"></i>
				</button>
			</div>
			<div class="editorDiv" contenteditable="true" placeholder="새로운 소식을 남겨보세요." spellcheck="false"></div>
			<div class="form-image-box">

				<button type="button" id="form-image-add">
					<i class="fas fa-plus"></i>
				</button>
			</div>
			<div class="form-bottom">
				<button type="submit" class="form-submit">게시</button>
			</div>
		</div>		
	</div>
</section>