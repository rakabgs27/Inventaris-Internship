<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'nama_barang' => 'required|regex:/^[A-zA-Z\s]+$/u',
            'harga' => 'required|integer|min:1',
            'jumlah' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'nama_barang.required' => 'Nama Barang Wajib Diisi',
            'nama_barang.regex' => 'Nama Barang Wajib Huruf Alphabet',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.integer' => 'Harga Wajib Angka',
            'harga.min' => 'Harga Minimal 1 Digit',
            'jumlah.required' => 'Jumlah Wajib Diisi',
            'jumlah.integer' => 'Jumlah Wajib Angka',
            'jumlah.min' => 'Jumlah Minimal 1 Digit',

        ];
    }
}
