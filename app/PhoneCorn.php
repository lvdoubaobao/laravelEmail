<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PhoneCorn
 *
 * @property int $id
 * @property int|null $phone_tpl_id
 * @property string|null $send_time
 * @property int|null $is_send
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $tag_id
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereIsSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn wherePhoneTplId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereSendTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RingCenter[] $ringcenter
 * @property-read int|null $ringcenter_count
 * @property int|null $admin_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereAdminId($value)
 * @property int|null $number
 * @property int|null $is_stop
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereIsStop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereNumber($value)
 * @property int|null $last_user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneCorn whereLastUserId($value)
 */
class PhoneCorn extends Model
{
    use DateFormat;
    protected $table='phone_corn';
    public function ringcenter(){
        return $this->belongsToMany(RingCenter::class,'phone_ringcenter','corn_id','ringcenter_id');
    }
}
