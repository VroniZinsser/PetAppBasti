<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionalCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:30|min:2',
            'last_name' => 'required|max:30|min:2',
            'email' => 'required|email|max:60|unique:users,email',
            'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/',
            'address' => 'required|max:100',
            'dni' => 'max:15|min:8|required|regex:/^\d+$/',
            'description' => 'nullable',
            'web' => 'max:50|nullable',
            'phone_number' => 'max:20|min:6|nullable|regex:/^\d+$/',
            'verified' => 'boolean|nullable',
            'user_types' => 'min:1',
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
            'first_name.required' => 'Por favor ingresá tu nombre',
            'first_name.max' => 'El nombre no puede contener más de :max caracteres',
            'first_name.min' => 'El nombre no puede contener menos de :min caracteres',
            'last_name.required' => 'Por favor ingresá tu apellido',
            'last_name.max' => 'El apellido no puede contener mas de :max caracteres',
            'last_name.min' => 'El apellido no puede contener menos de :min caracteres',
            'email.required' => 'Por favor ingresá tu correo electrónico',
            'email.email' => 'Este correo electrónico no es válido.',
            'email.max' => 'El correo no puede contener más de :max caracteres',
            'email.unique' => 'Ya existe una cuenta con este correo electrónico',
            'password.required' => 'Por favor ingresá una contraseña',
            'password.min' => 'La contraseña debe tener como mínimo :min caracteres',
            'password.regex' => 'La contraseña debe contener un número',
            'address.required' => 'Por favor ingresá una dirección',
            'address.max' => 'La dirección no puede contener más de :max caracteres',
            'dni.required' => 'Por favor ingresá tu número de DNI',
            'dni.max' => 'El DNI no puede contener más de :max caracteres',
            'dni.min' => 'El dni no puede contener menos de :min caracteres',
            'dni.regex' => 'El DNI solo puede contener números',
            'web.max' => 'La url no puede contener más de :max caracteres',
            'phone_number.max' => 'El número de teléfono no puede contener más de :max caracteres',
            'phone_number.min' => 'El número de teléfono no puede contener menos de :min caracteres',
            'phone_number.regex' => 'El número de teléfono solo puede contener números',
            'verified.boolean' => 'El valor ingresado no es válido',
            'user_types.min' => 'Por favor elegí un tipo de profesión',
            'photo.required' => 'Por favor subí una imagen de perfil',
            'photo.image' => 'El archivo subido tiene que ser una imagen',
            'photo.base64image' => 'El archivo subido tiene que ser una imagen',
            'photo.max' => 'El archivo subido no puede pesar mas de 1MB',
            'photo.base64max' => 'El archivo subido no puede pesar mas de 1MB',
        ];
    }
}
