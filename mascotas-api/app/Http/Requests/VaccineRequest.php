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
            'name.required' => Validation::msg_required('el nombre de la vacuna'),
            'date.required' => Validation::msg_required('la fecha'),
            'date.date' => Validation::msg_valid_value('la fecha', true),
            'pet_id.required' => Validation::msg_not_found('la mascota relacionada'),
            'pet_id.exists' => Validation::msg_not_found('la mascota relacionada'),
            'pet_id.integer' => Validation::msg_not_found('la mascota relacionada'),
        ];
    }
}
