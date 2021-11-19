<?php

namespace App\Http\Requests\Pets;

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
            'sex_id' => 'required|exists:sexes,id|integer',
            'species_id' => 'required|exists:species,id|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'breed.max' => 'La raza no puede contener mas de :max caracteres',
            'date_of_birth.date' => 'Por favor ingresá una fecha valida',
            'date_of_birth.before_or_equal' => 'La fecha ingresada no puede ser superior a la fecha actual',
            'name.required' => 'Por favor ingresá el nombre de su mascota',
            'name.max' => 'El nombre no puede contener mas de :max caracteres',
            'neutered.boolean' => 'No ingresó un dato valido',
            'temperament.max' => 'El temperamento no puede contener mas de :max caracteres',
            'photo.image' => 'El archivo subido tiene que ser una imagen',
            'photo.base64image' => 'El archivo subido tiene que ser una imagen',
            'photo.max' => 'El archivo subido no puede pesar mas de 1MB',
            'photo.base64max' => 'El archivo subido no puede pesar mas de 1MB',
            'sex_id.required' => 'El sexo es obligatorio',
            'sex_id.exists' => 'El sexo seleccionado no es valido',
            'sex_id.integer' => 'El sexo seleccionado no es valido',
            'species_id.required' => 'La especie es obligatoria',
            'species_id.exists' => 'La especie seleccionada no es valida',
            'species_id.integer' => 'La especie seleccionada no es valida',
        ];
    }
}
