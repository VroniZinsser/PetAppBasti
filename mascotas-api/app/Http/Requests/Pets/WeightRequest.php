<?php

namespace App\Http\Requests\Pets;

use Illuminate\Foundation\Http\FormRequest;
use App\Messages\Validation;

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
            'date.required' => Validation::msg_required('la fecha'),
            'date.date' => Validation::msg_valid_value('la fecha', true),
            'date.before_or_equal' => Validation::msg_before_equal('la fecha', 'hoy'),
            'weight.required' => Validation::msg_required('el peso'),
            'weight.numeric' => Validation::msg_numeric('el peso'),
            'weight.min' => Validation::msg_required('el peso'),
            'pets_id.required' => Validation::msg_not_found('la mascota relacionada'),
            'pets_id.exists' => Validation::msg_not_found('la mascota relacionada'),
            'pets_id.integer' => Validation::msg_not_found('la mascota relacionada'),
        ];
    }
}
