<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="/editor/demo/js/service/HuskyEZCreator.js" charset="utf-8"></script> 
</head>
<body>

	<!-- <form action="/test/post" method="POST" name="smartEditorText">
		<textarea name="textTest" cols="40" rows="13" id="textTest"></textarea>
		<button type="submit" onclick="submitContents()">전송</button>
	</form> -->
	<script type="text/javascript">

		const log = console.log;
		let today = new Date();
		let testData = "2011:11:11:11:11:11";
		let testArr = testData.split(":");
		let dateTemp = new Date();
		dateTemp.setFullYear(testArr[0],testArr[1],testArr[2]);
		dateTemp.setHours(testArr[3],testArr[4],testArr[5],0);
		let now = new Date();
		log(now - dateTemp);


		// var oEditors = [];

		// nhn.husky.EZCreator.createInIFrame({
		// 	oAppRef : oEditors,
		// 	elPlaceHolder : "textTest",
		// 	sSkinURI : "/editor/demo/SmartEditor2Skin.html",
		// 	fCreator : "createSEditor2",
		// 	htParams : {
		// 		bUseToolbar : true,
		// 		bUseVerticalResizer : true,
		// 		bUseModeChanger : true
		// 	}
		// });



		// function submitContents(){
		// 	oEditors.getById["textTest"].exec("UPDATE_CONTENTS_FIELD",[]);
		// }
	</script>
</body>
</html>