<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nama', 'jenis_kelamin', 'tanggal_lahir', 'alamat',
        'wali_id', 'tingkat_id', 'tanggal_masuk', 'status'
    ];

    public function wali()
    {
        return $this->belongsTo(Wali::class);
    }

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function iuranBulanan()
    {
        return $this->hasMany(IuranBulanan::class);
    }

    public function hafalan()
    {
        return $this->hasMany(HafalanSiswa::class);
    }

    public function bacaan()
    {
        return $this->hasMany(PerkembanganBacaan::class);
    }
}
