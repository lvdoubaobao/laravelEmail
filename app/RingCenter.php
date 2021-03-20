<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RingCenter
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $update_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter whereUpdateAt($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $real_name
 * @property int|null $is_display
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter whereIsDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter whereUpdatedAt($value)
 * @property string|null $ext
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RingCenter whereExt($value)
 */
class RingCenter extends Model
{
    protected  $table='ringcenter';

}
