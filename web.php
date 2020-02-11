<?php

use Gondr\Route;

Route::get("/",__SIGN ? "MainController@index" : "MainController@login");
Route::get("join","MainController@join");
Route::get("login","MainController@loginPage");
Route::get("form",__SIGN ? "MainController@form" : "MainController@login");

Route::post("user/join","UserController@registerProcess");
Route::post("user/login","UserController@loginProcess");
Route::post("user/find","UserController@userFind");

Route::post("board/write","BoardController@formProcess");
Route::post("board/upload/text","BoardController@uploadProcess");
Route::post("board/upload/img","BoardController@uploadFile");
Route::post("board/load","BoardController@loadProcess");
Route::post("board/cnt","BoardController@loadCnt");
Route::post("board/comment","BoardController@commentProcess");
Route::post("board/comment/load","BoardController@commentLoad");
Route::post("board/like","BoardController@likeProcess");


Route::get("test","MainController@test");
Route::post("test/post","MainController@testPost");
