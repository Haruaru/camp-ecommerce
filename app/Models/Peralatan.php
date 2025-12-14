<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;

    protected $table = 'peralatan';
    protected $primaryKey = 'id_alat';
    
    protected $fillable = [
        'nama_alat',
        'kode_kategori',
        'gambar_alat',
        'deskripsi_alat',
        'stok_alat',
        'harga_alat'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kode_kategori', 'id_kategori');
    }

    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'paket_dan_peralatan', 'kode_alat', 'kode_paket');
    }

    public function keranjangBelanja()
    {
        return $this->hasMany(KeranjangBelanja::class, 'kode_alat', 'id_alat');
    }
}