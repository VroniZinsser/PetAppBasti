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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of breed
     */ 
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Get the value of date_of_birth
     */ 
    public function getDate_of_birth()
    {
        return $this->date_of_birth;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of neutered
     */ 
    public function getNeutered()
    {
        return $this->neutered;
    }

    /**
     * Get the value of temperament
     */ 
    public function getTemperament()
    {
        return $this->temperament;
    }

    /**
     * Get the value of images_id
     */ 
    public function getImages_id()
    {
        return $this->images_id;
    }

    /**
     * Get the value of sexes_id
     */ 
    public function getSexes_id()
    {
        return $this->sexes_id;
    }

    /**
     * Get the value of species_id
     */ 
    public function getSpecies_id()
    {
        return $this->species_id;
    }

    /**
     * Get the value of owner
     */ 
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of images_id
     *
     * @return  self
     */ 
    public function setImages_id($images_id)
    {
        $this->images_id = $images_id;

        return $this;
    }

    /**
     * Get the value of observation
     */ 
    public function getObservation()
    {
        return $this->observation;
    }
}