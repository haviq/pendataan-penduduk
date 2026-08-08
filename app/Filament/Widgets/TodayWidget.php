<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TodayWidget extends Widget
{
    protected static ?int $sort = 0;

    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.widgets.today-widget';

    public function getGreeting(): string
    {
        $hour = now()->hour;

        return match (true) {
            $hour < 11 => 'Selamat Pagi',
            $hour < 15 => 'Selamat Siang',
            $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };
    }

    public function getFormattedDate(): string
    {
        return now()->translatedFormat('l, d F Y');
    }
}