<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PhoneHuihua
 *
 * @property int $id
 * @property array|null $to
 * @property array|null $from
 * @property string|null $type
 * @property string|null $creationTime
 * @property string|null $readStatus
 * @property string|null $priority
 * @property array|null $attachments
 * @property string|null $direction
 * @property string|null $availability
 * @property string|null $subject
 * @property int|null $conversationId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereCreationTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereReadStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneHuihua whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $conversation_id
 */
class PhoneHuihua extends Model
{
    protected $table="phone_huihua";
    protected $casts=[
        'to'=>'array',
        'from'=>'array',
        'attachments'=>'array',
    ];
}
