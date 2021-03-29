<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\EmailCorn
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $tpl_id
 * @property int|null $tag_id
 * @property string|null $time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $is_send
 * @property string|null $address 发送者邮箱地址
 * @property string|null $address_name 发送者名称
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereAddressName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereIsSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereTplId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EmailCorn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EmailCorn extends Model
{

    protected  $table='email_corn';

}
