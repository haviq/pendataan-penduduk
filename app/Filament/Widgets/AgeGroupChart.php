<?php

namespace App\Filament\Widgets;

use App\Models\Resident;
use Filament\Widgets\ChartWidget;

class AgeGroupChart extends ChartWidget
{
    protected ?string $heading = 'Sebaran Kelompok Usia';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $groups = [
            'Bayi (<1)' => [0, 0],
            'Balita (1-4)' => [1, 4],
            'Anak (5-12)' => [5, 12],
            'Remaja (13-17)' => [13, 17],
            'Dewasa (18-59)' => [18, 59],
            'Lansia (60+)' => [60, 150],
        ];

        $counts = [];

        foreach ($groups as $label => [$min, $max]) {
            $maxDate = now()->subYears($min)->format('Y-m-d');
            $minDate = now()->subYears($max + 1)->addDay()->format('Y-m-d');

            $counts[] = Resident::whereDate('birth_date', '<=', $maxDate)
                ->whereDate('birth_date', '>=', $minDate)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Warga',
                    'data' => $counts,
                    'backgroundColor' => '#6366F1',
                ],
            ],
            'labels' => array_keys($groups),
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