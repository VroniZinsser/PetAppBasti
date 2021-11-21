<?php

namespace App\Dtos;

class UserDTO extends BaseDTO
{
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
    public function get_id()
    {
        return $this->id;
    }

    /**
     * Get the value of profile_img_id
     */
    public function get_profile_img_id()
    {
        return $this->profile_img_id;
    }

    /**
     * Get the value of verified
     */
    public function get_verified()
    {
        return $this->verified;
    }

    /**
     * Get the value of web
     */
    public function get_web()
    {
        return $this->web;
    }

    /**
     * Get the value of facebook
     */
    public function get_facebook()
    {
        return $this->facebook;
    }

    /**
     * Get the value of instagram
     */
    public function get_instagram()
    {
        return $this->instagram;
    }

    /**
     * Get the value of whatsapp
     */
    public function get_whatsapp()
    {
        return $this->whatsapp;
    }

    /**
     * Get the value of description
     */
    public function get_description()
    {
        return $this->description;
    }

    /**
     * Get the value of public_name
     */
    public function get_public_name()
    {
        return $this->public_name;
    }

    /**
     * Get the value of dni
     */
    public function get_dni()
    {
        return $this->dni;
    }

    /**
     * Get the value of longitude
     */
    public function get_longitude()
    {
        return $this->longitude;
    }

    /**
     * Get the value of latitude
     */
    public function get_latitude()
    {
        return $this->latitude;
    }

    /**
     * Get the value of apartment
     */
    public function get_apartment()
    {
        return $this->apartment;
    }

    /**
     * Get the value of house_number
     */
    public function get_house_number()
    {
        return $this->house_number;
    }

    /**
     * Get the value of street
     */
    public function get_street()
    {
        return $this->street;
    }

    /**
     * Get the value of district
     */
    public function get_district()
    {
        return $this->district;
    }

    /**
     * Get the value of postal_code
     */
    public function get_postal_code()
    {
        return $this->postal_code;
    }

    /**
     * Get the value of city
     */
    public function get_city()
    {
        return $this->city;
    }

    /**
     * Get the value of state
     */
    public function get_state()
    {
        return $this->state;
    }

    /**
     * Get the value of country
     */
    public function get_country()
    {
        return $this->country;
    }

    /**
     * Get the value of password
     */
    public function get_password()
    {
        return $this->password;
    }

    /**
     * Get the value of email_visible
     */
    public function get_email_visible()
    {
        return $this->email_visible;
    }

    /**
     * Get the value of email_verified_at
     */
    public function get_email_verified_at()
    {
        return $this->email_verified_at;
    }

    /**
     * Get the value of email
     */
    public function get_email()
    {
        return $this->email;
    }

    /**
     * Get the value of last_name
     */
    public function get_last_name()
    {
        return $this->last_name;
    }

    /**
     * Get the value of first_name
     */
    public function get_first_name()
    {
        return $this->first_name;
    }


    /**
     * Set the value of profile_img_id
     *
     * @param $profile_img_id
     * @return  self
     */
    public function set_profile_img_id($profile_img_id): UserDTO
    {
        $this->profile_img_id = $profile_img_id;

        return $this;
    }
}
