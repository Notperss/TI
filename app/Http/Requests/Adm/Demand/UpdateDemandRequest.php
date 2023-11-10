<?php

namespace App\Http\Requests\Adm\Demand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDemandRequest extends FormRequest
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
            'no_demand' => 'required',
            'nominal' => 'required',
            'date_demand' => 'required',
            'type_demand' => 'required',
            'description' => 'required',
        ];
    }
}
