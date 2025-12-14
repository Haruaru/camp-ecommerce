<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Peralatan;
use App\Models\Status;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::with('peralatan', 'status')->paginate(10);
        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        $peralatans = Peralatan::all();
        $statuses = Status::all();
        return view('admin.paket.create', compact('peralatans', 'statuses'));
    }

    public function store(Request $request)
    {
       // Validasi
    $validated = $request->validate([
        'nama_paket' => 'required|string|max:100',
        'harga_paket' => 'required|integer|min:0',
        'peralatan_ids' => 'required|array|min:1',
        'peralatan_ids.*' => 'exists:peralatan,id_alat',
        'status_id' => 'required|exists:status,id_status'
    ], [
        'nama_paket.required' => 'Nama paket harus diisi',
        'harga_paket.required' => 'Harga paket harus diisi',
        'harga_paket.min' => 'Harga tidak boleh kurang dari 0',
        'peralatan_ids.required' => 'Pilih minimal 1 peralatan',
        'peralatan_ids.min' => 'Pilih minimal 1 peralatan',
        'status_id.required' => 'Status harus dipilih'
    ]);

    // Buat paket
    $paket = Paket::create([
        'nama_paket' => $request->nama_paket,
        'harga_paket' => $request->harga_paket
    ]);

    // Attach peralatan ke paket
    $paket->peralatan()->attach($request->peralatan_ids);

    // Attach status ke paket
    $paket->status()->attach($request->status_id);

    return redirect()->route('admin.paket.index')
        ->with('success', 'Paket "' . $paket->nama_paket . '" berhasil ditambahkan!');
}
    public function edit($id)
    {
        $paket = Paket::with('peralatan', 'status')->findOrFail($id);
        $peralatans = Peralatan::all();
        $statuses = Status::all();
        return view('admin.paket.edit', compact('paket', 'peralatans', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:100',
            'harga_paket' => 'required|integer|min:0',
            'peralatan_ids' => 'required|array|min:1',
            'peralatan_ids.*' => 'exists:peralatan,id_alat',
            'status_id' => 'required|exists:status,id_status'
        ]);

        $paket = Paket::findOrFail($id);
        
        $paket->update([
            'nama_paket' => $request->nama_paket,
            'harga_paket' => $request->harga_paket
        ]);

        // Sync peralatan
        $paket->peralatan()->sync($request->peralatan_ids);

        // Sync status
        $paket->status()->sync([$request->status_id]);

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diupdate');
    }

    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dihapus');
    }
}