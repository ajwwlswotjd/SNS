<!DOCTYPE html>
<html lang="ko">
<head>
	<link rel="stylesheet" href="/css/register.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="/js/jquery.js"></script>
	<script src="/js/register.js"></script>
	<meta charset="UTF-8">
	<title>MyHub :: 회원가입</title>
</head>
<body>
	<div class="container">
		<div class="form-box">
			<h1>CREATE ACCOUNT</h1>

			<form id="join-form" onsubmit="return registerProcess();">
				 <div class="input-group">
				 	<input type="text" id="join_name" name="name" placeholder="Your Name">
				 	<label for="join_name">
				 		<i class="far fa-user"></i>
				 	</label>
				 </div>
				 <div class="input-group">
				 	<input type="email" id="join_email" name="email" placeholder="Your Email">
				 	<label for="join_email">
				 		<i class="far fa-envelope"></i>
				 	</label>
				 </div>
				 <div class="input-group">
				 	<input type="password" name="pwd1" id="join_pwd1" placeholder="Password">
				 	<label for="join_ pwd1">
				 		<i class="fas fa-lock"></i>
				 	</label>
				 </div>
				 <div class="input-group">
				 	<input type="password" name="pwd2" id="join_pwd2" placeholder="Repeat your password">
				 	<label for="join_pwd2">
				 		<i class="fas fa-lock"></i>
				 	</label>
				 </div>

				<div class="agree-box">
				 	<input type="checkbox" name="agree" id="join_agree">
				 	<label for="join_agree">
				 		<i class="fas fa-check"></i>
				 	</label>
				 	<span>I agree all statements in <span class="agree-bold">Terms of service</span></span>
				</div>

				<button type="submit" id="join-btn">SIGN UP</button>
			</form>
			<p class="login">Have already an account ? <a href="/login">Login here</a></p>
		</div>
	</div>
</body>
</html>