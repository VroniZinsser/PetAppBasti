<?php

namespace App\Http\Requests\Auth;

use App\Messages\Validation;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordAuthenticatedRequest extends FormRequest
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
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/',
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
            'currentPassword.required' => Validation::msg_required('tu contraseña actual'),
            'newPassword.required' => Validation::msg_required('una nueva contraseña'),
            'newPassword.min' => Validation::msg_min_caracters('la contraseña', ':min'),
            'newPassword.regex' => Validation::msg_other('password_requirements'),
        ];
    }
}