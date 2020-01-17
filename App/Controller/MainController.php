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
		echo "<script>";
		echo "location.href='/login'";
		echo "</script>";
	}

	public function join()
	{
		require __ROOT . "/views/register.php";		
	}

	public function loginPage()
	{
		require __ROOT . "/views/login.php";		
	}
}