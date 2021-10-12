<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    /**
     * The users that belong to the usertype.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_has_user_types');
    }
}
