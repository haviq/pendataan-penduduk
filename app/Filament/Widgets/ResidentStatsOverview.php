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
    protected function getStats(): array
    {
        $totalAktif = Resident::where('status', 'Aktif')->count();
        $totalPindah = Resident::where('status', 'Pindah')->count();
        $totalMeninggal = Resident::where('status', 'Meninggal')->count();

        return [
            Stat::make('Total RW', Rw::count())
                ->icon('heroicon-o-rectangle-stack'),

            Stat::make('Total RT', Rt::count())
                ->icon('heroicon-o-rectangle-stack'),

            Stat::make('Total Kartu Keluarga', Household::count())
                ->icon('heroicon-o-home'),

            Stat::make('Total Warga', Resident::count())
                ->description("Aktif: {$totalAktif} · Pindah: {$totalPindah} · Meninggal: {$totalMeninggal}")
                ->icon('heroicon-o-users')
                ->color('success'),
        ];
    }

    protected static ?int $sort = 1;
}