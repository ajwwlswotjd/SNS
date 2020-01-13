<?php

function myLoader($name){
	$baseDir = "App";
	$namespace = "Gondr";

	if(strncmp($namespace,$name,strlen($namespace)) == 0)
	{
		$realName = substr($name, strlen($namespace));
		require $baseDir.str_replace("\\","/",$realName) . ".php";
	}
}

spl_autoload_register("myLoader");

?>