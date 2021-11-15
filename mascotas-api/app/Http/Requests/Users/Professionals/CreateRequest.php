<?php

namespace App\Http\Requests\Users\Professionals;

use Illuminate\Foundation\Http\FormRequest;
use App\Constants\Validation;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:30|min:2|alpha',
            'last_name' => 'required|max:30|min:2|alpha',
            'email' => 'required|email|max:60|unique:users,email',
            'email_visible' => 'required|boolean',
            'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/',
            'country' => 'required|max:60',
            'state' => 'required|max:60',
            'city' => 'required|max:60',
            'postal_code' => 'required|max:10|regex:/^\d+$/',
            'district' => 'max:60',
            'street' => 'max:60',
            'house_number' => 'max:5|regex:/^\d+$/',
            'apartment' => 'max:10',
            'latitude' => 'required',
            'longitude' => 'required',
            'dni' => 'max:15|min:8|required|regex:/^\d+$/',
            'public_name' => 'max:50',
            'description' => 'nullable',
            'whatsapp' => 'max:20|min:6|nullable|regex:/^\d+$/',
            'instagram' => 'max:30',
            'facebook' => 'max:50',
            'web' => [
                'max:50',
                'nullable',
                'regex:/^(ftp|http|https):\/\/[^ "]+$/'
            ],
            'verified' => 'boolean|nullable',
            'user_types' => 'min:1|array',
            'user_types.*' => 'integer|exists:user_types,id',
            'photo' => 'required',
            'photo' => 'base64image|base64max:10000',
        ];
    }

    /**
     * Get the messages in case a rule is not fullfilled
     * 
     * @return array
     */
    public function messages() {
        return [
            // 'first_name.required' => Validation::get(Validation::REQUIRED,'tu nombre'),
            // 'first_name.max' => Validation::get(Validation::MAX_CARACTERS, 'el nombre', ':max'),
            // 'first_name.min' => 'El nombre no puede contener menos de :min caracteres',
            // 'first_name.alpha' => Validation::get(Validation::VALID_VALUE, 'el nombre'),
            // 'last_name.required' => Validation::get(Validation::REQUIRED,'tu apellido'),
            // 'last_name.max' => Validation::get(Validation::MAX_CARACTERS, 'el apellido', ':max'),
            // 'last_name.min' => 'El apellido no puede contener menos de :min caracteres',
            // 'last_name.alpha' => Validation::get(Validation::VALID_VALUE, 'el apellido'),
            // 'email.required' => Validation::get(Validation::REQUIRED,'tu correo electrónico'),
            // 'email.email' => Validation::get(Validation::VALID_VALUE, 'el correo electrónico'),
            // 'email.max' => Validation::get(Validation::MAX_CARACTERS, 'el correo electrónico', ':max'),
            // 'email.unique' => 'Ya existe una cuenta con este correo electrónico',
            // 'email_visible.required' => Validation::get(Validation::REQUIRED,'si el correo electrónico es visible al público'),
            // 'email_visible.boolean' => 'El valor si el correo electrónico es visible debe ser de tipo boolean.',
            // 'password.required' => Validation::get(Validation::REQUIRED,'una contraseña'),
            // 'password.min' => 'La contraseña debe tener como mínimo :min caracteres',
            // 'password.regex' => 'La contraseña debe contener un número',
            // 'country.required' => Validation::get(Validation::REQUIRED, 'el país'),
            // 'country.max' => Validation::get(Validation::MAX_CARACTERS, 'el país', ':max'),
            // 'state.required' => Validation::get(Validation::REQUIRED,'la provincia'),
            // 'state.max' => Validation::get(Validation::MAX_CARACTERS, 'la provincia', ':max'),
            // 'city.required' => Validation::get(Validation::REQUIRED,'la ciudad'),
            // 'city.max' => Validation::get(Validation::MAX_CARACTERS, 'la ciudad', ':max'),
            // 'postal_code.required' => Validation::get(Validation::REQUIRED,'el código postal'),
            // 'postal_code.max' => Validation::get(Validation::MAX_CARACTERS, 'el código postal', ':max'),
            // 'postal_code.regex' => 'El código postal solo puede contener números',
            // 'district.max' => Validation::get(Validation::MAX_CARACTERS, 'el barrio', ':max'),
            // 'street.max' => Validation::get(Validation::MAX_CARACTERS, 'la calle', ':max'),
            // 'house_number.max' => Validation::get(Validation::MAX_CARACTERS, 'el número de casa', ':max'),
            // 'house_number.regex' => 'El número de casa solo puede contener números',
            // 'apartment.max' => Validation::get(Validation::MAX_CARACTERS, 'el número de piso y apartamento', ':max'),
            // 'latitude.required' => Validation::get(Validation::REQUIRED, 'la latitud'),
            // 'longitude.required' => Validation::get(Validation::REQUIRED, 'la longitud'),
            // 'dni.required' => Validation::get(Validation::REQUIRED, 'tu número de DNI'),
            // 'dni.max' => Validation::get(Validation::MAX_CARACTERS, 'el número del DNI', ':max'),
            // 'dni.min' => 'El dni no puede contener menos de :min caracteres',
            // 'dni.regex' => 'El DNI solo puede contener números',
            // 'public_name.max' => 'El nombre de la institución no puede contener más de :max caracteres',
            // 'whatsapp.max' => Validation::get(Validation::MAX_CARACTERS, 'el número de teléfono', ':max'),
            // 'whatsapp.min' => 'El número de teléfono no puede contener menos de :min caracteres',
            // 'whatsapp.regex' => 'El número de teléfono solo puede contener números',
            // 'instagram.max' => Validation::get(Validation::MAX_CARACTERS, 'el nombre de usuario de Instagram', ':max'),
            // 'facebook.max' => Validation::get(Validation::MAX_CARACTERS, 'el nombre de usuario de Facebook', ':max'), 
            // 'web.max' => Validation::get(Validation::MAX_CARACTERS, 'la url', ':max'),
            // 'web.regex' => Validation::get(Validation::VALID_VALUE, 'la url'),
            // 'verified.boolean' => 'El valor ingresado no es válido',
            // 'user_types.min' => 'Por favor elegí un tipo de profesión',
            // 'user_types.array' => Validation::get(Validation::VALID_VALUE, 'el tipo de profesión'),
            // 'user_types.*.exists' => 'El tipo de profesión ingresado no existe',
            // 'user_types.*.integer' => 'El tipo de profesión ingresado no es válido',
            // 'photo.required' => Validation::get(Validation::REQUIRED, 'una imagen de perfil'),
            // 'photo.image' => 'El archivo subido tiene que ser una imagen',
            // 'photo.base64image' => 'El archivo subido tiene que ser una imagen',
            // 'photo.max' => Validation::get(Validation::MAX_SIZE, 'la imagen', '1MB'),
            // 'photo.base64max' => Validation::get(Validation::MAX_SIZE, 'la imagen', '1MB'),
        ];
    }
}
