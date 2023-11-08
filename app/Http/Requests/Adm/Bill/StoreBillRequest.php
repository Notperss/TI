<?php

namespace App\Http\Requests\Adm\Bill;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "pp_id" => "required",
            "bill_to" => "required|max:225",
            "bill_value" => "required|max:225",
            "date" => "required",
            "description" => "required",
            "file" => "required",
        ];
    }
}
