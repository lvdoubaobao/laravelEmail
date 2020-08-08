<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserTag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserTag extends Model
{
    protected  $table='user_tag';
    //

}
