<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\PesananConfirmation;
use App\Models\Kamar;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class PesananController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'kamar_id'      => 'required|exists:kamar,id',
            'nama_pemesan'  => 'required|string|max:255',
            'email_pemesan' => 'required|email',
            'hp_pemesan'    => 'required|string|max:20',
            'nama_tamu'     => 'required|string|max:255',
            'cek_in'        => 'required|date|after_or_equal:today',
            'cek_out'       => 'required|date|after:cek_in',
            'jml_kamar'     => 'required|integer|min:1',
        ]);

        $kamar       = Kamar::findOrFail($validated['kamar_id']);
        $jumlahMalam = \Carbon\Carbon::parse($validated['cek_in'])
                        ->diffInDays(\Carbon\Carbon::parse($validated['cek_out']));
        $totalHarga  = $kamar->harga * $validated['jml_kamar'] * $jumlahMalam;

        $pesanan = Pesanan::create([
            ...$validated,
            'total_harga' => $totalHarga,
            'status'      => 'pending',
        ]);

        Mail::to($pesanan->email_pemesan)
            ->send(new PesananConfirmation($pesanan->load('kamar')));

        return response()->json([
            'message' => 'Pesanan berhasil dibuat',
            'data'    => [
                'id'          => $pesanan->id,
                'total_harga' => $totalHarga,
                'status'      => $pesanan->status,
            ],
        ], 201);
    }
}