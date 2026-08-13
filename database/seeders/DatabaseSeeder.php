<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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

        // ── Pastikan role super_admin ada ──────────────────────────────
        $role = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);

        // ── Admin default (local/staging saja) ─────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@sidukuh.local'],
            [
                'name'     => 'Admin Gondang',
                'password' => Hash::make('GondangAdmin2026!'),
            ]
        );

        // ── Assign role super_admin ────────────────────────────────────
        if (! $admin->hasRole('super_admin')) {
            $admin->assignRole($role);
        }

        $this->command->info('Seeder selesai — admin@sidukuh.local (super_admin) dibuat.');
    }
}
