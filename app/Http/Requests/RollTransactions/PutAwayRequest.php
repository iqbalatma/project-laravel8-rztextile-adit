<?php

namespace App\Http\Requests\RollTransactions;

use App\Http\Requests\BaseFormRequest;

class PutAwayRequest extends BaseFormRequest
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
            "roll_id" => "required|numeric",
            "quantity_roll" => "required|numeric",
            "quantity_unit" => "required|numeric",
        ];
    }
}
