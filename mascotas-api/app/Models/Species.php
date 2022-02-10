<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Species
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Species newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Species newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Species query()
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Species whereName($value)
 * @mixin \Eloquent
 */
class Species extends Model
{
    use HasFactory;
}
