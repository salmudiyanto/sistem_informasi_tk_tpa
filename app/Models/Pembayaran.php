<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = ['siswa_id', 'tanggal_bayar', 'jenis_pembayaran', 'jumlah', 'keterangan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
