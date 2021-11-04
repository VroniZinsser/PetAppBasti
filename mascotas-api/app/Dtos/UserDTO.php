<?php
namespace App\Dtos;

class UserDTO extends BaseDTO {
    protected $id;  
    protected $first_name; 
    protected $last_name; 
    protected $email; 
    protected $email_verified_at; 
    protected $email_visible;
    protected $password; 
    protected $country;
    protected $state;
    protected $city;
    protected $postal_code;
    protected $district;
    protected $street;
    protected $house_number;
    protected $apartment;
    protected $latitude;
    protected $longitude;
    protected $dni; 
    protected $public_name;
    protected $description;
    protected $whatsapp;
    protected $instagram;
    protected $facebook;
    protected $web; 
    protected $verified; 
    protected $profile_img_id;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of profile_img_id
     */ 
    public function getProfile_img_id()
    {
        return $this->profile_img_id;
    }

    /**
     * Get the value of verified
     */ 
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Get the value of web
     */ 
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Get the value of facebook
     */ 
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Get the value of instagram
     */ 
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Get the value of whatsapp
     */ 
    public function getWhatsapp()
    {
        return $this->whatsapp;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of public_name
     */ 
    public function getPublic_name()
    {
        return $this->public_name;
    }

    /**
     * Get the value of dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Get the value of longitude
     */ 
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Get the value of latitude
     */ 
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Get the value of apartment
     */ 
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * Get the value of house_number
     */ 
    public function getHouse_number()
    {
        return $this->house_number;
    }

    /**
     * Get the value of street
     */ 
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Get the value of district
     */ 
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Get the value of postal_code
     */ 
    public function getPostal_code()
    {
        return $this->postal_code;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of email_visible
     */ 
    public function getEmail_visible()
    {
        return $this->email_visible;
    }

    /**
     * Get the value of email_verified_at
     */ 
    public function getEmail_verified_at()
    {
        return $this->email_verified_at;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Get the value of first_name
     */ 
    public function getFirst_name()
    {
        return $this->first_name;
    }


    /**
     * Set the value of profile_img_id
     *
     * @return  self
     */ 
    public function setProfile_img_id($profile_img_id)
    {
        $this->profile_img_id = $profile_img_id;

        return $this;
    }
}