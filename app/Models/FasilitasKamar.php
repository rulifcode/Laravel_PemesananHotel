<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasKamar extends Model
{
    protected $table = 'fasilitas_kamar';

    protected $fillable = ['nama_fasilitas', 'kamar_id'];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}