<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsensiKaryawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    // Admin: rekap semua karyawan
    public function index(Request $request)
    {
        $tanggal = $request->tanggal ?? today()->toDateString();
        $absensis = AbsensiKaryawan::with('user')
            ->where('tanggal', $tanggal)
            ->latest()
            ->get();
        $users = User::all();
        return view('admin.absensi.index', compact('absensis', 'tanggal', 'users'));
    }

    // Semua role: clock-in
    public function masuk(Request $request)
    {
        $today = today()->toDateString();
        $userId = Auth::id();

        $existing = AbsensiKaryawan::where('user_id', $userId)
            ->where('tanggal', $today)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah absen masuk hari ini');
        }

        AbsensiKaryawan::create([
            'user_id'   => $userId,
            'tanggal'   => $today,
            'jam_masuk' => now()->format('H:i:s'),
            'status'    => 'hadir',
        ]);

        return redirect()->back()->with('success', 'Absen masuk berhasil: ' . now()->format('H:i'));
    }

    // Semua role: clock-out
    public function keluar(Request $request)
    {
        $today = today()->toDateString();
        $absensi = AbsensiKaryawan::where('user_id', Auth::id())
            ->where('tanggal', $today)
            ->first();

        if (!$absensi) {
            return redirect()->back()->with('error', 'Anda belum absen masuk hari ini');
        }

        if ($absensi->jam_keluar) {
            return redirect()->back()->with('error', 'Anda sudah absen keluar hari ini');
        }

        $absensi->update(['jam_keluar' => now()->format('H:i:s')]);
        return redirect()->back()->with('success', 'Absen keluar berhasil: ' . now()->format('H:i'));
    }

    // Semua role: riwayat absensi sendiri
    public function saya()
    {
        $absensis = AbsensiKaryawan::where('user_id', Auth::id())
            ->latest('tanggal')
            ->get();
        return view('admin.absensi.saya', compact('absensis'));
    }
}
