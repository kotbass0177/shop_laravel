<?php

namespace App\Filament\Resources\Shield\RoleResource\Pages;

use App\Filament\Exports\RoleExporter;
use App\Filament\Resources\RoleResource\Widgets\RoleOverview;
use App\Filament\Resources\Shield\RoleResource;
use App\Models\Role;
use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListRoles extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->hidden(!auth()->user()->can('export_shield::role'))
                ->icon('heroicon-m-arrow-top-right-on-square')
                ->modalHeading(__('ส่งออกข้อมูลหน้าที่ในระบบ'))
                ->label('Export')
                ->color(Color::Emerald)
                ->exporter(RoleExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                ]),
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()->badge(Role::query()->count())
                ->label(__('ทั้งหมด')),
            'active' => Tab::make()
                ->label(__('เปิดใช้งาน'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('active', true))
                ->badge(Role::query()->where('active', true)->count()),
            'inactive' => Tab::make()
                ->label(__('ไม่เปิดใช้งาน'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('active', false))
                ->badge(Role::query()->where('active', false)->count()),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'active';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RoleOverview::class,
        ];
    }
}
