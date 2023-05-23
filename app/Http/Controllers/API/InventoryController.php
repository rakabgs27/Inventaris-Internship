<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryStoreRequest;
use App\Http\Requests\InventoryUpdateRequest;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use Illuminate\Http\Response;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::all();
        $message = 'Data Inventaris Berhasil Ditemukan';

        return response()->json([
            'status' => true,
            'data' => InventoryResource::collection($inventory),
            'message' => $message,
        ], Response::HTTP_OK);
    }

    public function store(InventoryStoreRequest $request)
    {
        $inventory = Inventory::where('nama_barang', $request->nama_barang)->first();
        $message = 'Data Inventaris Berhasil Ditambahkan';

        if ($inventory) {
            $inventory->jumlah += $request->jumlah;
            $inventory->save();

            return response()->json([
                'status' => true,
                'data' => new InventoryResource($inventory),
                'message' => $message,
            ], Response::HTTP_OK);
        }

        $inventory = Inventory::create($request->validated());
        return response()->json([
            'status' => true,
            'data' => new InventoryResource($inventory),
            'message' => $message,
        ], Response::HTTP_OK);
    }


    public function show(Inventory $inventory)
    {
        $message = 'Data Inventaris Berhasil Ditemukan';
        return response()->json([
            'status' => true,
            'data' => new InventoryResource($inventory),
            'message' => $message,
        ], Response::HTTP_OK);
    }

    public function update(InventoryUpdateRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());
        $message = 'Inventaris Berhasil Diperbarui';

        return response()->json([
            'status' => true,
            'data' => new InventoryResource($inventory),
            'message' => $message,
        ], Response::HTTP_OK);
    }


    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        $message = 'Inventaris Berhasil Dihapus';

        return response()->json([
            'status' => true,
            'data' => null,
            'message' => $message,
        ], Response::HTTP_OK);
    }
}
