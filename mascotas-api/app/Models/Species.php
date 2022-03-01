<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Species
 *
 * @property int $id
 * @property string $name
 * @method static Builder|Species newModelQuery()
 * @method static Builder|Species newQuery()
 * @method static Builder|Species query()
 * @method static Builder|Species whereId($value)
 * @method static Builder|Species whereName($value)
 * @mixin Eloquent
 */
class Species extends Model
{
    use HasFactory;
}
