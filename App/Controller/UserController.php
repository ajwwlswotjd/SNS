<?php

namespace Gondr\Controller;

use Gondr\DB;

class UserController extends MasterController {


	public function registerProcess()
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$today = date("Y:m:d:H:i:s");
		$sql = "INSERT INTO `sns_user`(`id`, `name`, `email`, `password`, `date`) VALUES (null,?,?,PASSWORD(?),?)";
		$result = DB::query($sql,[$name,$email,$pwd,$today]);
		echo json_encode(['success' => $result],JSON_UNESCAPED_UNICODE);
	}

}