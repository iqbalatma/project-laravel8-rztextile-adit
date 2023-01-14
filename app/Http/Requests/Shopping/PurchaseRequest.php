<?php

namespace App\Http\Requests\Shopping;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            "customer_id" => "nullable|numeric",
            "payment_type" => "required|in:cash,transfer",
            "rolls" => "required",
            "total_bill" => "required|numeric",
            "paid_amount" => "required|numeric"
        ];
    }
}
