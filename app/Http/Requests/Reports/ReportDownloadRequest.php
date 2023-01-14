<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class ReportDownloadRequest extends FormRequest
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
            "start_date" => "required",
            "end_date" => "required",
            "sales_report" => "nullable",
            "warehouse_report" => "nullable",
            "payment_report" => "nullable",
            "customer_report" => "nullable",
        ];
    }
}
