<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan')->get();
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'   => 'nullable|url',
            'urutan' => 'nullable|integer',
        ]);

        $file = $request->file('gambar');
        $nama = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img/banner'), $nama);

        Banner::create([
            'judul'  => $request->judul,
            'gambar' => $nama,
            'link'   => $request->link,
            'aktif'  => true,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'judul'  => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'   => 'nullable|url',
            'urutan' => 'nullable|integer',
        ]);

        $data = $request->only('judul', 'link', 'urutan');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/banner'), $nama);
            $data['gambar'] = $nama;
        }

        $banner->update($data);
        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diupdate');
    }

    public function toggle($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['aktif' => !$banner->aktif]);
        return redirect()->route('admin.banner.index')->with('success', 'Status banner berhasil diubah');
    }

    public function destroy($id)
    {
        Banner::findOrFail($id)->delete();
        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus');
    }
}
