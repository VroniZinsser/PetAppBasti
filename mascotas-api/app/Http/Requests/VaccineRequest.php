<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Messages\Validation;

class VaccineRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'date' => 'required|date|before_or_equal:'.date('m/d/Y'),
            'pets_id' => 'required|exists:pets,id|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => Validation::msg_required('el nombre de la vacuna'),
            'date.required' => Validation::msg_required('la fecha'),
            'date.date' => Validation::msg_valid_value('la fecha', true),
            'pets_id.required' => Validation::msg_not_found('la mascota relacionada'),
            'pets_id.exists' => Validation::msg_not_found('la mascota relacionada'),
            'pets_id.integer' => Validation::msg_not_found('la mascota relacionada'),
        ];
    }
}
