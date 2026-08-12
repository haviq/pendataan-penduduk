<?php

namespace App\Filament\Widgets;

use App\Models\Resident;
use Filament\Widgets\ChartWidget;

class EducationChart extends ChartWidget
{
    protected ?string $heading = 'Sebaran Pendidikan';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $levels = [
            'Tidak/Belum Sekolah',
            'SD',
            'SMP',
            'SMA',
            'D3',
            'S1',
            'S2',
            'S3',
        ];

        $counts = collect($levels)->map(
            fn (string $level) => Resident::where('education', $level)->count()
        )->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Warga',
                    'data' => $counts,
                    'backgroundColor' => '#F59E0B',
                ],
            ],
            'labels' => $levels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getMaxHeight(): ?string
    {
        return '260px';
    }
}