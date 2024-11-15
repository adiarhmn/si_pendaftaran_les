<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KursusRequest extends FormRequest
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
        $id = $this->route('id') ?? null;
        return [
            'nama_kursus' => [
                'required',
                'max:50',
            ],
            'deskripsi' => [
                'required',
                'max:255',
            ],
            'harga'=> [
                'required',
                'numeric',
                'min:0',
            ],
            'durasi' => [
                'required',
                'numeric',
                'min:0',
            ],
            'tanggal_mulai' => [
                'required',
                'date',
            ],
            'tanggal_selesai' => [
                'required',
                'date',
            ],
            'jumlah_peserta' => [
                'required',
                'numeric',
                'min:0',
            ],
            'gambar_cover' => [
                $id ? 'nullable' : 'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ],
        ];
    }
}