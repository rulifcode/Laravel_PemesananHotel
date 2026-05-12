<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with('kamar')->get(); // ubah $pesanan → $pesanans
        return view('pesanan.index', compact('pesanans')); // ubah 'pesanan' → 'pesanans'
    }

    public function create()
    {
        $kamar = Kamar::all();
        return view('pesanan.create', compact('kamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cek_in'        => 'required|date',
            'cek_out'       => 'required|date|after:cek_in',
            'jml_kamar'     => 'required|integer',
            'nama_pemesan'  => 'required',
            'email_pemesan' => 'required|email',
            'hp_pemesan'    => 'required',
            'nama_tamu'     => 'required',
            'kamar_id'      => 'required|exists:kamar,id',
        ]);

        Pesanan::create($request->all());
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan');
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('kamar')->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }

    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $kamar = Kamar::all();
        return view('pesanan.edit', compact('pesanan', 'kamar'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $request->validate([
            'cek_in'        => 'required|date',
            'cek_out'       => 'required|date|after:cek_in',
            'jml_kamar'     => 'required|integer',
            'nama_pemesan'  => 'required',
            'email_pemesan' => 'required|email',
            'hp_pemesan'    => 'required',
            'nama_tamu'     => 'required',
            'kamar_id'      => 'required|exists:kamar,id',
        ]);

        $pesanan->update($request->all());
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate');
    }

    public function destroy($id)
    {
        Pesanan::findOrFail($id)->delete();
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => $request->status]);
        return redirect()->route('pesanan.index')->with('success', 'Status berhasil diupdate');
    }
}
