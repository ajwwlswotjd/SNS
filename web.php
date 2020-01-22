<?php

use Gondr\Route;

Route::get("/",__SIGN ? "MainController@index" : "MainController@login");
Route::get("join","MainController@join");
Route::get("login","MainController@loginPage");
Route::get("form","MainController@form");

Route::post("user/join","UserController@registerProcess");
Route::post("user/login","UserController@loginProcess");
Route::post("board/write","BoardController@formProcess");


Route::get("test","MainController@test");
Route::post("test/post","MainController@testPost");