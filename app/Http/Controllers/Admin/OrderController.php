<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\KeranjangBelanja;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with('keranjangBelanja.paket', 'keranjangBelanja.alat');

        if ($request->has('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $pesanans = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.orders.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('keranjangBelanja.paket', 'keranjangBelanja.alat')->findOrFail($id);
        return view('admin.orders.show', compact('pesanan'));
    }
}