<?php

namespace App\Http\Requests\ManagementAccess\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'nik' => [
                'required', 'string', 'max:50', 'unique:detail_user,nik', Rule::unique('detail_user'),
            ],
            'name' => [
                'required', 'string', 'max:255',
            ],
            'password' => [
                'required', 'string', 'max:255',
            ],
            'job_position' => [
                'required', 'string', 'max:255',
            ],
            'type_user_id' => [
                'required', 'string', 'max:255',
            ],
            'status' => [
                'required', 'string', 'max:255',
            ],
            'icon' => [
                'mimes:png,jpg,jpeg',
            ],
            'email' => [
                'required', 'unique:users,email', Rule::unique('users'),
            ],
            // add validation for role this here
        ];
    }
}
