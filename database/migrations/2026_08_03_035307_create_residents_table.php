<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id')->constrained('households')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('nik', 16)->unique();
            $table->string('full_name', 150);
            $table->string('birth_place', 100)->nullable();
            $table->date('birth_date');

            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->enum('blood_type', ['A', 'B', 'AB', 'O', 'Tidak Tahu'])->nullable();
            $table->enum('religion', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])->nullable();
            $table->enum('education', ['Tidak/Belum Sekolah', 'SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->string('occupation', 100)->nullable();
            $table->enum('marital_status', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])->default('Belum Kawin');
            $table->enum('relationship_to_head', ['Kepala Keluarga', 'Suami', 'Istri', 'Anak', 'Menantu', 'Cucu', 'Orang Tua', 'Famili Lain', 'Lainnya']);

            $table->string('father_name', 150)->nullable();
            $table->string('mother_name', 150)->nullable();
            $table->string('birth_cert_number', 50)->nullable();

            $table->enum('status', ['Aktif', 'Pindah', 'Meninggal'])->default('Aktif');
            $table->date('status_date')->nullable();
            $table->text('status_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
