<?php

namespace App\Http\Requests\MasterData\Goods;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodsRequest extends FormRequest
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
            'name' => 'required',
            'category' => 'required',
            'barcode' => 'required',
            'file' => 'mimes:png,jpg,jpeg',
        ];
    }
}
