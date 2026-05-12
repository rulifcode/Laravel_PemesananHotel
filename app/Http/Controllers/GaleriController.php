<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::all();
        return view('galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = $request->file('foto');
        $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('img/galeri'), $namaFoto);

        Galeri::create([
            'keterangan' => $request->keterangan,
            'foto' => $namaFoto,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Foto berhasil ditambahkan');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $data = ['keterangan' => $request->keterangan];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('img/galeri'), $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $galeri->update($data);
        return redirect()->route('galeri.index')->with('success', 'Foto berhasil diupdate');
    }

    public function destroy($id)
    {
        Galeri::findOrFail($id)->delete();
        return redirect()->route('galeri.index')->with('success', 'Foto berhasil dihapus');
    }
}