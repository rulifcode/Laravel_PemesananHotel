<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index() { return view('admin.artikel.index'); }
    public function create() { return view('admin.artikel.create'); }
    public function store(Request $request) {}
    public function edit($id) { return view('admin.artikel.edit'); }
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
