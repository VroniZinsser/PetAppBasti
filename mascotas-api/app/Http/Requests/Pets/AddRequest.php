<?php

namespace App\Http\Requests\Pets;

use Illuminate\Foundation\Http\FormRequest;
use App\Constants\Validation;

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
            'breed.max' => Validation::get(Validation::MAX_CARACTERS, 'la raza', ':max'),
            'date_of_birth.date' => Validation::get(Validation::VALID_VALUE, 'la fecha'),
            'date_of_birth.before_or_equal' => Validation::get(Validation::BEFORE_EQUAL, 'una fecha', ':date'),
            'name.required' => Validation::get(Validation::REQUIRED, 'el nombre de tu mascota'),
            'name.max' => Validation::get(Validation::MAX_CARACTERS, 'el nombre de tu mascota', ':max'),
            'neutered.boolean' => Validation::get(Validation::VALID_VALUE, 'la castración'),
            'temperament.max' => Validation::get(Validation::MAX_CARACTERS, 'el temperamento', ':max'),
            'photo.image' => Validation::get(Validation::VALID_VALUE, 'la imagen'),
            'photo.base64image' => Validation::get(Validation::VALID_VALUE, 'la imagen'),
            'photo.max' => Validation::get(Validation::MAX_SIZE, 'la imagen', '1MB'),
            'photo.base64max' => Validation::get(Validation::MAX_SIZE, 'la imagen', '1MB'),
            'sexes_id.required' => Validation::get(Validation::REQUIRED,'el sexo'),
            'sexes_id.exists' => Validation::get(Validation::VALID_VALUE, 'el sexo'),
            'sexes_id.integer' => Validation::get(Validation::VALID_VALUE, 'el sexo'),
            'species_id.required' => Validation::get(Validation::REQUIRED,'la especie'),
            'species_id.exists' => Validation::get(Validation::VALID_VALUE, 'la especie'),
            'species_id.integer' => Validation::get(Validation::VALID_VALUE, 'la especie'),
        ];
    }
}
