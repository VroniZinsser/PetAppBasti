<?php

namespace App\Services;

use App\Dtos\UserDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService implements UserRepository {

    /**
     * @inheritDoc
     */
    public function getUsersByTypes(array $types): object
    {
        return User::whereHas('userTypes', function($query) use($types) {
            $query->whereIn('user_types.id', $types);
        })->with('userTypes')->get();
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreate(UserDTO $dto): User {
        $user = User::findOrNew($dto->get_id());
        $user->first_name = $dto->get_first_name();
        $user->last_name = $dto->get_last_name();
        $user->email = $dto->get_email();
        $user->email_verified_at = $dto->get_email_verified_at();
        $user->email_visible = $dto->get_email_visible();
        if ($dto->get_password()) {
            $user->password = Hash::make($dto->get_password());
        }
        $user->country = $dto->get_country();
        $user->state = $dto->get_state();
        $user->city = $dto->get_city();
        $user->postal_code = $dto->get_postal_code();
        $user->district = $dto->get_district();
        $user->street = $dto->get_street();
        $user->house_number = $dto->get_house_number();
        $user->apartment = $dto->get_apartment();
        $user->latitude = $dto->get_latitude();
        $user->longitude = $dto->get_longitude();
        $user->dni = $dto->get_dni();
        $user->public_name = $dto->get_public_name();
        $user->description = $dto->get_description();
        $user->whatsapp = $dto->get_whatsapp();
        $user->instagram = $dto->get_instagram();
        $user->facebook = $dto->get_facebook();
        $user->web = $dto->get_web();
        $user->verified = $dto->get_verified();
        $user->profile_img_id = $dto->get_profile_img_id();

        $user->save();

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function updatePassword(string $password, int $id): Bool
    {
        return User::find($id)->update(['password' => Hash::make($password)]);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): User | null
    {
        return User::with(['profile_image', 'userTypes'])->find($id);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        User::find($id)->delete();

        return true;
    }
}
