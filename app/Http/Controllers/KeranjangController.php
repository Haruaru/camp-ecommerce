<?php
namespace App\Http\Controllers;

use App\Models\KeranjangBelanja;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    public function index()
    {
        $pesananId = Session::get('pesanan_id');
        
        if (!$pesananId) {
            return view('user.keranjang', ['items' => collect()]);
        }

        $items = KeranjangBelanja::with(['paket', 'alat'])
            ->where('kode_pesanan', $pesananId)
            ->get();

        return view('user.keranjang', compact('items'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:paket,alat',
            'id' => 'required|integer',
            'mulai_peminjaman' => 'required|date',
            'selesai_peminjaman' => 'required|date|after:mulai_peminjaman'
        ]);

        $pesananId = Session::get('pesanan_id');
        
        if (!$pesananId) {
            $pesanan = Pesanan::create([
                'id_pesanan' => time(),
                'indeks_pesanan' => 1
            ]);
            Session::put('pesanan_id', $pesanan->id_pesanan);
            $pesananId = $pesanan->id_pesanan;
        }

        $data = [
            'kode_pesanan' => $pesananId,
            'mulai_peminjaman' => $request->mulai_peminjaman,
            'selesai_peminjaman' => $request->selesai_peminjaman,
        ];

        if ($request->tipe == 'paket') {
            $data['kode_paket'] = $request->id;
        } else {
            $data['kode_alat'] = $request->id;
        }

        KeranjangBelanja::create($data);

        return redirect()->route('keranjang.index')->with('success', 'Item berhasil ditambahkan ke keranjang');
    }

    public function hapus($id)
    {
        $item = KeranjangBelanja::findOrFail($id);
        $item->delete();

        return redirect()->route('keranjang.index')->with('success', 'Item berhasil dihapus dari keranjang');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa'
        ]);

        $pesananId = Session::get('pesanan_id');
        
        if (!$pesananId) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong');
        }

        // Update semua item dengan tanggal yang sama
        KeranjangBelanja::where('kode_pesanan', $pesananId)
            ->update([
                'mulai_peminjaman' => $request->tanggal_sewa,
                'selesai_peminjaman' => $request->tanggal_kembali
            ]);

        // Proses pembayaran di sini
        Session::forget('pesanan_id');

        return redirect()->route('home')->with('success', 'Pesanan berhasil diproses');
    }
}
