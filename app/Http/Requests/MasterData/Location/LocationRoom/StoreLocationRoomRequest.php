<?php

namespace App\Http\Requests\MasterData\Location\LocationRoom;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRoomRequest extends FormRequest
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
            'name' => [
                'required', 'string', 'max:255',
            ],
            'location_id' => [
                'required', 'max:255',
            ],
            'sub_location_id' => [
                'required', 'max:255',
            ],
            'stats' => [
                'required', 'max:255',
            ],
        ];
    }
}
