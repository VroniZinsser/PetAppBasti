<?php

namespace App\Http\Requests\Users\Professionals;

use Illuminate\Foundation\Http\FormRequest;
use App\Messages\Validation;

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
            'photo' => 'required|base64image|base64max:10000',
        ];
    }

    /**
     * Get the messages in case a rule is not fullfilled
     * 
     * @return array
     */
    public function messages() {
        return [
            'first_name.required' => Validation::msg_required('tu nombre'),
            'first_name.max' => Validation::msg_max_caracters('el nombre', ':max'),
            'first_name.min' => Validation::msg_min_caracters('el nombre', ':min'),
            'first_name.alpha' => Validation::msg_valid_value('el nombre'),
            'last_name.required' => Validation::msg_required('tu apellido'),
            'last_name.max' => Validation::msg_max_caracters('el apellido', ':max'),
            'last_name.min' => Validation::msg_min_caracters('el apellido', ':min'),
            'last_name.alpha' => Validation::msg_valid_value('el apellido'),
            'email.required' => Validation::msg_required('tu correo electrónico'),
            'email.email' => Validation::msg_valid_value('el correo electrónico'),
            'email.max' => Validation::msg_max_caracters('el correo electrónico', ':max'),
            'email.unique' => Validation::msg_other('email_unique'),
            'email_visible.required' => Validation::msg_required('si el correo electrónico es visible al público', true),
            'email_visible.boolean' => Validation::msg_valid_value('el valor'),
            'password.required' => Validation::msg_required('una contraseña'),
            'password.min' => Validation::msg_min_caracters('la contraseña', ':min'),
            'password.regex' => Validation::msg_other('password_requirements'),
            'country.required' => Validation::msg_required('el país'),
            'country.max' => Validation::msg_max_caracters('el país', ':max'),
            'state.required' => Validation::msg_required('la provincia'),
            'state.max' => Validation::msg_max_caracters('la provincia', ':max'),
            'city.required' => Validation::msg_required('la ciudad'),
            'city.max' => Validation::msg_max_caracters('la ciudad', ':max'),
            'postal_code.required' => Validation::msg_required('el código postal'),
            'postal_code.max' => Validation::msg_max_caracters('el código postal', ':max'),
            'postal_code.regex' => Validation::msg_numeric('el código postal'),
            'district.max' => Validation::msg_max_caracters('el barrio', ':max'),
            'street.max' => Validation::msg_max_caracters('la calle', ':max'),
            'house_number.max' => Validation::msg_max_caracters('el número de casa', ':max'),
            'house_number.regex' => Validation::msg_numeric('el número de casa'),
            'apartment.max' => Validation::msg_max_caracters('el número de piso y apartamento', ':max'),
            'latitude.required' => Validation::msg_required('la latitud'),
            'longitude.required' => Validation::msg_required('la longitud'),
            'dni.required' => Validation::msg_required('tu número de DNI'),
            'dni.max' => Validation::msg_max_caracters( 'el número del DNI', ':max'),
            'dni.min' => Validation::msg_min_caracters('el número del DNI', ':min'),
            'dni.regex' => Validation::msg_numeric('el número del DNI'),
            'public_name.max' => Validation::msg_max_caracters( 'el nombre de la institución', ':max'),
            'whatsapp.max' => Validation::msg_max_caracters('el número de teléfono', ':max'),
            'whatsapp.min' => Validation::msg_min_caracters('el número de teléfono', ':min'),
            'whatsapp.regex' => Validation::msg_numeric('el número de teléfono'),
            'instagram.max' => Validation::msg_max_caracters('el nombre de Instagram', ':max'),
            'facebook.max' => Validation::msg_max_caracters('el nombre de Facebook', ':max'), 
            'web.max' => Validation::msg_max_caracters('la url', ':max'),
            'web.regex' => Validation::msg_valid_value('la url', true),
            'verified.boolean' => Validation::msg_valid_value('el valor'),
            'user_types.min' => Validation::msg_required('un tipo de servicio'),
            'user_types.array' => Validation::msg_valid_value('el tipo de servicio'),
            'user_types.*.exists' => Validation::msg_not_found('el tipo de servicio'),
            'user_types.*.integer' => Validation::msg_not_found('el tipo de servicio'),
            'photo.required' => Validation::msg_required('una imagen de perfil', true),
            'photo.image' => Validation::msg_valid_value('la imagen', true),
            'photo.base64image' => Validation::msg_valid_value('la imagen', true),
            'photo.max' => Validation::msg_max_size('la imagen', '1MB'),
            'photo.base64max' => Validation::msg_max_size('la imagen', '1MB'),
        ];
    }
}
