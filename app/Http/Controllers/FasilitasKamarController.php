<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKamar;
use App\Models\Kamar;
use Illuminate\Http\Request;

class FasilitasKamarController extends Controller
{
    public function index()
    {
        $fasilitasKamars = FasilitasKamar::with('kamar')->get();
        return view('fasilitas-kamar.index', compact('fasilitasKamars'));
    }

    public function create()
    {
        $kamar = Kamar::all();
        return view('fasilitas-kamar.create', compact('kamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'kamar_id'       => 'required|exists:kamar,id',
        ]);

        FasilitasKamar::create($request->all());
        return redirect()->route('fasilitas-kamar.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function show($id)
    {
        $fasilitas = FasilitasKamar::with('kamar')->findOrFail($id);
        return view('fasilitas-kamar.show', compact('fasilitas'));
    }

    public function edit($id)
    {
        $fasilitas = FasilitasKamar::findOrFail($id);
        $kamar = Kamar::all();
        return view('fasilitas-kamar.edit', compact('fasilitas', 'kamar'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = FasilitasKamar::findOrFail($id);

        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'kamar_id'       => 'required|exists:kamar,id',
        ]);

        $fasilitas->update($request->all());
        return redirect()->route('fasilitas-kamar.index')->with('success', 'Fasilitas berhasil diupdate');
    }

    public function destroy($id)
    {
        FasilitasKamar::findOrFail($id)->delete();
        return redirect()->route('fasilitas-kamar.index')->with('success', 'Fasilitas berhasil dihapus');
    }
}