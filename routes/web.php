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
  $aa= \Illuminate\Support\Facades\Mail::to('73640046@email.mslynnhair.com')->send(new \App\Mail\OrderShipped(\App\EmailTpl::find(2),\App\EmailCorn::first()));
   dd($aa);

//  $aa=  new \App\Reoisitory\RingcentralReoisitory();
 // dd($aa->sendSms());
});
