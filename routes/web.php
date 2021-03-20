<?php

use App\Jobs\EmailJob;
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

 //$mailgun= new \App\Reoisitory\MailGunRespository();
    $aa=\Illuminate\Support\Facades\Mail::to('736400469@qq.com')->send(new \App\Mail\OrderShipped(\App\EmailTpl::first(),\App\EmailCorn::first(),\App\User::first()));
 dd($aa);
    //dd($mailgun->send('haha','112'));
});
