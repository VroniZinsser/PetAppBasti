<?php

namespace App\Http\Requests\Pets;

use Illuminate\Foundation\Http\FormRequest;

class WeightRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date|before_or_equal:'.date('m/d/Y'),
            'weight' => 'required|numeric|min:1',
            'pets_id' => 'required|exists:pets,id|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'La fecha es obligatoria',
            'date.date' => 'Por favor ingresá una fecha válida',
            'date.before_or_equal' => 'No podés elegir una fecha en el futuro.',
            'weight.required' => 'El peso es obligatorio',
            'weight.numeric' => 'Por favor ingresá un número',
            'weight.min' => 'El peso debe ser mayor a 0',
            'pets_id.required' => 'El peso tiene que estar relacionado a una mascota',
            'pets_id.exists' => 'La mascota seleccionada no existe',
            'pets_id.integer' => 'La mascota seleccionada no es válida'
        ];
    }
}
