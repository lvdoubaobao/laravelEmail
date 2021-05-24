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
$mail=new \App\Reoisitory\MailGunRespository();
$mail->to('736400469@qq.com');

$mail->send('aa','aa');
//return redirect()->to('/admin');
});
