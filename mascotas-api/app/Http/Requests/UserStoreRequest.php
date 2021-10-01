<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // pregunta: es útil chequear el max length del nombre y enviar mensaje de error?
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'required|email',
            'password' => 'required|min:6'
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
            'first_name.max' => 'El nombre no puede tener más de :max caracteres',
            'last_name.required' => 'Por favor ingresá tu apellido',
            'last_name.max' => 'El apellido no puede tener mas de :max caracteres',
            'email.required' => 'Por favor ingresá tu correo electrónico',
            'email.email' => 'Este correo electrónico no es válido.',
            'password.required' => 'Por favor ingresá una contraseña',
            'password.min' => 'La contraseña debe tener como mínimo :min caracteres'
        ];
    }
}
