<?php

namespace App\Repositories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Collection;

interface PetRepository
{
    /**
     * Creates or Updates and returns the pet
     *
     * @param int|null $id
     * @param string|null $breed
     * @param string|null $date_of_birth
     * @param string $name
     * @param bool|null $neutered
     * @param string|null $temperament
     * @param int|null $images_id
     * @param int $sexes_id
     * @param int $species_id
     * @param int $owner
     * @return Pet The created or updated
     */
    public function updateOrCreate
    (
        ?int $id,
        ?string $breed,
        ?string $date_of_birth,
        string $name,
        ?bool $neutered,
        ?string $temperament,
        ?int $images_id,
        int $sexes_id,
        int $species_id,
        int $owner
    ): Pet;

    /**
     * @param int $owner_id
     * @return Collection | []Pet
     */
    public function getOwnerPets(int $owner_id): Collection;
}
