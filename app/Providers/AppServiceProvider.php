<?php

namespace App\Providers;

use App\Reoisitory\MailGunRespository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('mailgun',function ($app){
            return new MailGunRespository();
        });
    }
}
