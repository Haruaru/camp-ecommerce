<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';
    protected $primaryKey = 'id_status';
    
    protected $fillable = [
        'status_ketersediaan'
    ];

    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'status_ketersediaan_paket', 'kode_status', 'kode_paket');
    }
}