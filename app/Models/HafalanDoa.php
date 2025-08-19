<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HafalanDoa extends Model
{
    protected $table = 'hafalan_doa';

    protected $fillable = ['nama_doa', 'kategori'];

    public function siswa()
    {
        return $this->hasMany(HafalanSiswa::class);
    }
}
