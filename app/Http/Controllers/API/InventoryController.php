<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Inventory;

class InventoryController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addInventory(Request $request)
    {
        // Validasi inputan inventaris
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'harga' => 'required|integer|min:1',
            'jumlah' => 'required|integer|min:1',

        ]);

        // Jika validasi gagal, kirim respon error
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        // Cek apakah barang sudah ada di inventaris
        $inventory = Inventory::where('nama_barang', $request->nama_barang)->first();

        if ($inventory) {
            // Jika barang sudah ada, tambahkan stok
            $inventory->jumlah += $request->jumlah;
            $inventory->save();
        } else {
            // Jika barang belum ada, tambahkan data baru
            $inventory = Inventory::create([
                'nama_barang' => $request->nama_barang,
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $inventory->id,
            'message' => 'Inventaris berhasil ditambahkan',
        ], 200);
    }

    public function updateInventory(Request $request, $id)
    {
        // Validasi inputan inventaris yang diubah
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'harga' => 'required|integer|min:0',
            'jumlah' => 'required|integer|min:0',
        ]);

        // Jika validasi gagal, kirim respon error
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        // Cari data inventaris berdasarkan ID
        $inventory = Inventory::find($id);

        if ($inventory) {
            // Jika inventaris ditemukan, update data inventaris
            $inventory->nama_barang = $request->nama_barang;
            $inventory->harga = $request->harga;
            $inventory->jumlah = $request->jumlah;
            $inventory->save();

            return response()->json([
                'status' => true,
                'data' => $inventory->id,
                'message' => 'Inventaris berhasil diperbarui',
            ], 200);
        }

        // Jika inventaris tidak ditemukan, kirim respon error
        return response()->json([
            'status' => false,
            'data' => null,
            'message' => 'Inventaris tidak ditemukan',
        ], 404);
    }

    public function deleteInventory($id)
    {
        // Cari data inventaris berdasarkan ID
        $inventory = Inventory::find($id);

        if ($inventory) {
            // Jika inventaris ditemukan, hapus data inventaris
            $inventory->delete();

            return response()->json([
                'status' => true,
                'data' => null,
                'message' => 'Inventaris berhasil dihapus',
            ], 200);
        }

        // Jika inventaris tidak ditemukan, kirim respon error
        return response()->json([
            'status' => false,
            'data' => null,
            'message' => 'Inventaris tidak ditemukan',
        ], 404);
    }
}
