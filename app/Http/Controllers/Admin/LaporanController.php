<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Kamar;
use App\Models\User;
use App\Models\AbsensiKaryawan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->format('Y-m');
        [$tahun, $bln] = explode('-', $bulan);

        $pesanans = Pesanan::with('kamar')
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bln)
            ->get();

        $totalPendapatan = $pesanans->where('status', 'confirmed')->sum('total_harga');
        $totalPesanan    = $pesanans->count();
        $pesananPending  = $pesanans->where('status', 'pending')->count();
        $pesananConfirmed = $pesanans->where('status', 'confirmed')->count();
        $pesananCancelled = $pesanans->where('status', 'cancelled')->count();

        $totalKamar = Kamar::count();
        $totalUser  = User::count();

        return view('admin.laporan.index', compact(
            'pesanans', 'bulan', 'totalPendapatan',
            'totalPesanan', 'pesananPending',
            'pesananConfirmed', 'pesananCancelled',
            'totalKamar', 'totalUser'
        ));
    }
}
