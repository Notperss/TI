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
            'maintenance_operator' => 'required|max:255',
            // 'stats' => 'required|max:255',
            'name' => 'required|max:255',
            'sku' => ['max:255',
                function ($attribute, $value, $fail) {
                    // Add your condition to skip validation here
                    if ($value === '-' || $value == null) {
                        return; // Skip validation if SKU is "-"
                    }

                    // If SKU is not "-", perform the unique validation
                    $rule = Rule::unique('goods', 'sku')->ignore($this->route('barang'), 'id');
                    $validator = validator([$attribute => $value], [$attribute => $rule]);

                    if ($validator->fails()) {
                        $fail($validator->errors()->first($attribute));
                    }
                },
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
