<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Kamar;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with('kamar')->get();
        return view('pesanan.index', compact('pesanans'));
    }

    public function create()
    {
        $kamars = Kamar::all();
        return view('pesanan.create', compact('kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cek_in'        => 'required|date',
            'cek_out'       => 'required|date|after:cek_in',
            'jml_kamar'     => 'required|integer|min:1',
            'nama_pemesan'  => 'required',
            'email_pemesan' => 'required|email',
            'hp_pemesan'    => 'required',
            'nama_tamu'     => 'required',
            'kamar_id'      => 'required|exists:kamar,id',
        ]);

        $kamar       = Kamar::findOrFail($request->kamar_id);
        $jumlahMalam = \Carbon\Carbon::parse($request->cek_in)
                        ->diffInDays(\Carbon\Carbon::parse($request->cek_out));
        $totalHarga  = $kamar->harga * $request->jml_kamar * $jumlahMalam;

        Pesanan::create([
            ...$request->all(),
            'total_harga' => $totalHarga,
            'status'      => 'pending',
        ]);

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan');
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('kamar')->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }

    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $kamars  = Kamar::all();
        return view('pesanan.edit', compact('pesanan', 'kamars'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $request->validate([
            'cek_in'        => 'required|date',
            'cek_out'       => 'required|date|after:cek_in',
            'jml_kamar'     => 'required|integer|min:1',
            'nama_pemesan'  => 'required',
            'email_pemesan' => 'required|email',
            'hp_pemesan'    => 'required',
            'nama_tamu'     => 'required',
            'kamar_id'      => 'required|exists:kamar,id',
        ]);

        $kamar       = Kamar::findOrFail($request->kamar_id);
        $jumlahMalam = \Carbon\Carbon::parse($request->cek_in)
                        ->diffInDays(\Carbon\Carbon::parse($request->cek_out));
        $totalHarga  = $kamar->harga * $request->jml_kamar * $jumlahMalam;

        $pesanan->update([
            ...$request->all(),
            'total_harga' => $totalHarga,
        ]);

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil diupdate');
    }

    public function destroy($id)
    {
        Pesanan::findOrFail($id)->delete();
        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => $request->status]);
        return redirect()->route('pesanan.index')
            ->with('success', 'Status berhasil diupdate');
    }
}