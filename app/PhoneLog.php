<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PhoneLog
 *
 * @property int $id
 * @property int|null $status
 * @property string|null $phone
 * @property string|null $message
 * @property string|null $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $admin_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog whereAdminId($value)
 * @property int|null $tpl_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneLog whereTplId($value)
 */
class PhoneLog extends Model
{
    use DateFormat;
    protected  $table='phone_log';
}
