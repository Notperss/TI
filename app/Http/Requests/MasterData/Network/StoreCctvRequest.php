<?php

namespace App\Http\Requests\MasterData\Network;

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
            'name' => [
                'required',
            ],
            'km' => [
                'required',
            ],
            'latitude' => [
                'required',
            ],
            'longitude' => [
                'required',
            ],
            'link_cctv' => [
                'required',
            ],
            'logo' => [
                'required', 'mimes:jpeg,svg,png'
            ],
        ];
    }
}
