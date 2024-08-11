<?php

namespace App\Filament\Resources\MonitoredScheduledTaskResource\Pages;

use App\Filament\Resources\MonitoredScheduledTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonitoredScheduledTasks extends ListRecords
{
    protected static string $resource = MonitoredScheduledTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
