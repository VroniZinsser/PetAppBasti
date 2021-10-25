<?php

namespace App\Http\Requests\Users\Professionals;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:30|min:2',
            'last_name' => 'required|max:30|min:2',
            'email' => 'required|email|max:60|unique:users,email',
            'email_visible' => 'required|boolean',
            'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/',
            'country' => 'required|max:60',
            'state' => 'required|max:60',
            'city' => 'required|max:60',
            'postal_code' => 'required|max:10|regex:/^\d+$/',
            'district' => 'max:60',
            'street' => 'max:60',
            'house_number' => 'max:5|regex:/^\d+$/',
            'apartment' => 'max:10',
            'latitude' => 'required',
            'longitude' => 'required',
            'dni' => 'max:15|min:8|required|regex:/^\d+$/',
            'description' => 'nullable',
            'whatsapp' => 'max:20|min:6|nullable|regex:/^\d+$/',
            'instagram' => 'max:30',
            'facebook' => 'max:50',
            'web' => 'max:50|nullable',
            'verified' => 'boolean|nullable',
            'user_types' => 'min:1|array',
            'user_types.*' => 'integer|exists:user_types,id',
            'photo' => 'required',
            'photo' => 'base64image|base64max:10000',
        ];
    }

    /**
     * Get the messages in case a rule is not fullfilled
     * 
     * @return array
     */
    public function messages() {
        return [
            'first_name.required' => 'Por favor ingresá tu nombre',
            'first_name.max' => 'El nombre no puede contener más de :max caracteres',
            'first_name.min' => 'El nombre no puede contener menos de :min caracteres',
            'last_name.required' => 'Por favor ingresá tu apellido',
            'last_name.max' => 'El apellido no puede contener mas de :max caracteres',
            'last_name.min' => 'El apellido no puede contener menos de :min caracteres',
            'email.required' => 'Por favor ingresá tu correo electrónico',
            'email.email' => 'Este correo electrónico no es válido.',
            'email.max' => 'El correo no puede contener más de :max caracteres',
            'email.unique' => 'Ya existe una cuenta con este correo electrónico',
            'email_visible.required' => 'Debe estar especificado si el correo electrónico es visible al público o no.',
            'email_visible.boolean' => 'El valor si el correo electrónico es visible debe ser de tipo boolean.',
            'password.required' => 'Por favor ingresá una contraseña',
            'password.min' => 'La contraseña debe tener como mínimo :min caracteres',
            'password.regex' => 'La contraseña debe contener un número',
            'country.required' => 'El país es obligatorio',
            'country.max' => 'El país no puede contener mas de :max caracteres',
            'state.required' => 'La provincia es obligatoria.',
            'state.max' => 'La provincia no puede contener mas de :max caracteres',
            'city.required' => 'La ciudad es obligatoria',
            'city.max' => 'La ciudad no puede contener mas de :max caracteres',
            'postal_code.required' => 'El código postal es obligatorio',
            'postal_code.max' => 'El código postal no puede contener mas de :max caracteres',
            'postal_code.regex' => 'El código postal solo puede contener números',
            'district.max' => 'El barrio no puede contener mas de :max caracteres',
            'street.max' => 'La calle no puede contener mas de :max caracteres',
            'house_number.max' => 'El número de casa no puede contener mas de :max caracteres',
            'house_number.regex' => 'El número de casa solo puede contener números',
            'apartment.max' => 'El número de piso y apartamento no puede contener mas de :max caracteres',
            'latitude.required' => 'La latitud es obligatoria',
            'longitude.required' => 'La longitud es obligatoria',
            'dni.required' => 'Por favor ingresá tu número de DNI',
            'dni.max' => 'El DNI no puede contener más de :max caracteres',
            'dni.min' => 'El dni no puede contener menos de :min caracteres',
            'dni.regex' => 'El DNI solo puede contener números',
            'whatsapp.max' => 'El número de teléfono no puede contener más de :max caracteres',
            'whatsapp.min' => 'El número de teléfono no puede contener menos de :min caracteres',
            'whatsapp.regex' => 'El número de teléfono solo puede contener números',
            'instagram.max' => 'El nombre de usuario de Instagram no puede tener más de :max caracteres',
            'facebook.max' => 'El nombre de usuario de Facebook no puede tener más de :max caracteres', 
            'web.max' => 'La url no puede contener más de :max caracteres',
            'verified.boolean' => 'El valor ingresado no es válido',
            'user_types.min' => 'Por favor elegí un tipo de profesión',
            'user_types.array' => 'El tipo de profesión ingresado no es válido',
            'user_types.*.exists' => 'El tipo de profesión ingresado no existe',
            'user_types.*.integer' => 'El tipo de profesión ingresado no es válido',
            'photo.required' => 'Por favor subí una imagen de perfil',
            'photo.image' => 'El archivo subido tiene que ser una imagen',
            'photo.base64image' => 'El archivo subido tiene que ser una imagen',
            'photo.max' => 'El archivo subido no puede pesar mas de 1MB',
            'photo.base64max' => 'El archivo subido no puede pesar mas de 1MB',
        ];
    }
}
