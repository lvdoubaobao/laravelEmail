<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserCtroller::class);
    $router->resource('user-tags', UserTagController::class);
    $router->resource('email-tpls', EmailTplController::class);
    $router->resource('email-corns', EmailCornController::class);
    $router->resource('user-suppressions', UserSuppressionController::class);
    $router->resource('phone-tpls', PhoneTplController::class);
    $router->resource('phone-corns', PhoneCornController::class);
    $router->resource('phone-logs', PhoneLogController::class);
    $router->resource('ringcentral', RingcentralController::class);
    $router->resource('imports', ImportController::class);
    $router->resource('phone-blacklists', blackListController::class);

});
