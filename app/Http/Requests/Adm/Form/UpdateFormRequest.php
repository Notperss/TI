<?php

namespace App\Http\Requests\Adm\Form;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
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
            'name_form' => 'required|max:255',
            'category' => 'required|max:255',
            'description' => 'required',
            'file' => 'max:51200',
        ];
    }
}
