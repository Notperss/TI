<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobdeskRequest extends FormRequest
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
            'jobdesk' => [
                'required', 'string', 'max:255',
            ],
            'year' => [
                'required', 'string', 'max:255',
            ],
            'general' => [
                'required', 'string', 'max:255',
            ],
            'technical' => [
                'required', 'string', 'max:255',
            ],
            'type' => [
                'required', 'string', 'max:255',
            ],
            'status' => [
                'required', 'string', 'max:255',
            ],
        ];
    }
}
