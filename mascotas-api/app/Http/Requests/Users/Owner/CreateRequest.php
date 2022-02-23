<?php

namespace App\Http\Requests\Users\Owner;

use App\Messages\Validation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $userId = $this->user ? $this->user->id : null;
        $rulesPassword = $this->user ? '' : 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/';

        return [
            'first_name' => 'required|max:30|min:2|string',
            'last_name' => 'required|max:30|min:2|string',
            'email' => ['required', 'email', 'max:60', Rule::unique('users', 'email')->ignore($userId)],
            'password' => $rulesPassword,
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
            'first_name.required' => Validation::msg_required('tu nombre'),
            'first_name.max' => Validation::msg_max_caracters('el nombre', ':max'),
            'first_name.min' => Validation::msg_min_caracters('el nombre', ':min'),
            'first_name.string' => Validation::msg_valid_value('el nombre'),
            'last_name.required' => Validation::msg_required('tu apellido'),
            'last_name.max' => Validation::msg_max_caracters('el apellido', ':max'),
            'last_name.min' => Validation::msg_min_caracters('el apellido', ':min'),
            'last_name.string' => Validation::msg_valid_value('el apellido'),
            'email.required' => Validation::msg_required('tu correo electrónico'),
            'email.email' => Validation::msg_valid_value('el correo electrónico'),
            'email.max' => Validation::msg_max_caracters('el correo electrónico', ':max'),
            'email.unique' => Validation::msg_other('email_unique'),
            'password.required' => Validation::msg_required('una contraseña'),
            'password.min' => Validation::msg_min_caracters('la contraseña', ':min'),
            'password.regex' => Validation::msg_other('password_requirements'),
        ];
    }
}
