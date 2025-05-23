<?php

namespace App\Http\Requests\Network\Cctv;

use Illuminate\Foundation\Http\FormRequest;

class StoreCctvRequest extends FormRequest
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
            'type' => 'required|max:255',
            'brand' => 'required|max:255',
            'location' => 'required|max:255',
            'maintainer' => 'required|max:255',
            'type_loc' => 'required|max:255',
            'category' => 'required|max:255',
            'type_cctv' => 'required|max:255',
            'ip' => 'required|max:255',
            'link' => 'required|max:255',
            'username_cctv' => 'required|max:255',
            'password_cctv' => 'required|max:255',
            'lon_lat' => 'max:255',
            'installation_date' => 'required|max:255',
            'file' => 'max:51200',
            'description' => 'max:255',
            'stats' => 'required|max:255',
        ];
    }
}
