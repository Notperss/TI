<?php

namespace App\Http\Requests\Adm\ATK;

use Illuminate\Foundation\Http\FormRequest;

class StoreATKRequest extends FormRequest
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
            'description' => 'required|max:254',
            'date' => 'required',
            'usage' => 'required',
        ];
    }
}
