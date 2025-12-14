<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangBelanja extends Model
{
    use HasFactory;

    protected $table = 'keranjang_belanja';
    protected $primaryKey = 'id_keranjang_belanja';
    
    protected $fillable = [
        'kode_pesanan',
        'kode_paket',
        'kode_alat',
        'mulai_peminjaman',
        'selesai_peminjaman'
    ];

    protected $casts = [
        'mulai_peminjaman' => 'date',
        'selesai_peminjaman' => 'date'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'kode_pesanan', 'id_pesanan');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'kode_paket', 'id_paket');
    }

    public function alat()
    {
        return $this->belongsTo(Peralatan::class, 'kode_alat', 'id_alat');
    }
}