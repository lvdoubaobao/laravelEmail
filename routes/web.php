<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
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

 $mgClient=   \Mailgun\Mailgun::create('key-9989fc3ec241ca3ff413aa997d83f80e');
  $result=   $mgClient->suppressions()->bounces()->index('email.mslynnhair.com');
  dump($result);
   $result2= $mgClient->suppressions()->bounces()->nextPage($result);
   dd($result2);
//  $aa=  new \App\Reoisitory\RingcentralReoisitory();
 // dd($aa->sendSms());
});
