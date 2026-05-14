<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiKaryawan extends Model
{
    protected $table = 'absensi_karyawan';

    protected $fillable = [
        'user_id', 'tanggal', 'jam_masuk', 'jam_keluar', 'status', 'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
