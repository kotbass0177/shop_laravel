<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Filament\Resources\UserResource\Pages\ListUsers;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class UserOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;
    public array $tableColumnSearches = [];

    protected function getTablePage(): string
    {
        return ListUsers::class;
    }
    protected function getStats(): array
    {
        $query = $this->getPageTableQuery();
        $query->getQuery()->wheres = [];
        $query->getQuery()->bindings['where'] = [];

        $query2 = $query->clone();
        $query3 = $query->clone();

        return [
            Stat::make('all-users', Number::format($query->count()))
                ->label(__('ผู้ใช้งานทั้งหมด'))
                ->extraAttributes([
                    'class' => 'text-center',
                ]),
            Stat::make('added-today', Number::format($query2->whereDate('created_at', \today())->count()))
                ->label(__('เพิ่มใหม่วันนี้'))
                ->extraAttributes([
                    'class' => 'text-center',
                ]),
            Stat::make('deleted-today', Number::format($query3->withTrashed()->whereDate('deleted_at', \today())->count()))
                ->label(__('ลบวันนี้'))
                ->extraAttributes([
                    'class' => 'text-center',
                ]),
        ];
    }
}
