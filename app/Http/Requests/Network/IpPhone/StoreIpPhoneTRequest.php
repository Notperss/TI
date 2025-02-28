<?php

namespace App\Http\Requests\Network\IpPhone;

use Illuminate\Foundation\Http\FormRequest;

class StoreIpPhoneTRequest extends FormRequest
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
            'caller' => 'required|max:255',
            'type' => 'required|max:255',
            'distributionAsset_id' => 'required|max:255',
            // 'location' => 'required|max:255',
            // 'barcode' => 'required|max:255',
            'ip' => 'required|max:255',
            'installation_date' => 'required|max:255',
            'file' => 'max:51200',
            // 'description' => 'required|max:255',
            'stats' => 'required|max:255',
        ];
    }
}
