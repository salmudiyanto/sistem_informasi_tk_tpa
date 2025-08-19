<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = ['tingkat_id', 'guru_id', 'nama_kelas', 'tahun_ajaran'];

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
