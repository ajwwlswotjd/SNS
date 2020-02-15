<?php

namespace Gondr\Controller;

use Gondr\DB;

class UserController extends MasterController {

	public function showUser()
	{
		var_dump($_GET);
	}

	public function userProfile()
	{
		$sql = "SELECT * FROM `sns_user` WHERE `id` = ?";
		$user = DB::fetch($sql,[$_GET['id']]);
		$sql = "SELECT COUNT(*) as cnt FROM `sns_friend` WHERE `status` = 1 AND `send_idx` = ? OR `rec_idx` = ?;";
		$friendCnt = DB::fetch($sql,[$user->id,$user->id])->cnt;
		$sql = "SELECT COUNT(*) as cnt FROM `sns_board` WHERE `writer` = ?";
		$boardCnt = DB::fetch($sql,[$user->id])->cnt;
		$this->render("profile",[$user,$friendCnt,$boardCnt]);
	}

	public function changeName()
	{
		$name = $_POST['name'];
		$sql = "UPDATE FROM `sns_user` `name` = ? WHERE `id` = ?";
		DB::query($sql,[$_SESSION['user']->id,$name]);
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