<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peralatan;
use App\Models\Pesanan;
use App\Models\KeranjangBelanja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        // PASTIKAN USER SUDAH LOGIN
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $totalProduk = Peralatan::count();
        $totalPesanan = Pesanan::count();
        $totalPendapatan = KeranjangBelanja::with(['paket', 'alat'])
            ->get()
            ->sum(function($item) {
                return $item->paket ? $item->paket->harga_paket : ($item->alat ? $item->alat->harga_alat : 0);
            });

        return view('admin.dashboard', compact('totalProduk', 'totalPesanan', 'totalPendapatan'));
    }
}