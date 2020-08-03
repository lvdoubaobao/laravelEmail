<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSuppression extends Model
{
    protected  $table='user_suppression';
    const bounces=0;
    const unsubscribes=1;
    const complaints=2;
    public  static $typeMap=[
        self::bounces=>'弹跳',
       self::unsubscribes=>'取消订阅',
       self::complaints=>'投诉',
    ];
}
