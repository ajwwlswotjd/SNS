<?php

namespace Gondr\Controller;

use Gondr\DB;

class MainController extends MasterController {

	public function logout()
	{
		unset($_SESSION['user']);
		echo "<script>";
		echo "location.href='/login'";
		echo "</script>";
	}


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

	public function form()
	{
		$this->render("form");
	}

	public function join()
	{
		require __ROOT . "/views/register.php";		
	}

	public function loginPage()
	{
		require __ROOT . "/views/login.php";		
	}

	public function test()
	{
		require __ROOT . "/views/test.php";
	}

	public function testPost()
	{
		echo htmlentities($_POST['textTest']);
	}
}