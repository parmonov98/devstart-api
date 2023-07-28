<?php

namespace App\MoonShine;

use App\Models\User;
use MoonShine\Metrics\ValueMetric;
use MoonShine\Dashboard\DashboardBlock;
use MoonShine\Dashboard\DashboardScreen;

class Dashboard extends DashboardScreen
{
    public function blocks(): array
    {
        return [
            DashboardBlock::make([
                ValueMetric::make('Количество пользователей')
                    ->value(User::query()->count()),

                ValueMetric::make('Количество разработчиков')
                    ->value(User::query()->developer()->count())
                    ->columnSpan(6),

                ValueMetric::make('Количество стартаперов')
                    ->value(User::query()->ideaHolder()->count())
                    ->columnSpan(6)

                // projects metrcis will be here soon
            ])
        ];
    }
}
