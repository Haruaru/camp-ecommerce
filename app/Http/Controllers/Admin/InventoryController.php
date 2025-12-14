<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peralatan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Peralatan::with('kategori');

        if ($request->has('search')) {
            $query->where('nama_alat', 'like', '%' . $request->search . '%');
        }

        $peralatans = $query->paginate(12);
        $kategoris = Kategori::all();

        return view('admin.inventory.index', compact('peralatans', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.inventory.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:100',
            'kode_kategori' => 'required|exists:kategori,id_kategori',
            'deskripsi_alat' => 'nullable|string',
            'stok_alat' => 'required|integer|min:0',
            'harga_alat' => 'required|integer|min:0',
            'gambar_alat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            
        ]);

        $data = $request->except('gambar_alat');

        if ($request->hasFile('gambar_alat')) {
            $data['gambar_alat'] = $request->file('gambar_alat')->store('peralatan', 'public');
        }

        Peralatan::create($data);

        return redirect()->route('admin.inventory.index')->with('success', 'Peralatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $alat = Peralatan::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.inventory.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:100',
            'kode_kategori' => 'required|exists:kategori,id_kategori',
            'deskripsi_alat' => 'nullable|string',
            'stok_alat' => 'required|integer|min:0',
            'harga_alat' => 'required|integer|min:0',
            'gambar_alat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $alat = Peralatan::findOrFail($id);
        $data = $request->except('gambar_alat');

        if ($request->hasFile('gambar_alat')) {
            if ($alat->gambar_alat) {
                Storage::disk('public')->delete($alat->gambar_alat);
            }
            $data['gambar_alat'] = $request->file('gambar_alat')->store('peralatan', 'public');
        }

        $alat->update($data);

        return redirect()->route('admin.inventory.index')->with('success', 'Peralatan berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = Peralatan::findOrFail($id);
        
        if ($alat->gambar_alat) {
            Storage::disk('public')->delete($alat->gambar_alat);
        }

        $alat->delete();

        return redirect()->route('admin.inventory.index')->with('success', 'Peralatan berhasil dihapus');
    }
}