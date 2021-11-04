<?php
namespace App\Dtos;

use ReflectionClass;

class BaseDTO {
    /**
     * Assigns all values from an array to the corresponding properties of the dto
     * 
     * @param array $data the values to be assigned
     */
    public function loadFromArray(array $data) {
        $reflection = new ReflectionClass(static::class);

        foreach($reflection->getProperties() as $prop) {
            $property = $prop->getName();
            if(isset($data[$property])) {
                $this->{$property} = $data[$property];
            }
        }
    }
}