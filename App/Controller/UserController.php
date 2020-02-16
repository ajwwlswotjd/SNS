<?php

namespace Gondr\Controller;

use Gondr\DB;

class UserController extends MasterController {

	public function showUser()
	{
		var_dump($_GET);
	}

	public function friendProcess()
	{
		$mod = $_POST['status'];
		$get = $_POST['get'];
		$uid = $_SESSION['user']->id;
		$today = date("Y:m:d:H:i:s");
		if($mod==0) // 친구추가를 보내면 됌
		{
			$sql = "INSERT INTO `sns_friend`(`id`, `send_idx`, `rec_idx`, `date`, `status`) VALUES (null,?,?,?,0)";
			DB::query($sql,[$uid,$get,$today]);
		}
		if($mod==1) // 친구수락을 하면 됌
		{
			$sql = "UPDATE `sns_friend` SET `date`= ?, `status`= 1 WHERE ((`send_idx`= ? AND `rec_idx` = ?) OR (`send_idx` = ? AND `rec_idx` = ?)) AND `status` = 0";
			DB::query($sql,[$today,$get,$uid,$uid,$get]);
		}
		if($mod==2) // 친구 요청을 취소하면 됌
		{
			$sql = "DELETE FROM `sns_friend` WHERE ((`send_idx` = ? AND `rec_idx` = ?) OR (`send_idx` = ? AND `rec_idx` = ?)) AND `status` = 0";
			DB::query($sql,[$get,$uid,$uid,$get]);
		}
		if($mod==3) // 친구를 삭제하면 댐
		{
			$sql = "DELETE FROM `sns_friend` WHERE ((`send_idx` = ? AND `rec_idx` = ?) OR (`send_idx` = ? AND `rec_idx` = ?)) AND `status` = 1";
			DB::query($sql,[$get,$uid,$uid,$get]);
		}
	}

	public function userProfile()
	{
		$sql = "SELECT * FROM `sns_user` WHERE `id` = ?";
		$user = DB::fetch($sql,[$_GET['id']]);
		$sql = "SELECT COUNT(*) as cnt FROM `sns_friend` WHERE (`send_idx` = ? AND `status` = 1) OR (`rec_idx` = ? AND `status` = 1)";
		$friendCnt = DB::fetch($sql,[$user->id,$user->id])->cnt;
		$sql = "SELECT COUNT(*) as cnt FROM `sns_board` WHERE `writer` = ?";
		$boardCnt = DB::fetch($sql,[$user->id])->cnt;
		$sql = "SELECT * FROM `sns_friend` WHERE `send_idx` = ? AND `rec_idx` = ? AND `status` = 0";
		$status = 0;
		$str = "친구 추가";
		$result = DB::fetch($sql,[$_GET['id'],$_SESSION['user']->id]);
		if($result) // 보낸사람이 도메인 주인, 받는사람이 사용자라면 
		{
			$status = 1;
			$str = "친구 수락";
		}
		$result = DB::fetch($sql,[$_SESSION['user']->id,$_GET['id']]);
		if($result) // 보낸사람이 사용자, 받는사람이 도메인 주인
		{
			$status = 2;
			$str = "요청 취소";
		}
		$sql = "SELECT * FROM `sns_friend` WHERE ((`send_idx` = ? AND `rec_idx` = ?) OR (`send_idx` = ? AND `rec_idx` = ?)) AND `status` = 1";
		$get = $_GET['id'];
		$uid = $_SESSION['user']->id;
		$result = DB::fetch($sql,[$get,$uid,$uid,$get]);
		if($result)
		{
			$status = 3;
			$str = "친구 삭제";
		}
		$this->render("profile",[$user,$friendCnt,$boardCnt,$status,$str]);
	}

	public function imgChange()
	{
		$upfile = $_FILES['file'];
		$src = "/upload/".$_POST['name'];
		move_uploaded_file($upfile['tmp_name'],".".$src);
		$sql = "UPDATE `sns_user` SET `profile`= ? WHERE `id` = ?";
		$result = DB::query($sql,[$src,$_SESSION['user']->id]);
		echo json_encode(["result"=>$result],JSON_UNESCAPED_UNICODE);
	}

	public function nickChange()
	{
		$nick = $_POST['nick'];
		$sql = "UPDATE `sns_user` SET `nick`=? WHERE `id` = ?";
		$result = DB::query($sql,[$nick,$_SESSION['user']->id]);
		echo json_encode(["result"=>$result],JSON_UNESCAPED_UNICODE);
	}

	public function infoChange()
	{
		$info = $_POST['info'];
		$sql = "UPDATE `sns_user` SET `info`= ? WHERE `id` = ?";
		$result = DB::query($sql,[$info,$_SESSION['user']->id]);
		echo json_encode(["result"=>$result],JSON_UNESCAPED_UNICODE);
	}

	public function registerProcess()
	{
		$name = htmlentities($_POST['name']);
		$email = htmlentities($_POST['email']);
		$pwd = $_POST['pwd'];
		$today = date("Y:m:d:H:i:s");
		$sql = "INSERT INTO `sns_user`(`id`, `name`, `email`, `password`, `date`, `nick`, `profile`,`ip`) VALUES (null,?,?,PASSWORD(?),?,'',?,?)";
		$profile = "/imgs/user.png";
		$ip = $_SERVER['REMOTE_ADDR'];
		$result = DB::query($sql,[$name,$email,$pwd,$today,$profile,$ip]);
		echo json_encode(['success' => $result],JSON_UNESCAPED_UNICODE);
	}

	public function loginProcess()
	{
		$email = htmlentities($_POST['email']);
		$pwd = $_POST['pwd'];
		$sql = "SELECT * FROM `sns_user` WHERE `email` = ? AND `password` = PASSWORD(?)";
		$user = DB::fetch($sql,[$email,$pwd]);
		if($user)
		{
			echo json_encode(['success' => true, 'name' => $user->name],JSON_UNESCAPED_UNICODE);
			$_SESSION['user'] = $user;
		}
		else
		{
			echo json_encode(['success' => false],JSON_UNESCAPED_UNICODE);
		}
	}

	public function userFind()
	{
		$id = $_POST['userId'];
		$sql = "SELECT * FROM `sns_user` WHERE `id` = ?";
		$user = DB::fetch($sql,[$id]);
		echo json_encode(["user"=>$user],JSON_UNESCAPED_UNICODE);
	}

}