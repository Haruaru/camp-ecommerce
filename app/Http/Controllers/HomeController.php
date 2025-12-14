<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Peralatan;
use App\Models\Paket;
use App\Models\Promo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $pakets = Paket::with(['peralatan', 'status'])->take(6)->get();
        $promos = Promo::all();
        
        return view('user.home', compact('kategoris', 'pakets', 'promos'));
    }

    public function detailAlat($id)
    {
        $alat = Peralatan::with('kategori')->findOrFail($id);
        return view('user.detail-alat', compact('alat'));
    }

    public function detailPaket($id)
    {
        $paket = Paket::with(['peralatan', 'status'])->findOrFail($id);
        return view('user.detail-paket', compact('paket'));
    }

    public function katalogPaket()
    {
        $pakets = Paket::with(['peralatan', 'status'])->paginate(12);
        return view('user.katalog-paket', compact('pakets'));
    }

    public function katalogPeralatan(Request $request)
    {
        $query = Peralatan::with('kategori')->where('stok_alat', '>', 0);
        
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kode_kategori', $request->kategori);
        }
        
        $peralatans = $query->paginate(12);
        $kategoris = Kategori::all();
        
        return view('user.katalog-peralatan', compact('peralatans', 'kategoris'));
    }

    public function tentangKami()
    {
        return view('user.tentang-kami');
    }
    
    // NEW: Halaman Kebijakan & Proses
    public function kebijakanPrivasi()
    {
        return view('user.kebijakan-privasi');
    }
    
    public function syaratKetentuan()
    {
        return view('user.syarat-ketentuan');
    }
    
    public function kebijakanPeminjaman()
    {
        return view('user.kebijakan-peminjaman');
    }
    
    public function prosesPembayaran()
    {
        return view('user.proses-pembayaran');
    }
    
    public function prosesPengambilan()
    {
        return view('user.proses-pengambilan');
    }
}