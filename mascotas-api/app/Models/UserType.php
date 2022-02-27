<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\UserType
 *
 * @property int $id
 * @property string $name
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static Builder|UserType newModelQuery()
 * @method static Builder|UserType newQuery()
 * @method static Builder|UserType query()
 * @method static Builder|UserType whereId($value)
 * @method static Builder|UserType whereName($value)
 * @mixin Eloquent
 */
class UserType extends Model
{
    use HasFactory;

    /**
     * The users that belong to the usertype.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_has_user_types');
    }
}
