<?php

namespace App\Http\Requests\Auth;

use App\Messages\Validation;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/',
            'token' => 'required',
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
            'email.required' => Validation::msg_required('tu correo electrónico'),
            'email.email' => Validation::msg_valid_value('el correo electrónico'),
            'password.required' => Validation::msg_required('una contraseña'),
            'password.min' => Validation::msg_min_caracters('la contraseña', ':min'),
            'password.regex' => Validation::msg_other('password_requirements'),
            'token.required' => Validation::msg_other('error'),
        ];
    }
}