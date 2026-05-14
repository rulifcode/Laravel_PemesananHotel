<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\JsonResponse;

class GaleriController extends Controller
{
    public function index(): JsonResponse
    {
        $galeri = Galeri::all()->map(function ($g) {
            return [
                'id'    => $g->id,
                'judul' => $g->judul,
                'foto'  => $g->foto ? url('img/galeri/' . $g->foto) : null,
            ];
        });
        return response()->json(['data' => $galeri]);
    }
}