<?php

namespace App\Http\Requests\SharedPets;

use App\Messages\Validation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            "description" => "max:300|string|nullable",
            "expiration_date" => "required|date",
            "pet_id" => "required|integer|exists:pets,id",
        ];
    }

    public function messages(): array
    {
        return [
            "description.max" => Validation::msg_max_caracters('la descripción', ':max'),
            'description.string' => Validation::msg_valid_value('la descripción'),
            "expiration_date.required" => Validation::msg_required('la fecha de expiración'),
            "expiration_date.date" => Validation::msg_valid_value('la fecha de expiración', true),
//            "expiration_date.after_or_equal" => Validation::msg_after_equal('la fecha de expiración', 'la fecha actual'), TODO: SI pongo "now" a la regla de validación me la toma como invalida a la fecha actual y la del dia siguiente
            "pet_id.required" => Validation::msg_not_found('la mascota seleccionada'),
            "pet_id.integer" => Validation::msg_not_found('la mascota seleccionada'),
            "pet_id.exists" => Validation::msg_not_found('la mascota seleccionada'),
        ];
    }
}
