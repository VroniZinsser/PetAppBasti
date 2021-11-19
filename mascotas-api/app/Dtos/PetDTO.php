<?php
namespace App\Dtos;

class PetDTO extends BaseDTO { 
    protected $id;
    protected $breed;
    protected $date_of_birth;
    protected $name;
    protected $neutered;
    protected $temperament;
    protected $observation;
    protected $images_id;
    protected $sexes_id;
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
     * Get the value of images_id
     */ 
    public function get_images_id()
    {
        return $this->images_id;
    }

    /**
     * Get the value of sexes_id
     */ 
    public function get_sexes_id()
    {
        return $this->sexes_id;
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
     * Set the value of images_id
     *
     * @return  self
     */ 
    public function set_images_id($images_id)
    {
        $this->images_id = $images_id;

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