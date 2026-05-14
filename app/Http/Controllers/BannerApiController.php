<?php
namespace App\Http\Controllers;

use App\Models\Banner;

class BannerApiController extends Controller
{
    public function index()
    {
        $banners = Banner::where('aktif', true)
            ->orderBy('urutan')
            ->get()
            ->map(function ($b) {
                return [
                    'id'    => $b->id,
                    'judul' => $b->judul,
                    'media' => $b->media,
                    'tipe'  => $b->tipe,
                    'src'   => asset('img/banner/' . $b->media),
                    'link'  => $b->link,
                ];
            });

        return response()->json(['data' => $banners]);
    }
}