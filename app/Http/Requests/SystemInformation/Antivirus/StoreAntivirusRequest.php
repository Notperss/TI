<?php

namespace App\Http\Requests\SystemInformation\Antivirus;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntivirusRequest extends FormRequest
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
            'name_antivirus' => 'required|max:255',
            'num_of_licenses' => 'required|max:255',
            'year' => 'required',
            'date_start' => 'required',
            'date_finish' => 'required',
            'stats' => 'required',
            'description' => 'required',
        ];
    }
}
