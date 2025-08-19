<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HafalanSiswa extends Model
{
    protected $table = 'hafalan_siswa';

    protected $fillable = ['siswa_id', 'hafalan_doa_id', 'tanggal_setor', 'status', 'catatan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function doa()
    {
        return $this->belongsTo(HafalanDoa::class, 'hafalan_doa_id');
    }
}
