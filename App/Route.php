<?php

namespace Gondr;

class Route
{
	public static $GET = [];
	public static $POST = [];

	public static function route($url)
	{
		foreach(self::${$_SERVER['REQUEST_METHOD']} as $req)
		{
			if($req[0] == $url)
			{	
				$actions = explode("@",$req[1]);
				$cName = "\\Gondr\\Controller\\" . $actions[0];
				$cInstance = new $cName();
				$cInstance->{$actions[1]}();
				return;
			}
		}

		echo "존재하지 않는 페이지 이거나 권한이 없습니다.";
		exit;
	}

	public static function post($link,$action)
	{
		self::$POST[] = [$link,$action];
	}

	public static function get($link,$action)
	{
		self::$GET[] = [$link,$action];
	}
}