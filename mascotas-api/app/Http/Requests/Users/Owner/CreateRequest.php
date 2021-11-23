<?php

namespace App\Http\Requests\Users\Owner;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'first_name' => 'required|max:30|min:2|string',
            'last_name' => 'required|max:30|min:2|string',
            'email' => 'required|email|max:60|unique:users,email',
            'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/',
        ];
    }

    /**
     * Get the messages in case a rule is not fulfilled
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Por favor ingresá tu nombre',
            'first_name.max' => 'El nombre no puede contener más de :max caracteres',
            'first_name.min' => 'El nombre no puede contener menos de :min caracteres',
            'first_name.string' => 'El nombre solo puede contener letras',
            'last_name.required' => 'Por favor ingresá tu apellido',
            'last_name.max' => 'El apellido no puede contener mas de :max caracteres',
            'last_name.min' => 'El apellido no puede contener menos de :min caracteres',
            'last_name.string' => 'El apellido solo puede contener letras',
            'email.required' => 'Por favor ingresá tu correo electrónico',
            'email.email' => 'Este correo electrónico no es válido.',
            'email.max' => 'El correo no puede contener más de :max caracteres',
            'email.unique' => 'Ya existe una cuenta con este correo electrónico',
            'password.required' => 'Por favor ingresá una contraseña',
            'password.min' => 'La contraseña debe tener como mínimo :min caracteres',
            'password.regex' => 'La contraseña debe contener un número',
        ];
    }
}
