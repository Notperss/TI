<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorTiRequest extends FormRequest
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
            'nama_vendor' => [
                'required', 'max:255'
            ],
            'telp' => [
                'required',
            ],
            'pic' => [
                'required',
            ],
            'address' => [
                'required', 'max:255'
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
