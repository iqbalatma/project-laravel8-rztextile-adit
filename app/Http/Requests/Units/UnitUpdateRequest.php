<?php

namespace App\Http\Requests\Units;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UnitUpdateRequest extends BaseFormRequest
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
            "name" => "required|max:32",
            "shortname" => ["required", Rule::unique("units", "shortname")->ignore($this->id)->whereNull("deleted_at")]
        ];
    }
}
