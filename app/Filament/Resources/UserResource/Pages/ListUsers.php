<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Exports\UserExporter;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Widgets\UserOverview;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->hidden(!auth()->user()->can('export_user'))
                ->icon('heroicon-m-arrow-top-right-on-square')
                ->modalHeading(__('ส่งออกข้อมูลผู้ใช้งาน'))
                ->label('Export')
                ->color(Color::Emerald)
                ->exporter(UserExporter::class)
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
            'all' => Tab::make()->badge(User::query()->count())
                ->label(__('ทั้งหมด')),
            'active' => Tab::make()
                ->label(__('เปิดใช้งาน'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('active', true))
                ->badge(User::query()->where('active', true)->count()),
            'inactive' => Tab::make()
                ->label(__('ไม่เปิดใช้งาน'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('active', false))
                ->badge(User::query()->where('active', false)->count()),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'active';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserOverview::class,
        ];
    }
}
