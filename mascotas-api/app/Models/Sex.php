<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sex
 *
 * @property int $id
 * @property string $name
 * @method static Builder|Sex newModelQuery()
 * @method static Builder|Sex newQuery()
 * @method static Builder|Sex query()
 * @method static Builder|Sex whereId($value)
 * @method static Builder|Sex whereName($value)
 * @mixin Eloquent
 */
class Sex extends Model
{
    use HasFactory;
}
