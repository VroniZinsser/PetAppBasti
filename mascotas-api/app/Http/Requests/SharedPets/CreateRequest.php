<?php

namespace App\Http\Requests\SharedPets;

use App\Messages\Validation;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /*
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
            "description" => "max:300|string|nullable",
            "expiration_date" => "required|date",
            "pet_id" => "required|integer|exists:pets,id",
            "professional_id" => "required|integer|exists:users,id",
        ];
    }

    public function messages(): array
    {
        return [
            "description.max" => Validation::msg_max_caracters('la descripción', ':max'),
            'description.string' => Validation::msg_valid_value('la descripción'),
            "expiration_date.required" => Validation::msg_required('la fecha de expiración'),
            "expiration_date.date" => Validation::msg_valid_value('la fecha de expiración', true),
            "pet_id.required" => Validation::msg_not_found('la mascota seleccionada'),
            "pet_id.integer" => Validation::msg_not_found('la mascota seleccionada'),
            "pet_id.exists" => Validation::msg_not_found('la mascota seleccionada'),
            "professional_id.required" => Validation::msg_not_found('El profesional'),
            "professional_id.integer" => Validation::msg_not_found('El profesional'),
            "professional_id.exists" => Validation::msg_not_found('El profesional'),
        ];
    }
}
