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
        Schema::table('residents', function (Blueprint $table) {
            $table->boolean('has_ktp')->default(false)->after('birth_cert_number');
            $table->string('birth_cert_issuer', 100)->nullable()->after('birth_cert_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn(['has_ktp', 'birth_cert_issuer']);
        });
    }
};
