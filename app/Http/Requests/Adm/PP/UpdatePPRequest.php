<?php

namespace App\Http\Requests\Adm\PP;


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
            "no_pp" => "required",
            "job_name" => "required",
            "job_value" => "required",
            "rkap" => "required",
            "date" => "required",
            "year" => "required",
            "stats" => "required",
            "description" => "required",
        ];
    }
}
