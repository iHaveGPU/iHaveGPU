<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()->id ?? null;

        return [
            // เดิมของ Breeze
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required','string','lowercase','email','max:255',
                Rule::unique('users','email')->ignore($userId),
            ],

            // เพิ่มฟิลด์โปรไฟล์/ที่อยู่
            'phone'     => ['nullable','string','max:20'],
            'line_id'   => ['nullable','string','max:50'],
            'address1'  => ['nullable','string','max:255'],
            'address2'  => ['nullable','string','max:255'],
            'district'  => ['nullable','string','max:120'],
            'province'  => ['nullable','string','max:120'],
            'postcode'  => ['nullable','string','max:10'],

            // ป้องกันผู้ใช้ยกระดับสิทธิ์ตัวเอง
            // (อย่าเปิดให้ส่ง role มาจากฟอร์ม; ถ้าส่งมาก็ตัดทิ้ง)
            'role'      => ['prohibited'],
        ];
    }
}
