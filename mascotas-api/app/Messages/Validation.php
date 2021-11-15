<?php

namespace App\Messages;

class Validation {

    private static $messages = [
        'before_equal' => 'Por favor ingresá :field anterior o igual a :date',
        'email_unique' => 'Ya existe una cuenta con este correo electrónico',
        'max_caracters' => ':field no puede contener más de :max caracteres',
        'max_size' => ':field no puede pesar más de :max',
        'min_caracters' => ':field no puede contener menos de :min caracteres',
        'numeric' => ':field solo puede contener números',
        'password_requirements' => 'La contraseña debe contener un número',
        'required' => 'Por favor ingresá :field',
        'valid_value' => ':field que ingresaste no es :valid',    
    ];

    public static function msg_other($key) {
        return self::$messages[$key];
    }

    public static function msg_required($field) {
        return str_replace(':field', $field, self::$messages['required']);
    }

    public static function msg_max_caracters($field, $max) {
        $fieldCapitalize = ucfirst($field);
        return str_replace([':field', ':max'], [$fieldCapitalize, $max], self::$messages['max_caracters']);
    }

    public static function msg_min_caracters($field, $min) {
        $fieldCapitalize = ucfirst($field);
        return str_replace([':field', ':min'], [$fieldCapitalize, $min], self::$messages['min_caracters']);
    }

    public static function msg_numeric($field) {
        $fieldCapitalize = ucfirst($field);
        return str_replace(':field', $fieldCapitalize, self::$messages['numeric']);
    }

    public static function msg_valid_value($field, $fieldIsFeminine = false) {
        $fieldCapitalize = ucfirst($field);
        $valid = $fieldIsFeminine ? 'válida' : 'válido';
        return str_replace([':field', ':valid'], [$fieldCapitalize, $valid], self::$messages['valid_value']);
    }

    public static function msg_max_size($field, $max) {
        $fieldCapitalize = ucfirst($field);
        return str_replace([':field', ':max'], [$fieldCapitalize, $max], self::$messages['max_size']);
    }

    public static function msg_before_equal($field, $date) {
        return str_replace([':field', ':date'], [$field, $date], self::$messages['before_equal']);
    }
}