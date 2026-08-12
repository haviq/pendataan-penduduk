<?php

namespace App\Filament\Widgets;

use App\Models\Resident;
use Filament\Widgets\ChartWidget;

class GenderChart extends ChartWidget
{
    protected ?string $heading = 'Sebaran Jenis Kelamin';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $lakiLaki = Resident::where('gender', 'Laki-laki')->count();
        $perempuan = Resident::where('gender', 'Perempuan')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Warga',
                    'data' => [$lakiLaki, $perempuan],
                    'backgroundColor' => ['#3B82F6', '#EC4899'],
                ],
            ],
            'labels' => ['Laki-laki', 'Perempuan'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getMaxHeight(): ?string
    {
        return '260px';
    }
}