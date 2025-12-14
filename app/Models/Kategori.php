<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    
    protected $fillable = [
        'label_kategori',
        'gambar_kategori'
    ];

    public function peralatan()
    {
        return $this->hasMany(Peralatan::class, 'kode_kategori', 'id_kategori');
    }
}