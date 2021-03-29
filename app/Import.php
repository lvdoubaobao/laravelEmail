<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Import
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Import newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Import newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Import query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $tag_id
 * @property int|null $admin_id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Import whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Import whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Import whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Import whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Import whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Import whereUpdatedAt($value)
 */
class Import extends Model
{
    use DateFormat;
    protected $table='import';
}
