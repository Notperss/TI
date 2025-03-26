<?php

namespace App\Http\Requests\Inspection;

use Illuminate\Foundation\Http\FormRequest;

class InspectionUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'job_position_id' => ['required', 'exists:job_positions,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'shift' => ['required', 'string', 'max:255'],
            'date_inspection' => ['required', 'date'],
            'description' => ['nullable'],
            // 'asset_ids' => ['required', 'array'],
            // 'asset_ids.*' => ['exists:goods,id'], // Pastikan setiap ID valid
        ];
    }

    /**
     * Pesan error kustom untuk validasi.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'User wajib dipilih.',
            'user_id.exists' => 'User yang dipilih tidak valid.',

            'job_position_id.required' => 'Posisi pekerjaan wajib dipilih.',
            'job_position_id.exists' => 'Posisi pekerjaan yang dipilih tidak valid.',

            'location_id.required' => 'Lokasi wajib dipilih.',
            'location_id.exists' => 'Lokasi yang dipilih tidak valid.',

            'shift.required' => 'Shift wajib diisi.',
            'shift.string' => 'Shift harus berupa teks.',
            'shift.max' => 'Shift tidak boleh lebih dari 255 karakter.',

            'date_inspection.required' => 'Tanggal inspeksi wajib diisi.',
            'date_inspection.date' => 'Format tanggal inspeksi tidak valid.',
        ];
    }
}
