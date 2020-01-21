<!DOCTYPE html>
<html lang="ko">
<head>
	<script src="/js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<link rel="stylesheet" href="/css/login.css">
	<meta charset="UTF-8">
	<title>MyHub :: 로그인</title>
</head>
<body>
	<div class="container">
		<div class="circle circle1"></div>
		<div class="circle circle2"></div>
		<div class="circle circle3"></div>
		<div class="circle circle4"></div>

		<div class="login-box">
			<div class="login-container">
				<h1 class="title">My Hub</h1>
				<h2>Sign in. <span>To see it in action.</span></h2>
				<form class="login_form" onsubmit="return loginProcess();">
					<input type="email" name="login_email" id="email" placeholder="Email Address">
					<input type="password" name="login_pwd" id="pwd" placeholder="Password">
					<div class="adt_fx">
						<a href="/user/password">Forgot Password?</a>
						<button type="submit" id="login_btn">
							<i class="fas fa-long-arrow-alt-right"></i>
						</button>
					</div>
					<span class="join_link">
						Don't have an account? <a href="/join">Sign up</a>
					</span>
				</form>
			</div>
		</div>
	</div>
</body>
<script>
	function loginProcess(){
		if($.trim(email.value)==""){
			Swal.fire('빈 값','이메일을 입력해주시길 바랍니다.','warning');
			return false;
		}

		if($.trim(pwd.value)==""){
			Swal.fire('빈 값','비밀번호를 입력해주시길 바랍니다.','warning');
			return false;
		}

		let data = {};
		data.email = email.value;
		data.pwd = pwd.value;

		$.ajax({
			data:data,
			url:"/user/login",
			method:'post',
			success : function(e){
				let json = JSON.parse(e);
				if(json.success) Swal.fire('성공',`반갑습니다. ${json.name}님`,'success').then((e)=>{ location.href = "/"});
				else Swal.fire('실패',`등록되지않은 이메일 혹은 비밀번호가 올바르지 않습니다.`,'error')
			}
		});

		return false;
	}
</script>
</html>

<!-- 4F8HB-PNW4W-XJDJP-P4K7W-WB49M -->