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

	public function loadCnt()
	{
		$sql = "SELECT count(*) as cnt FROM `sns_board` ORDER BY `date` DESC";
		$cnt = DB::fetch($sql,[])->cnt;
		echo json_encode(["cnt"=>$cnt],JSON_UNESCAPED_UNICODE);
	}

	public function commentProcess()
	{
		$sql = "INSERT INTO `sns_comment`(`id`, `content`, `user_idx`, `board_idx`, `date`) VALUES (null, ?,?,?,?)";
		$content = htmlentities($_POST['content']);
		$board = $_POST['board'];
		$userId = $_SESSION['user']->id;
		$today = date("Y:m:d:H:i:s");
		$result = DB::query($sql,[$content,$userId,$board,$today]);
		echo json_encode(["result"=>$result],JSON_UNESCAPED_UNICODE);
	}

	public function commentLoad()
	{
		$idx = $_POST['idx'];
		$sql = "SELECT * FROM `sns_comment` WHERE `board_idx`= ? ORDER BY `date` ASC";
		$list = DB::fetchAll($sql,[$idx]);
		$arr = array();
		foreach ($list as $item) {
			$sql = "SELECT * FROM `sns_user` WHERE `id` = ?";
			$user = DB::fetch($sql,[$item->user_idx]);
			array_push($arr,["user"=>$user,"comment"=>$item]);
		}
		echo json_encode(["list"=>$arr],JSON_UNESCAPED_UNICODE);
	}

	public function loadProcess()
	{
		$start = $_POST['start'];
		$count = $_POST['cnt'];
		$sql = "SELECT * FROM `sns_board` ORDER BY `date` DESC LIMIT $start, $count";
		$result = DB::fetchAll($sql,[]);
		$list = array();
		foreach ($result as $item) {

			// 이미지 가져오기
			$sql = "SELECT * FROM `sns_imgs` WHERE `board_idx` = ? ORDER BY `id` DESC";
			$imgs = DB::fetchAll($sql,[$item->id]);
			// 댓글 가져오기
			$sql = "SELECT count(*) as cnt FROM `sns_comment` WHERE `board_idx` = ? ORDER BY `date` DESC";
			$comments = DB::fetch($sql,[$item->id])->cnt;
			// 글쓴이 정보 가져오기
			$sql = "SELECT * FROM `sns_user` WHERE `id` = ?";
			$user = DB::fetch($sql,[$item->writer]);
			// 좋아요 리스트 가져오기
			$sql = "SELECT count(*) as cnt FROM `sns_like` WHERE `board_idx` = ?";
			$likeList = DB::fetch($sql,[$item->id])->cnt;
			// 좋아요 눌렀는지 안눌렀는지
			$sql = "SELECT * FROM `sns_like` WHERE `board_idx`= ? AND `user_idx` = ?";
			$like = DB::fetch($sql,[$item->id, $_SESSION['user']->id]);

			array_push($list, ["imgs"=>$imgs, "comments"=>$comments, "user"=>$user,"host"=>$_SESSION['user']->id === $item->writer, "board"=>$item, "likeList"=> $likeList, "like"=>$like]);
		}
		echo json_encode(["list"=>$list,"success"=>true, "nowIndex"=>$start+$count],JSON_UNESCAPED_UNICODE);
	}

	public function likeProcess()
	{
		$idx = $_POST['idx'];
		$now = $_POST['now'];
		$sql = $now=="true" ? "DELETE FROM `sns_like` WHERE `user_idx` = ? AND `board_idx` = ?" : "INSERT INTO `sns_like`(`id`, `user_idx`, `board_idx`) VALUES (null,?,?)";
		$result = DB::query($sql,[$_SESSION['user']->id,$idx]);
		$sql = "SELECT count(*) as cnt FROM `sns_like` WHERE `board_idx` = ?";
		$cnt = DB::fetch($sql,[$idx])->cnt;
		echo json_encode(["cnt"=>$cnt],JSON_UNESCAPED_UNICODE);
	}
}

// 지식++;
