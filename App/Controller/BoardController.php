<?php

namespace Gondr\Controller;

use Gondr\DB;

class BoardController extends MasterController {

	public function uploadFile()
	{
		$upfile = $_FILES["file"];
		$src = "/upload/".$_POST['name'];
		move_uploaded_file($upfile["tmp_name"],".".$src);
		echo json_encode(['success'=>true],JSON_UNESCAPED_UNICODE);
	}

	public function uploadProcess()
	{
		$sql = "INSERT INTO `sns_board`(`id`, `content`, `writer`, `imgs`, `likes`, `date`) VALUES (null,?,?,?,'',?)";
		$content = $_POST['value'];
		$writer = $_SESSION['user']->id;
		$imgs = $_POST['fileList'];
		$today = date("Y:m:d:H:i:s");
		$result = DB::query($sql,[$content,$writer,$imgs,$today]);
		echo json_encode(["success"=>$result],JSON_UNESCAPED_UNICODE);
	}

}

// 지식++;