<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sex
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Sex newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sex newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sex query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sex whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sex whereName($value)
 * @mixin \Eloquent
 */
class Sex extends Model
{
    use HasFactory;
}
