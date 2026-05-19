<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:255'],
            'email'  => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'bio'    => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Custom error messages (optional).
     */
    public function messages(): array
    {
        return [
            'name.required'   => 'Nama wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'email.unique'    => 'Email sudah digunakan oleh akun lain.',
            'avatar.image'    => 'File avatar harus berupa gambar.',
            'avatar.max'      => 'Ukuran avatar maksimal 2MB.',
            'bio.max'         => 'Bio maksimal 500 karakter.',
        ];
    }
}