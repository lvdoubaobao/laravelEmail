<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ringcenter
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $update_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter whereUpdateAt($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $real_name
 * @property int|null $is_display
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter whereIsDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter whereUpdatedAt($value)
 * @property string|null $ext
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Ringcenter whereExt($value)
 */
class Ringcenter extends Model
{
    protected  $table='ringcenter';

}
