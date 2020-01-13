<?php

use Gondr\Route;

Route::get("/","MainController@index");
Route::get("shooting","MainController@shooting");
Route::get("test","MainController@test");

Route::post("user_login","UserController@login");
Route::post("user_register", "UserController@registerProcess");
Route::post("user_logout","UserController@logout");

if(isset($_SESSION['user'])){
	Route::get("shooting/game","MainController@inGame");
}