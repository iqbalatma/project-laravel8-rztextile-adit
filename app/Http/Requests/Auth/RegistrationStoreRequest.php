<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class RegistrationStoreRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            "name" => "required",
            "id_number" => "numeric",
            "email" => "email|required|unique:users",
            "registration_credential" => "required",
            "password" => "required|confirmed",
            "phone" => "nullable",
            "address" => "nullable"
        ];
    }
}
