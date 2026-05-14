<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::with('user')->latest()->get();
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'konten'    => 'required',
            'kategori'  => 'required|in:promo,info,event',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('judul', 'konten', 'kategori', 'status');
        $data['user_id'] = Auth::id();
        $data['slug'] = Artikel::generateSlug($request->judul);

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/artikel'), $nama);
            $data['thumbnail'] = $nama;
        }

        Artikel::create($data);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul'     => 'required|string|max:255',
            'konten'    => 'required',
            'kategori'  => 'required|in:promo,info,event',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('judul', 'konten', 'kategori', 'status');

        if ($request->status === 'published' && !$artikel->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/artikel'), $nama);
            $data['thumbnail'] = $nama;
        }

        $artikel->update($data);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate');
    }

    public function destroy($id)
    {
        Artikel::findOrFail($id)->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus');
    }
}
