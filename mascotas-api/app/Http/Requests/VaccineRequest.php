<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VaccineRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'date' => 'required|date|before_or_equal:'.date('m/d/Y'),
            'pet_id' => 'required|exists:pets,id|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de vacuna es obligatorio',
            'date.required' => 'La fecha es obligatoria',
            'date.date' => 'Por favor ingresá una fecha válida',
            'pet_id.required' => 'El peso tiene que estar relacionado a una mascota',
            'pet_id.exists' => 'La mascota seleccionada no existe',
            'pet_id.integer' => 'La mascota seleccionada no es válida'
        ];
    }
}
