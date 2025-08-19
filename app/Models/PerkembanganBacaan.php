<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerkembanganBacaan extends Model
{
    protected $table = 'perkembangan_bacaan';

    protected $fillable = [
        'siswa_id', 'tanggal', 'surat', 'ayat_mulai',
        'ayat_selesai', 'status', 'catatan', 'guru_id'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
