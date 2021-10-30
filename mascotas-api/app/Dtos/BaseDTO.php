<?php
namespace App\Dtos;

use ReflectionClass;

class BaseDTO {
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