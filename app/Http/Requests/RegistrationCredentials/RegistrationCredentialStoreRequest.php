<?php

namespace App\Http\Requests\RegistrationCredentials;

use App\Http\Requests\BaseFormRequest;

class RegistrationCredentialStoreRequest extends BaseFormRequest
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
            "role_id" => "required|numeric",
            "credential" => "required"
        ];
    }
}
