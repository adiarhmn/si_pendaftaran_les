<?php

namespace App\Http\Requests;

use App\Models\PesertaModel;
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
        $id_peserta = $this->route('id') ?? '';
        $peserta = PesertaModel::find($id_peserta);
        return [
            'username' => [
                'required',
                'alpha_num',
                'max:50',
                'unique:akun,username,' . $peserta->id_akun . ',id_akun',
            ],
            'password' => [
                $id_peserta ? 'nullable' : 'required',
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
                'unique:peserta,telp,' . $id_peserta . ',id_peserta',

            ],
            'alamat' => [
                'required',
                'max:100',
            ],
            
        ];
    }
}
