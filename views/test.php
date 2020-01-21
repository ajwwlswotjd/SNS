<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="/editor/demo/js/service/HuskyEZCreator.js" charset="utf-8"></script> 
</head>
<body>

	<form action="/test/post" method="POST" name="smartEditorText">
		<textarea name="textTest" cols="40" rows="13" id="textTest"></textarea>
		<button type="submit" onclick="submitContents()">전송</button>
	</form>
	<script type="text/javascript">


		var oEditors = [];

		nhn.husky.EZCreator.createInIFrame({
			oAppRef : oEditors,
			elPlaceHolder : "textTest",
			sSkinURI : "/editor/demo/SmartEditor2Skin.html",
			fCreator : "createSEditor2",
			htParams : {
				bUseToolbar : true,
				bUseVerticalResizer : true,
				bUseModeChanger : true
			}
		});



		function submitContents(){
			oEditors.getById["textTest"].exec("UPDATE_CONTENTS_FIELD",[]);
		}
	</script>
</body>
</html>