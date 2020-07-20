<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   $aa= \Illuminate\Support\Facades\Mail::to('q736400469@gmail.com')->send(new \App\Mail\OrderShipped(\App\EmailTpl::find(1),'736400469@mslynnhair.com','呵呵呵111'));
   dd($aa);
});
