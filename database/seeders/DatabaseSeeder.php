<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Peralatan;
use App\Models\Paket;
use App\Models\Status;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@xadventure.com',
            'password' => bcrypt('password123'),
        ]);

        // Create Categories
        $categories = [
            ['label_kategori' => 'Tenda'],
            ['label_kategori' => 'Bawaan'],
            ['label_kategori' => 'Alat Tidur'],
            ['label_kategori' => 'Alat Masak'],
            ['label_kategori' => 'Penerangan'],
        ];

        foreach ($categories as $category) {
            Kategori::create($category);
        }

        // Create Equipment
        $equipment = [
            [
                'nama_alat' => 'Tenda 3-4 Double Layer',
                'kode_kategori' => 1,
                'deskripsi_alat' => 'Tenda untuk 3-4 orang dengan double layer',
                'stok_alat' => 10,
                'harga_alat' => 35000,
            ],
            [
                'nama_alat' => 'Carrier 30L-45L',
                'kode_kategori' => 2,
                'deskripsi_alat' => 'Tas carrier kapasitas 30-45 liter',
                'stok_alat' => 15,
                'harga_alat' => 35000,
            ],
            [
                'nama_alat' => 'Sleeping Bag',
                'kode_kategori' => 3,
                'deskripsi_alat' => 'Sleeping bag hangat dan nyaman',
                'stok_alat' => 20,
                'harga_alat' => 15000,
            ],
            [
                'nama_alat' => 'Kompor Portable',
                'kode_kategori' => 4,
                'deskripsi_alat' => 'Kompor portable untuk camping',
                'stok_alat' => 12,
                'harga_alat' => 25000,
            ],
            [
                'nama_alat' => 'Headlamp',
                'kode_kategori' => 5,
                'deskripsi_alat' => 'Lampu kepala LED terang',
                'stok_alat' => 25,
                'harga_alat' => 15000,
            ],
        ];

        foreach ($equipment as $item) {
            Peralatan::create($item);
        }

        // Create Packages
        $packages = [
            ['nama_paket' => 'Paket Grill', 'harga_paket' => 35000],
            ['nama_paket' => 'Paket Anak Senja', 'harga_paket' => 35000],
            ['nama_paket' => 'Paket Camper Keluarga', 'harga_paket' => 35000],
        ];

        foreach ($packages as $package) {
            Paket::create($package);
        }

        // Create Status
        Status::create(['status_ketersediaan' => 'Available']);
        Status::create(['status_ketersediaan' => 'Unavailable']);

        // Link packages with equipment
        $paket1 = Paket::find(1);
        $paket1->peralatan()->attach([1, 4]); // Tenda + Kompor

        $paket2 = Paket::find(2);
        $paket2->peralatan()->attach([3, 5]); // Sleeping Bag + Headlamp

        $paket3 = Paket::find(3);
        $paket3->peralatan()->attach([1, 2, 3]); // Tenda + Carrier + Sleeping Bag

        // Link packages with status
        $paket1->status()->attach(1); // Available
        $paket2->status()->attach(2); // Unavailable
        $paket3->status()->attach(1); // Available
    }
}