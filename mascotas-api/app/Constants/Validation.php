<?php

namespace App\Constants;

class Validation {

    private static $messages = [
        'required' => 'Por favor ingresá :field',
        'max_caracters' => ':field no puede contener más de :max caracteres',
        'min_caracters' => ':field no puede contener menos de :min caracteres',
        'valid_value' => ':field que ingesaste no es :valid',
        'max_size' => ':field no puede pesar más de :max',
        'before_equal' => 'Por favor ingresá :field anterior o igual a :date',
    ];

    public static function get($message, $field, ?string $value='') {
        return str_replace([':field', ':value'], [$field, $value], self::$messages[$message]);
 
    }

    public static function msg_required($field) {
        return str_replace(':field', $field, self::$messages['required']);
    }

    public static function msg_max_caracters($field, $max) {
        $fieldCapitalize = ucfirst($field);
        return str_replace([':field', ':max'], [$fieldCapitalize, $max], self::$messages['max_caracters']);
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