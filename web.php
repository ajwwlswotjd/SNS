<?php

use Gondr\Route;

use Gondr\DB;
if(__SIGN){
	$sql = "UPDATE `sns_user` SET `ip`=? WHERE `id` = ?";
	$ip = $_SERVER['REMOTE_ADDR'];
	$id = $_SESSION['user']->id;
	DB::query($sql,[$ip,$id]);
}

Route::get("/",__SIGN ? "MainController@index" : "MainController@login");
Route::get("join","MainController@join");
Route::get("login","MainController@loginPage");
Route::get("form",__SIGN ? "MainController@form" : "MainController@login");
Route::get("logout","MainController@logout");

Route::get("user/profile/",__SIGN ? "UserController@userProfile" : "MainController@login");
Route::post("user/find","UserController@userFind");
Route::post("user/join","UserController@registerProcess");
Route::post("user/login","UserController@loginProcess");

Route::post("board/write","BoardController@formProcess");
Route::post("board/upload/text","BoardController@uploadProcess");
Route::post("board/upload/img","BoardController@uploadFile");
Route::post("board/load","BoardController@loadProcess");
Route::post("board/load/img","BoardController@loadImage");
Route::post("board/cnt","BoardController@loadCnt");
Route::post("board/comment","BoardController@commentProcess");
Route::post("board/comment/load","BoardController@commentLoad");
Route::post("board/like","BoardController@likeProcess");
Route::post("board/delete","BoardController@deleteProcess");


Route::get("test","MainController@test");
Route::post("test/post","MainController@testPost");
