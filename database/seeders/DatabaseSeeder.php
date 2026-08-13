<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ── Guard: jangan jalankan di produksi ─────────────────────────
        // render.yaml pakai --seed saat deploy, tapi env sudah di-set
        // APP_ENV=production sehingga seeder ini aman di-skip otomatis.
        if (app()->environment('production')) {
            $this->command->warn('Seeder dilewati — environment production.');
            return;
        }

        // ── Admin default (local/staging saja) ─────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@sidukuh.local'],
            [
                'name'     => 'Admin Gondang',
                'password' => Hash::make('GondangAdmin2026!'),
            ]
        );

        $this->command->info('Seeder selesai — admin@sidukuh.local dibuat.');
    }
}
