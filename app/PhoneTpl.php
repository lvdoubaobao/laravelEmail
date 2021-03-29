<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PhoneTpl
 *
 * @property int $id
 * @property string|null $tpl
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl whereTpl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property array|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl whereImage($value)
 * @property int|null $admin_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneTpl whereAdminId($value)
 */
class PhoneTpl extends Model
{
    use DateFormat;
    protected $table='phone_tpl';
    protected  $casts =[
        'image'=>'array'
    ];
}
