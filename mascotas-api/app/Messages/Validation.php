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
        'error' => 'El valor que ingresaste no es válido.'
    ];

    /**
     * Message if required input is missing
     *
     * @param string $field field name that appears in the message, lowercase (e.g. 'el apellido')
     * @return string|string[] message
     */
    public static function msg_required($field) {
        return str_replace(':field', $field, self::$messages['required']);
    }

    /**
     * Message if input has more characters than permitted
     *
     * @param string $field field name that appears in the message, lowercase (e.g. 'el apellido')
     * @param string $max max number of characters
     * @return string|string[] message
     */
    public static function msg_max_caracters(string $field, string $max) {
        $fieldCapitalize = ucfirst($field);
        return str_replace([':field', ':max'], [$fieldCapitalize, $max], self::$messages['max_caracters']);
    }

    /**
     * Message if input has less characters than permitted
     *
     * @param string $field field name that appears in the message, lowercase (e.g. 'el apellido')
     * @param string $min min number of characters
     * @return string|string[] message
     */
    public static function msg_min_caracters(string $field, string $min) {
        $fieldCapitalize = ucfirst($field);
        return str_replace([':field', ':min'], [$fieldCapitalize, $min], self::$messages['min_caracters']);
    }

    /**
     * Message if input should only contain numbers
     *
     * @param string $field field name that appears in the message, lowercase (e.g. 'el apellido')
     * @return string|string[] message
     */
    public static function msg_numeric(string $field) {
        $fieldCapitalize = ucfirst($field);
        return str_replace(':field', $fieldCapitalize, self::$messages['numeric']);
    }

    /**
     * Message if input value is not valid
     *
     * @param string $field field name that appears in the message, lowercase (e.g. 'la fecha')
     * @param bool $fieldIsFeminine set true if field name is female to enable correct gender
     * @return string|string[] message
     */
    public static function msg_valid_value(string $field, $fieldIsFeminine = false) {
        $fieldCapitalize = ucfirst($field);
        $valid = $fieldIsFeminine ? 'válida' : 'válido';
        return str_replace([':field', ':valid'], [$fieldCapitalize, $valid], self::$messages['valid_value']);
    }

    /**
     * Message if file input is larger than permitted
     *
     * @param string $field field name that appears in the message, lowercase (e.g. 'el archivo')
     * @param string $max max file size in kb
     * @return string|string[] message
     */
    public static function msg_max_size(string $field, string $max) {
        $fieldCapitalize = ucfirst($field);
        return str_replace([':field', ':max'], [$fieldCapitalize, $max], self::$messages['max_size']);
    }

    /**
     * Message if input should be before or equal a given date
     *
     * @param string $field field name that appears in the message, lowercase (e.g. 'el archivo')
     * @param string $date date or word to explain latest possible date (e.g. 'hoy')
     * @return string|string[] message
     */
    public static function msg_before_equal(string $field, string $date) {
        return str_replace([':field', ':date'], [$field, $date], self::$messages['before_equal']);
    }

    /**
     * Returns predefined message corresponding to the key, or a default error message
     *
     * @param string $key
     * @return string message
     */
    public static function msg_other(string $key) {
        if (array_key_exists($key, self::$messages)) {
            return self::$messages[$key];
        } else {
            return self::$messages['error'];
        }
    }
}
