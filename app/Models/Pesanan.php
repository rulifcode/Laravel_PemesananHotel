<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'cek_in',
        'cek_out',
        'jml_kamar',
        'nama_pemesan',
        'email_pemesan',
        'hp_pemesan',
        'nama_tamu',
        'kamar_id',
        'status',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }
}