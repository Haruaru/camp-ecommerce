<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KeranjangBelanja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->get('periode', 'month'); // day, week, month
        
        $totalTransaksi = KeranjangBelanja::count();
        
        $topSeller = KeranjangBelanja::select('kode_alat')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('kode_alat')
            ->orderBy('total', 'desc')
            ->with('alat')
            ->first();

        $pendapatan = KeranjangBelanja::with(['paket', 'alat'])
            ->get()
            ->sum(function($item) {
                return $item->paket ? $item->paket->harga_paket : ($item->alat ? $item->alat->harga_alat : 0);
            });

        // Data untuk chart berdasarkan periode
        if ($periode == 'day') {
            $chartData = $this->getDailyData();
        } elseif ($periode == 'week') {
            $chartData = $this->getWeeklyData();
        } else {
            $chartData = $this->getMonthlyData();
        }

        return view('admin.reporting.index', compact('totalTransaksi', 'topSeller', 'pendapatan', 'chartData', 'periode'));
    }

    private function getDailyData()
    {
        // Implementasi untuk data harian
        return [];
    }

    private function getWeeklyData()
    {
        // Implementasi untuk data mingguan
        return [];
    }

    private function getMonthlyData()
    {
        return KeranjangBelanja::selectRaw('MONTH(created_at) as bulan, SUM(1) as total')
            ->groupBy('bulan')
            ->get();
    }
}