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
            'type_assets' => 'required|max:255',
            'sku' => 'required|max:255',
            'brand' => 'required|max:255',
            'stats' => 'required|max:255',
            'size' => 'required|max:255',
            'year' => 'required|max:255',
            'description' => 'required|max:255',
            'name' => 'required|max:255',
            'barcode' => 'required|max:255',
            'file' => 'mimes:png,jpg,jpeg',
        ];
    }
}
