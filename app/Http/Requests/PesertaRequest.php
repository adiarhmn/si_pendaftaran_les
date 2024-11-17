<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesertaRequest extends FormRequest
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
            'username' => [
                'required',
                'alpha_num',
                'max:50',
                'unique:akun,username,' . $id . ',id_akun',
            ],
            'password' => [
                $id ? 'nullable' : 'required',
                'min:8',
            ],
            'nama_peserta' => [
                'required',
                'max:50',
            ],
            'telp' => [
                'required',
                'numeric',
                'digits_between:10,13',
                'unique:peserta,telp,' . $id . ',id_peserta',

            ],
            'alamat' => [
                'required',
                'max:100',
            ],
            
        ];
    }
}
