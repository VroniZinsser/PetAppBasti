<?php

namespace App\Constants;

class Validation {
    const REQUIRED  = 'required';
    const MAX_CARACTERS = 'max_caracters';
    const MAX_SIZE = 'max_size';
    const VALID_VALUE = 'valid_value';
    const BEFORE_EQUAL = 'before_equal';

    private static $messages = [
        self::REQUIRED => 'Por favor ingresá :field',
        self::MAX_CARACTERS => ':field no puede contener más de :value caracteres',
        self::VALID_VALUE => 'Por favor ingresá un valor válido para :field',
        self::MAX_SIZE => ':field no puede pesar más de :value',
        self::BEFORE_EQUAL => 'Por favor ingresá :field anterior o igual a :value',
    ];

    public static function get($message, $field, ?string $value='') {
        return str_replace([':field', ':value'], [$field, $value], self::$messages[$message]);
 
    }
}