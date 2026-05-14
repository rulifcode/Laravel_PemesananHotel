<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    protected $fillable = [
        'judul', 'media', 'tipe', 'link', 'aktif', 'urutan',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function getMediaUrlAttribute(): string
    {
        return asset('img/banner/' . $this->media);
    }

    public function isVideo(): bool { return $this->tipe === 'video'; }
    public function isGif(): bool   { return $this->tipe === 'gif';   }
    public function isImage(): bool { return $this->tipe === 'image'; }
}