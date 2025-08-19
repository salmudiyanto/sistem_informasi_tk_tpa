<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    protected $table = 'wali';

    protected $fillable = ['nama', 'alamat', 'telepon', 'email', 'pekerjaan'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
