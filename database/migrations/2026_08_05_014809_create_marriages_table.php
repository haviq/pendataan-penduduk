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
        Schema::create('marriages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('husband_resident_id')->constrained('residents')->cascadeOnDelete();
            $table->foreignId('wife_resident_id')->constrained('residents')->cascadeOnDelete();
            $table->string('marriage_certificate_number', 50)->nullable();
            $table->date('marriage_date')->nullable();
            $table->string('kua_name', 150)->nullable();
            $table->string('divorce_certificate_number', 50)->nullable();
            $table->date('divorce_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marriages');
    }
};
