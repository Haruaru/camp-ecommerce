<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $incrementing = false;
    
    protected $fillable = [
        'id_pesanan',
        'indeks_pesanan'
    ];

    public function keranjangBelanja()
    {
        return $this->hasMany(KeranjangBelanja::class, 'kode_pesanan', 'id_pesanan');
    }
}
