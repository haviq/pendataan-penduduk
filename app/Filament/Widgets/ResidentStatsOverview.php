<?php

namespace App\Filament\Widgets;

use App\Models\Household;
use App\Models\Resident;
use App\Models\Rt;
use App\Models\Rw;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResidentStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalAktif = Resident::where('status', 'Aktif')->count();
        $totalPindah = Resident::where('status', 'Pindah')->count();
        $totalMeninggal = Resident::where('status', 'Meninggal')->count();

        $totalPemilih = Resident::where('status', 'Aktif')
            ->where(function ($query) {
                $query->whereDate('birth_date', '<=', now()->subYears(17)->format('Y-m-d'))
                    ->orWhere('marital_status', '!=', 'Belum Kawin');
            })
            ->count();

        return [
            Stat::make('Total RW', Rw::count())
                ->icon('heroicon-o-map')
                ->color('info'),

            Stat::make('Total RT', Rt::count())
                ->icon('heroicon-o-home-modern')
                ->color('warning'),

            Stat::make('Total KK', Household::count())
                ->icon('heroicon-o-home')
                ->color('primary'),

            Stat::make('Total Warga', Resident::count())
                ->description("Aktif: {$totalAktif} - Pindah: {$totalPindah} - Meninggal: {$totalMeninggal}")
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make('Pemilih Potensial', $totalPemilih)
                ->description('Usia 17+ atau sudah/pernah kawin')
                ->icon('heroicon-o-identification')
                ->color('primary'),
        ];
    }
}