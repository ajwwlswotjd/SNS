<?php

use Gondr\Route;

Route::get("/",__SIGN ? "MainController@index" : "MainController@index");
Route::get("join","MainController@join");
Route::get("login","MainController@loginPage");

Route::post("user/join","UserController@registerProcess");