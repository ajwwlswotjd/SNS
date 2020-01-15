<?php

namespace Gondr\Controller;

use Gondr\DB;

class MainController extends MasterController {


	public function index()
	{
		$this->render("main");
	}

	public function login()
	{
		require __ROOT . "/views/login.php";
	}

	public function join()
	{
		require __ROOT . "/views/register.php";		
	}
}