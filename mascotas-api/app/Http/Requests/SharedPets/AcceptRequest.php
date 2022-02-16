<?php

namespace App\Http\Requests\SharedPets;

use App\Repositories\ContactRepository;
use App\Services\ContactService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AcceptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     */
    public function authorize()
    {
        $id = $this->route('request_id');

        if (!(new ContactService())->checkAcceptRequest($id)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}



