<?php

namespace App\Http\Requests\MasterData\Goods;

use Illuminate\Validation\Rule;
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
            'stats' => 'required|max:255',
            'name' => 'required|max:255',
            'sku' => ['max:255',
                Rule::unique('goods', 'sku')->ignore($this->route('goods'), 'id'),
            ],
            'barcode' => ['max:255',
                Rule::unique('goods', 'barcode')->ignore($this->route('goods'), 'id'),
            ],
            'size' => 'max:255',
            'brand' => 'max:255',
            'year' => 'max:255',
            'file' => 'mimes:png,jpg,jpeg',
        ];
    }
}
