<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
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

            'hadir' => [
                'required', 'max:255'
            ],
            'sakit' => [
                'required', 'max:255'
            ],
            'izin' => [
                'required', 'max:255'
            ],
            'absen' => [
                'required', 'max:255'
            ],
            'cuti' => [
                'required', 'max:255'
            ],
            'file' => [
                'mimes:png,jpg,pdf',
            ],
            'tanggal' => [
                'required', 'max:255'
            ],
            'keterangan' => [
                'max:255',
            ],
        ];
    }
}
