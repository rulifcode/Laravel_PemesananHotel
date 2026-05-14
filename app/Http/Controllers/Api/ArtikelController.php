<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\JsonResponse;

class ArtikelController extends Controller
{
    public function index(): JsonResponse
    {
        $artikel = Artikel::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get()->map(function ($a) {
                return [
                    'id'           => $a->id,
                    'judul'        => $a->judul,
                    'slug'         => $a->slug,
                    'kategori'     => $a->kategori,
                    'thumbnail'    => $a->thumbnail ? url('img/artikel/' . $a->thumbnail) : null,
                    'published_at' => $a->published_at,
                ];
            });
        return response()->json(['data' => $artikel]);
    }

    public function show($slug): JsonResponse
    {
        $artikel = Artikel::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        return response()->json(['data' => [
            'id'           => $artikel->id,
            'judul'        => $artikel->judul,
            'slug'         => $artikel->slug,
            'konten'       => $artikel->konten,
            'kategori'     => $artikel->kategori,
            'thumbnail'    => $artikel->thumbnail ? url('img/artikel/' . $artikel->thumbnail) : null,
            'published_at' => $artikel->published_at,
        ]]);
    }
}