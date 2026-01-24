<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    // 1. Ubah jadi true agar user boleh akses
    public function authorize(): bool
    {
        return true; 
    }

    // 2. Pindahkan rules dari Controller ke sini
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,completed',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }

    // 3. Tambahkan pesan error kustom (Bahasa Indonesia)
    public function messages(): array
    {
        return [
            'title.required' => 'Judul tugas wajib diisi, ya!',
            'title.max' => 'Judul tugas jangan lebih dari 255 karakter.',
            'status.in' => 'Status yang dipilih tidak valid (pilih: pending, in_progress, atau completed).',
            'category_id.exists' => 'Kategori yang Anda pilih tidak ditemukan di database.',
        ];
    }
}