<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>404 Not Found</title>
	<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
	<style>
		@charset "UTF-8";

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Anton', sans-serif;
		}

		a {
			text-decoration: none;
		}

		li {
			list-style: none;
		}

		body {
			width: 100%;
			height: 100vh;
			position: relative;
			background-color: #849eb1;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		
		.error-container {
			width: 864px;
			height: 484px;
			border-radius: 10px;
			position: relative;
			background-color: #fff;
			box-shadow: 3px 6px 20px 5px #0003;
			display: flex;
		}
	
		.error-container > div {
			height: 100%;
			position: relative;
		}

		.error-container > .error-left {
			width: 45%;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}

		.error-container > .error-right {
			width: 65%;
		}

		.error-left > h1 {
			font-size: 70px;
			letter-spacing: 3px;
			font-weight: bolder;
			color: #289bf0;
			margin-left: 80px;
		}

		.error-left > h2 {
			color: #5f5f5f;
			font-size: 45px;
			display: flex;
			margin-left: 80px;
			font-weight: 500;
		}

		#back:hover {
			background-color: #7dc3f6;
			color: #fff;
			border-color: #fff;
		}

		#back {
			border-radius: 50px;
			width: 90px;
			transition: all .1s;
			height: 35px;
			color: #2a98f3;
			font-size: 15px;
			margin-left: 80px;
			margin-top: 10px;
			border: 1px solid #7dc3f6;
			font-family: "Arial";
			outline: none;
			cursor: pointer;
			background: transparent;
		}
	
		.error-right > img {
			width: 380px;
			height: 380px;
			position: absolute;
			top: 50%;
			left: 52%;
			transform: translate(-50%,-50%);
		}

	</style>
</head>
<body>
	<div class="error-container">
		<div class="error-left">
			<h1>404</h1>	
			<h2>PAGE NOT FOUND</h2>
			<button id="back">Go Back</button>
		</div>

		<div class="error-right">
			<img src="/imgs/vkeod404.jpg" alt="파댕띠">		
		</div>
	</div>
	<script>
		document.querySelector("#back").addEventListener("click",(e)=> history.back());
	</script>
</body>
</html>