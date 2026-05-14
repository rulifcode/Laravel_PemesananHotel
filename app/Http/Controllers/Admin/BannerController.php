<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan')->get();
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'media'  => 'required|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg|max:20480',
            'link'   => 'nullable|url',
            'urutan' => 'nullable|integer',
        ], [
            'media.mimes' => 'Format tidak didukung. Gunakan JPG, PNG, WEBP, GIF, MP4, WEBM, atau OGG.',
            'media.max'   => 'Ukuran file maksimal 20 MB.',
        ]);

        $file = $request->file('media');
        $ext  = strtolower($file->getClientOriginalExtension());
        $nama = time() . '_' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 6) . '.' . $ext;
        $tipe = self::detectType($ext);

        $file->move(public_path('img/banner'), $nama);

        Banner::create([
            'judul'  => $request->judul,
            'media'  => $nama,
            'tipe'   => $tipe,
            'link'   => $request->link,
            'aktif'  => true,
            'urutan' => $request->urutan ?? 0,
        ]);

        return redirect()->route('admin.banner.index')
                         ->with('success', 'Banner berhasil ditambahkan');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'judul'  => 'required|string|max:255',
            'media'  => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg|max:20480',
            'link'   => 'nullable|url',
            'urutan' => 'nullable|integer',
        ], [
            'media.mimes' => 'Format tidak didukung. Gunakan JPG, PNG, WEBP, GIF, MP4, WEBM, atau OGG.',
            'media.max'   => 'Ukuran file maksimal 20 MB.',
        ]);

        $data = $request->only(['judul', 'link', 'urutan']);

        if ($request->hasFile('media')) {
            $oldPath = public_path('img/banner/' . $banner->media);
            if (file_exists($oldPath)) unlink($oldPath);

            $file          = $request->file('media');
            $ext           = strtolower($file->getClientOriginalExtension());
            $nama          = time() . '_' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 6) . '.' . $ext;
            $data['media'] = $nama;
            $data['tipe']  = self::detectType($ext);

            $file->move(public_path('img/banner'), $nama);
        }

        $banner->update($data);

        return redirect()->route('admin.banner.index')
                         ->with('success', 'Banner berhasil diupdate');
    }

    public function toggle($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->update(['aktif' => !$banner->aktif]);
        return redirect()->route('admin.banner.index')
                         ->with('success', 'Status banner berhasil diubah');
    }

    public function destroy($id)
    {
        $banner  = Banner::findOrFail($id);
        $oldPath = public_path('img/banner/' . $banner->media);
        if (file_exists($oldPath)) unlink($oldPath);

        $banner->delete();

        return redirect()->route('admin.banner.index')
                         ->with('success', 'Banner berhasil dihapus');
    }

    private static function detectType(string $ext): string
    {
        return match ($ext) {
            'mp4', 'webm', 'ogg' => 'video',
            'gif'                => 'gif',
            default              => 'image',
        };
    }
}