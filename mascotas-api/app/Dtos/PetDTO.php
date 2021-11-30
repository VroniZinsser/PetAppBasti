<?php

namespace App\Dtos;

class PetDTO extends BaseDTO
{
    protected $id;
    protected $breed;
    protected $date_of_birth;
    protected $name;
    protected $neutered;
    protected $temperament;
    protected $observation;
    protected $image_id;
    protected $sex_id;
    protected $species_id;
    protected $owner;

    /**
     * Get the value of id
     */
    public function get_id()
    {
        return $this->id;
    }

    /**
     * Sets the id of the pet
     */
    public function set_id($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of breed
     */
    public function get_breed()
    {
        return $this->breed;
    }

    /**
     * Get the value of date_of_birth
     */
    public function get_date_of_birth()
    {
        return $this->date_of_birth;
    }

    /**
     * Get the value of name
     */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * Get the value of neutered
     */
    public function get_neutered()
    {
        return $this->neutered;
    }

    /**
     * Get the value of temperament
     */
    public function get_temperament()
    {
        return $this->temperament;
    }

    /**
     * Get the value of image_id
     */
    public function get_image_id()
    {
        return $this->image_id;
    }

    /**
     * Get the value of sex_id
     */
    public function get_sex_id()
    {
        return $this->sex_id;
    }

    /**
     * Get the value of species_id
     */
    public function get_species_id()
    {
        return $this->species_id;
    }

    /**
     * Get the value of owner
     */
    public function get_owner()
    {
        return $this->owner;
    }

    /**
     * Set the value of image_id
     *
     * @param $image_id
     * @return  self
     */
    public function set_image_id($image_id): PetDTO
    {
        $this->image_id = $image_id;

        return $this;
    }

    /**
     * Get the value of observation
     */
    public function get_observation()
    {
        return $this->observation;
    }
}
