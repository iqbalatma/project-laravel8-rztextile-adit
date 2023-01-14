<?php

namespace App\Http\Requests\Payments;

use App\Http\Requests\BaseFormRequest;

class PaymentStoreRequest extends BaseFormRequest
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
            "invoice_id" => "required|numeric",
            "paid_amount" => "numeric",
            "payment_type" => "required|in:cash,transfer",
            "bill_left" => "required|numeric"
        ];
    }
}
