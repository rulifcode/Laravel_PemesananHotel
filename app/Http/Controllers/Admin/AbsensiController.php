<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index() { return view('admin.absensi.index'); }
    public function masuk(Request $request) {}
    public function keluar(Request $request) {}
    public function saya() { return view('admin.absensi.saya'); }
}
