<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventory::create([
            'nama_barang' => 'Barang Merk A',
            'harga' => 20000,
            'jumlah' => 10,
        ]);

        Inventory::create([
            'nama_barang' => 'Barang Merk B',
            'harga' => 30000,
            'jumlah' => 5,
        ]);

        Inventory::create([
            'nama_barang' => 'Barang Merk C',
            'harga' => 30000,
            'jumlah' => 7,
        ]);
    }
}
