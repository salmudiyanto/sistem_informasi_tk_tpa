<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerkembanganBacaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkembangan_bacaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('surat');
            $table->string('ayat_mulai');
            $table->string('ayat_selesai');
            $table->enum('status', ['lancar', 'perlu bimbingan', 'belum bisa']);
            $table->text('catatan')->nullable();
            $table->foreignId('guru_id')->nullable()->constrained('guru')->onDelete('set null');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perkembangan_bacaan');
    }
}
