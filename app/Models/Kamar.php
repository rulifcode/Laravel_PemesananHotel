<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamar';

    protected $fillable = [
        'no_kamar',
        'foto',
    ];

    public function fasilitas()
    {
        return $this->hasMany(FasilitasKamar::class, 'kamar_id');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'kamar_id');
    }
}