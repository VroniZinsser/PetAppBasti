<?php

namespace App\Http\Requests\Auth;

use App\Messages\Validation;
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
            'email' => 'required|email',
            'password' => 'required',
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
        ];
    }
}
