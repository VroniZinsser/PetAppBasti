<?php

namespace App\Http\Requests\Medicines;

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
            "name.required" => "El nombre del medicamento es obligatorio",
            "name.max" => "El nombre del medicamento no puede superar los :max caracteres",
            "quantity.required" => "La cantidad de medicamento es obligatorio",
            "quantity.max" => "La cantidad de medicamento no puede superar los :max caracteres",
            "start_date.required" => "La fecha de inicio es obligatoria",
            "start_date.date" => "La fecha de inicio debe tener un formato de fecha válido",
            "end_date.required" => "La fecha de fin es obligatoria",
            "end_date.date" => "La fecha de fin debe tener un formato de fecha válido",
            "end_date.after_or_equal" => "La fecha de fin debe ser igual o después de la fecha de inicio seleccionado",
            "id.required" => "La mascota es obligatorio",
            "id.integer" => "La mascota no es válida",
            "id.exists" => "No se encontró la mascota",
            "hours.required" => "Los horarios son obligatorios",
            "hours.array" => "El formato de los horarios no es válido",
            "hours.min" => "Debe de seleccionar como mínimo una hora",
            "hours.exists" => "No se encontró la hora seleccionada",
        ];
    }
}
