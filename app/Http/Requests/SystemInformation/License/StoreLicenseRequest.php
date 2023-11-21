<?php

namespace App\Http\Requests\SystemInformation\License;

use Illuminate\Foundation\Http\FormRequest;

class StoreLicenseRequest extends FormRequest
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
            'name_app' => 'required|max:255',
            'type_app' => 'required|max:255',
            'product' => 'required|max:255',
            'name_vendor' => 'required|max:255',
            'version' => 'required|max:255',
            'date_start' => 'required',
            'date_finish' => 'required',
            'pp' => 'required|max:255',
            'barcode' => 'required|max:255',
            'num_of_licenses' => 'required|max:255',
            'description' => 'required',
        ];
    }
}
