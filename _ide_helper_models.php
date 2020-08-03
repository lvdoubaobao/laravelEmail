<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
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
 */
	class EmailCorn extends \Eloquent {}
}

namespace App{
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
 */
	class EmailTpl extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $phone
 * @property string|null $country
 * @property string|null $province
 * @property string|null $since
 * @property string|null $city
 * @property int|null $tag_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\UserSuppression
 *
 * @property int $id
 * @property int|null $type
 * @property string|null $address
 * @property string|null $reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSuppression whereUpdatedAt($value)
 */
	class UserSuppression extends \Eloquent {}
}

namespace App{
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
 */
	class UserTag extends \Eloquent {}
}

