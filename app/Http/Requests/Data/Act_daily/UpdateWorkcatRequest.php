<?php

namespace App\Http\Requests\Data\Act_daily;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkcatRequest extends FormRequest
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
            'id' => [
                'required',
            ],
            'job_type' => [
                'required', 'string', 'max:255',
            ],
        ];
    }
}
