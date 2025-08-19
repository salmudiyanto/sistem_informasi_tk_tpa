<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = ['nama', 'jenis_kelamin', 'alamat', 'telepon', 'email', 'bidang'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function bacaan()
    {
        return $this->hasMany(PerkembanganBacaan::class);
    }
}
