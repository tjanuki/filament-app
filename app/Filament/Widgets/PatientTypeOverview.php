<?php

namespace App\Filament\Widgets;

use App\Enums\PatientType;
use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatientTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cats', Patient::query()->where('type', PatientType::CAT)->count()),
            Stat::make('Dogs', Patient::query()->where('type', PatientType::DOG)->count()),
            Stat::make('Rabbits', Patient::query()->where('type', PatientType::RABBIT)->count()),
        ];
    }
}
