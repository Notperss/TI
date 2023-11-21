<?php

namespace App\Http\Requests\SystemInformation\DRC;

use Illuminate\Foundation\Http\FormRequest;

class StoreDRCRequest extends FormRequest
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
            'name' => 'required|max:255',
            'category' => 'required|max:255',
            'path_source' => 'required|max:255',
            'path_backup' => 'required|max:255',
            'path_drc' => 'required|max:255',
            'backup_frequency' => 'required|max:255',
            'backup_time' => 'required|max:255',
            'stats' => 'required|max:255',
            'description' => 'required',
        ];
    }
}
