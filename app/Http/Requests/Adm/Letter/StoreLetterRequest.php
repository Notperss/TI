<?php

namespace App\Http\Requests\Adm\Letter;

use Illuminate\Foundation\Http\FormRequest;

class StoreLetterRequest extends FormRequest
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
            "no_letter" => "required",
            "date_letter" => "required",
            "type_letter" => "required",
            "description" => "required",
        ];
    }
}
