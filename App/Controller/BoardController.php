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
		$start = $_POST['start'];
		$count = $_POST['cnt'];
		$sql = "SELECT COUNT(*) as cnt FROM `sns_board`";
		$cnt = DB::fetch($sql,[])->cnt;
		$sql = "SELECT * FROM `sns_board` ORDER BY `date` DESC LIMIT $start, $count";
		$result = DB::fetchAll($sql,[]);
		$list = array();
		foreach ($result as $item) {

			// 이미지 가져오기
			$sql = "SELECT * FROM `sns_imgs` WHERE `board_idx` = ? ORDER BY `id` DESC";
			$imgs = DB::fetchAll($sql,[$item->id]);
			// 댓글 가져오기
			$sql = "SELECT * FROM `sns_comment` WHERE `board_idx` = ? ORDER BY `date` DESC";
			$comments = DB::fetchAll($sql,[$item->id]);
			// 글쓴이 정보 가져오기
			$sql = "SELECT * FROM `sns_user` WHERE `id` = ?";
			$user = DB::fetch($sql,[$item->writer]);
			// 좋아요 리스트 가져오기
			$sql = "SELECT * FROM `sns_like` WHERE `board_idx` = ?";
			$likeList = DB::fetchAll($sql,[$item->id]);
			// 좋아요 눌렀는지 안눌렀는지
			$sql = "SELECT * FROM `sns_like` WHERE `board_idx`= ? AND `user_idx` = ?";
			$like = DB::fetch($sql,[$item->id, $_SESSION['user']->id]);

			array_push($list, ["imgs"=>$imgs, "comments"=>$comments, "user"=>$user,"host"=>$_SESSION['user']->id === $item->writer, "board"=>$item, "likeList"=> $likeList, "like"=>$like]);
		}
		echo json_encode(["list"=>$list,"cnt"=>$cnt,"success"=>true],JSON_UNESCAPED_UNICODE);
	}

}

// 지식++;
