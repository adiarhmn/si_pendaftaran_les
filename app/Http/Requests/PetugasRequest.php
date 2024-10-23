<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetugasRequest extends FormRequest
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
        $id = $this->route('id') ?? '';
        return [
            'nama_petugas' => [
                'required',
                'max:50',
            ],
            'telp' => [
                'required',
                'numeric',
                'digits_between:10,16',
                'unique:petugas,telp,' . $id . ',id_petugas',
            ],
            'alamat' => [
                'required',
                'max:100',
            ],
            'id_akun' => [
                'required',
                'exists:akun,id_akun',
                'unique:petugas,id_akun,' . $id . ',id_petugas',
            ],
        ];
    }
}
