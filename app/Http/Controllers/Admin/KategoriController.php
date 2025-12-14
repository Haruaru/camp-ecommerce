<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('peralatan')->paginate(10);
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label_kategori' => 'required|string|max:100',
            'gambar_kategori' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only('label_kategori');

        if ($request->hasFile('gambar_kategori')) {
            $data['gambar_kategori'] = $request->file('gambar_kategori')->store('kategori', 'public');
        }

        Kategori::create($data);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'label_kategori' => 'required|string|max:100',
            'gambar_kategori' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $kategori = Kategori::findOrFail($id);
        $data = $request->only('label_kategori');

        if ($request->hasFile('gambar_kategori')) {
            if ($kategori->gambar_kategori) {
                Storage::disk('public')->delete($kategori->gambar_kategori);
            }
            $data['gambar_kategori'] = $request->file('gambar_kategori')->store('kategori', 'public');
        }

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        if ($kategori->gambar_kategori) {
            Storage::disk('public')->delete($kategori->gambar_kategori);
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}