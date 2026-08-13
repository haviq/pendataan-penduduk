<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resident_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('residents')->cascadeOnDelete();
            $table->enum('jenis_perubahan', ['pindah_masuk', 'pindah_keluar', 'meninggal', 'aktif_kembali', 'perubahan_data']);
            $table->text('keterangan')->nullable();
            $table->string('asal_alamat', 200)->nullable();
            $table->string('tujuan_alamat', 200)->nullable();
            $table->date('tanggal_perubahan');
            $table->string('dicatat_oleh', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resident_histories');
    }
};
