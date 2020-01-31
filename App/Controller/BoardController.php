<?php

namespace Gondr\Controller;

use Gondr\DB;

class BoardController extends MasterController {

	public function uploadProcess()
	{
		$upfile = $_FILES["file"];
		$src = "/upload/".$upfile['name'];
		// $fileName = 
		move_uploaded_file($upfile["tmp_name"],".".$src);
		echo json_encode(['success'=>true, 'src'=>$src],JSON_UNESCAPED_UNICODE);
	}

}