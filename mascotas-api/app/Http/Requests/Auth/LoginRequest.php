<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return false;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:60',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Por favor ingresá tu correo electrónico',
            'email.email' => 'Este correo electrónico no es válido.',
            'email.max' => 'El correo no puede contener más de :max caracteres',
            'password.required' => 'Por favor ingresá una contraseña',
            'password.min' => 'La contraseña debe tener como mínimo :min caracteres',
        ];
    }
}
