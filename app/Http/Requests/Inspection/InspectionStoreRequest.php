<?php

namespace App\Http\Requests\Inspection;

use App\Models\Inspection\Inspection;
use Illuminate\Foundation\Http\FormRequest;

class InspectionStoreRequest extends FormRequest
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
        // dd($this->all());
        return [
            'user_id' => ['required', 'exists:users,id'],
            'job_position_id' => ['required', 'exists:job_positions,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'sub_location_id' => ['required', 'exists:location_sub,id'],
            'location_room_id' => ['nullable', 'exists:location_room,id'],
            'shift' => ['required', 'string', 'max:255'],
            'date_inspection' => ['required', 'date'],
            'description' => ['nullable', 'string'],
            'file' => 'max:51200',
            // 'assets' => ['required', 'json'], // Pastikan data assets dalam format JSON
            'assets' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $decoded = json_decode($value, true);

                    if (is_null($decoded) || ! is_array($decoded)) {
                        $fail('Format assets harus berupa JSON yang valid.');
                    } elseif (empty($decoded)) {
                        $fail('Daftar assets tidak boleh kosong.');
                    }
                }
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $query = Inspection::where('shift', $this->shift)

                ->where('date_inspection', $this->date_inspection)
                ->when($this->location_room_id, function ($q) {
                    $q->where('location_room_id', $this->location_room_id);
                }, function ($q) {
                    $q->where('sub_location_id', $this->sub_location_id)
                        ->where('location_id', $this->location_id);
                });

            // Cek apakah ini proses update, kalau iya abaikan dirinya sendiri
            if ($this->route('inspection')) {
                $query->where('id', '!=', $this->route('inspection'));
            }

            // Eksekusi query
            if ($query->exists()) {
                $validator->errors()->add('inspection_duplicate', 'Inspeksi dengan shift, lokasi, sub lokasi, dan tanggal ini sudah ada.');
            }
        });
    }


    public function messages(): array
    {
        return [
            'user_id.required' => 'User harus diisi.',
            'job_position_id.required' => 'Posisi pekerjaan wajib diisi.',
            'location_id.required' => 'Lokasi utama wajib diisi.',
            'sub_location_id.required' => 'Sub lokasi wajib diisi.',
            'location_room_id.exists' => 'Lokasi ruangan tidak valid.',
            'shift.required' => 'Shift wajib diisi.',
            'date_inspection.required' => 'Tanggal inspeksi wajib diisi.',
            'date_inspection.date' => 'Format tanggal tidak valid.',
            'assets.required' => 'Assets wajib diisi.',
            'assets.json' => 'Format assets harus berupa JSON yang valid.',
        ];
    }
}
