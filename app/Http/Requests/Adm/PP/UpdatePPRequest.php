<?php

namespace App\Http\Requests\Adm\PP;


use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePPRequest extends FormRequest
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
            "no_pp" => ['required', 'max:255',
                Rule::unique('pps', 'no_pp')->ignore($this->route('pp'), 'id'),
            ],
            "job_name" => "required|max:255",
            "job_value" => "required|max:255",
            "contract_value" => "required|max:255",
            "rkap" => "required|max:255",
            "date" => "required",
            "year" => "required",
            "stats" => "required",
            "type_bill" => "required",
            "description" => "required",
        ];
    }
}
