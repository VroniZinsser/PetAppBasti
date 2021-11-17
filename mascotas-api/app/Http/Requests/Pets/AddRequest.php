<?php

namespace App\Http\Requests\Pets;

use Illuminate\Foundation\Http\FormRequest;
use App\Messages\Validation;

class AddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return true;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'breed' => 'max:45',
            'date_of_birth' => 'date|before_or_equal:now|nullable',
            'name' => 'required|max:30',
            'neutered' => 'boolean',
            'temperament' => 'max:45',
            'photo' => 'base64image|base64max:10000',
            'sexes_id' => 'required|exists:sexes,id|integer',
            'species_id' => 'required|exists:species,id|integer'
        ];
    }

    public function messages(): array
    {
        
        return [
            'breed.max' => Validation::msg_max_caracters('la raza', ':max'),
            'date_of_birth.date' => Validation::msg_valid_value('la fecha', true),
            'date_of_birth.before_or_equal' => Validation::msg_before_equal('una fecha', 'la fecha de hoy'),
            'name.required' => Validation::msg_required('el nombre de tu mascota'),
            'name.max' => Validation::msg_max_caracters('el nombre de tu mascota', ':max'),
            'neutered.boolean' => Validation::msg_valid_value('la castración', true),
            'temperament.max' => Validation::msg_max_caracters('el temperamento', ':max'),
            'photo.image' => Validation::msg_valid_value('la imagen', true),
            'photo.base64image' => Validation::msg_valid_value('la imagen', true),
            'photo.max' => Validation::msg_max_size('la imagen', '1MB'),
            'photo.base64max' => Validation::msg_max_size('la imagen', '1MB'),
            'sexes_id.required' => Validation::msg_not_found('el sexo'),
            'sexes_id.exists' => Validation::msg_not_found('el sexo'),
            'sexes_id.integer' => Validation::msg_not_found('el sexo'),
            'species_id.required' => Validation::msg_not_found('la especie'),
            'species_id.exists' => Validation::msg_not_found('la especie'),
            'species_id.integer' => Validation::msg_not_found('la especie'),
        ];
    }
}
