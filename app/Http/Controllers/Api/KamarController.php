<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\JsonResponse;

class KamarController extends Controller
{
    public function index(): JsonResponse
    {
        $kamar = Kamar::with('fasilitas')->get()->map(function ($k) {
            return [
                'id'          => $k->id,
                'nama_kamar'  => $k->nama_kamar,
                'tipe_kamar'  => $k->tipe_kamar,
                'harga'       => $k->harga,
                'deskripsi'   => $k->deskripsi,
                'foto'        => $k->foto ? url('img/kamar/' . $k->foto) : null,
                'fasilitas'   => $k->fasilitas->pluck('nama_fasilitas'),
            ];
        });
        return response()->json(['data' => $kamar]);
    }

    public function show($id): JsonResponse
    {
        $kamar = Kamar::with('fasilitas')->findOrFail($id);
        return response()->json(['data' => [
            'id'         => $kamar->id,
            'nama_kamar' => $kamar->nama_kamar,
            'tipe_kamar' => $kamar->tipe_kamar,
            'harga'      => $kamar->harga,
            'deskripsi'  => $kamar->deskripsi,
            'foto'       => $kamar->foto ? url('img/kamar/' . $kamar->foto) : null,
            'fasilitas'  => $kamar->fasilitas->pluck('nama_fasilitas'),
        ]]);
    }
}