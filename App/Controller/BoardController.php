<?php

namespace Gondr\Controller;

use Gondr\DB;

class BoardController extends MasterController {

	public function uploadFile()
	{
		$upfile = $_FILES["file"];
		$src = "/upload/".$_POST['name'];
		move_uploaded_file($upfile["tmp_name"],".".$src);
		$idx = $_POST['idx'];
		$sql = "INSERT INTO `sns_imgs`(`id`, `board_idx`, `src`) VALUES (null,?,?)";
		$result = DB::query($sql,[$idx,$src]);
		var_dump($_POST);
		echo json_encode(['success'=> $result,"idx"=>$idx],JSON_UNESCAPED_UNICODE);
	}

	public function uploadProcess()
	{
		$sql = "INSERT INTO `sns_board`(`id`, `content`, `writer`, `date`) VALUES (null,?,?,?)";
		$content = $_POST['value'];
		$writer = $_SESSION['user']->id;
		$today = date("Y:m:d:H:i:s");
		$result = DB::query($sql,[$content,$writer,$today]);
		$sql = "SELECT * FROM `sns_board` ORDER BY `id` DESC LIMIT 0, 1";
		$idx = DB::fetch($sql,[])->id;
		echo json_encode(["success"=>$result,"idx"=>$idx],JSON_UNESCAPED_UNICODE);
	}

	public function loadProcess()
	{
		
	}

}

// 지식++;