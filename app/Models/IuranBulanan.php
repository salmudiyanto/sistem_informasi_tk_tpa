<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IuranBulanan extends Model
{
    protected $table = 'iuran_bulanan';

    protected $fillable = ['siswa_id', 'bulan', 'tahun', 'jumlah', 'status', 'tanggal_bayar'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
