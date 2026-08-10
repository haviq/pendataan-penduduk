<?php

namespace App\Filament\Widgets;

use App\Models\Resident;
use App\Models\Rt;
use Filament\Widgets\ChartWidget;

class ResidentsByRtChart extends ChartWidget
{
    protected ?string $heading = 'Jumlah Warga per RT';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $rts = Rt::with('rw')->get();

        $labels = [];
        $counts = [];

        foreach ($rts as $rt) {
            $labels[] = "RT {$rt->number} / RW {$rt->rw->number}";

            $counts[] = Resident::whereHas('household', fn ($q) => $q->where('rt_id', $rt->id))
                ->where('status', 'Aktif')
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Warga',
                    'data' => $counts,
                    'backgroundColor' => '#F59E0B',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getMaxHeight(): ?string
    {
        return '300px';
    }
}