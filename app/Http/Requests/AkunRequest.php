<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class AkunRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id') ?? ''; // Mengambil id dari route

        return [
            'username' => [
                'required',
                'alpha_num',
                'max:25',
                ValidationRule::unique('akun', 'username')->ignore($id, 'id_akun')
            ],
            'password' => [
                $id ? 'nullable' : 'required',
                'min:8',
            ],
            'level' => [
                'required',
                'in:admin,petugas,peserta',
            ],
        ];
    }
}
