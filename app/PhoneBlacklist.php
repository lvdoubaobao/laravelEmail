<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PhoneBlacklist
 *
 * @property int $id
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneBlacklist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneBlacklist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneBlacklist query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneBlacklist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneBlacklist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneBlacklist wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PhoneBlacklist whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PhoneBlacklist extends Model
{
    protected $table="phone_blacklist";
}
