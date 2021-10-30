<?php
namespace App\Dtos;

use ReflectionClass;

class BaseDTO {
    public function loadFromArray(array $data) {
        $reflection = new ReflectionClass(static::class);

        foreach($reflection->getProperties() as $prop) {
            if(isset($data[$prop])) {
                $this->{$prop} = $data[$prop];
            }
        }
    }
}