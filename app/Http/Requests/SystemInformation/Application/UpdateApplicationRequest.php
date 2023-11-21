<?php

namespace App\Http\Requests\SystemInformation\Application;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
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
            'user' => 'required',
            'name_app' => 'required',
            'creator' => 'required',
            'date_start' => 'required',
            'date_finish' => 'required',
            'path_app' => 'required',
            'path_database' => 'required',
            'path_file' => 'required',
            'description' => 'required',
            'stats' => 'required',
        ];
    }
}
