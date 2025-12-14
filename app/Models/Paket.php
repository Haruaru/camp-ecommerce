<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'id_paket';
    
    protected $fillable = [
        'nama_paket',
        'harga_paket'
    ];

    public function peralatan()
    {
        return $this->belongsToMany(Peralatan::class, 'paket_dan_peralatan', 'kode_paket', 'kode_alat');
    }

    public function keranjangBelanja()
    {
        return $this->hasMany(KeranjangBelanja::class, 'kode_paket', 'id_paket');
    }

    public function status()
    {
        return $this->belongsToMany(Status::class, 'status_ketersediaan_paket', 'kode_paket', 'kode_status');
    }
}