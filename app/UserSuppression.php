<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserSuppression
 *
 * @property int $id
 * @property int|null $type
 * @property string|null $address
 * @property string|null $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
