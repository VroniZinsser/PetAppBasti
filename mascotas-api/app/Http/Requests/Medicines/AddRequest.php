<?php

namespace App\Http\Requests\Medicines;

use App\Messages\Validation;
use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
     * Add the ID to be able to apply validation to it
     */
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:45",
            "quantity" => "required|max:60",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
            "id" => "required|integer|exists:pets,id",
            "hours" => "required|array|min:1|exists:hours,id",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => Validation::msg_required('el nombre del medicamento'),
            "name.max" => Validation::msg_max_caracters('el nombre del medicamento', ':max'),
            "quantity.required" => Validation::msg_required('la cantidad de medicamento'),
            "quantity.max" => Validation::msg_max_caracters('la cantidad de medicamento', ':max'),
            "start_date.required" => Validation::msg_required('la fecha de inicio'),
            "start_date.date" => Validation::msg_valid_value('la fecha de inicio', true),
            "end_date.required" => Validation::msg_required('la fecha de fin'),
            "end_date.date" => Validation::msg_valid_value('la fecha de fin', true),
            "end_date.after_or_equal" => Validation::msg_after_equal('la fecha de fin', 'la fecha de inicio seleccionado'),
            "id.required" => Validation::msg_not_found('la mascota relacionada'),
            "id.integer" => Validation::msg_not_found('la mascota relacionada'),
            "id.exists" => Validation::msg_not_found('la mascota relacionada'),
            "hours.required" => Validation::msg_required('los horarios'),
            "hours.array" => Validation::msg_valid_value('el horario'),
            "hours.min" => Validation::msg_required('como mínimo una hora'),
            "hours.exists" => Validation::msg_not_found('la hora seleccionada'),
        ];
    }
}
