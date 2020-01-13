<?php

session_start();
define("__ROOT",dirname(__DIR__));
define("__SIGN",isset($_SESSION['user']));

use Gondr\Route;

require (__ROOT . "/autoload.php");
require (__ROOT . "/web.php");

$url = isset($_GET['url']) ? $_GET['url'] : "/";

Route::route($url);