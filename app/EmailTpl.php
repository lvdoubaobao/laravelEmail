<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\EmailTpl
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailTpl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailTpl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailTpl query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailTpl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailTpl whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailTpl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailTpl whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailTpl whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EmailTpl extends Model
{
    protected  $table='email_tpl';
}
