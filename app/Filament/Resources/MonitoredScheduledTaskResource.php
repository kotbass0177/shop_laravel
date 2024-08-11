<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonitoredScheduledTaskResource\Pages;
use App\Filament\Resources\MonitoredScheduledTaskResource\RelationManagers;
use App\Filament\Resources\MonitoredScheduledTaskResource\RelationManagers\LogItemsRelationManager;
use App\Models\MonitoredScheduledTask;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Spatie\ScheduleMonitor\Models\MonitoredScheduledTaskLogItem;

class MonitoredScheduledTaskResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = MonitoredScheduledTask::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('การตรวจสอบแอปพลิเคชัน');
    }

    public static function getNavigationLabel(): string
    {
        return __('งานตามกำหนดเวลา');
    }

    public static function getModelLabel(): string
    {
        return __('งานตามกำหนดเวลา');
    }
    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
        ];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $searchableLabels = [
            __(self::$model::$attributeLabels['name']),
        ];
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__(self::$model::$attributeLabels['name']))
                    ->description(fn ($record) => "{$record->type} | {$record->cron_expression}")
                    ->wrap()
                    ->sortable()
                    ->searchable()
                    ->action(
                        Tables\Actions\ViewAction::make()
                            ->modalHeading('')
                            ->modalContent(
                                fn (MonitoredScheduledTask $monitoredScheduledTask) => new HtmlString(
                                    Blade::render('@livewire(\App\Livewire\MonitoredScheduledTask\ListMonitoredScheduledTaskLog::class, ["monitoredScheduledTask" => $monitoredScheduledTask])', [
                                        'monitoredScheduledTask' => $monitoredScheduledTask
                                    ])
                                )
                            )
                    ),
                Tables\Columns\TextColumn::make('readableCron')
                    ->label(__(self::$model::$attributeLabels['readableCron']))
                    ->getStateUsing(fn (MonitoredScheduledTask $record) => $record->readableCron()),
                Tables\Columns\TextColumn::make('last_started_at')
                    ->label(__(self::$model::$attributeLabels['last_started_at']))
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('last_finished_at')
                    ->label(__(self::$model::$attributeLabels['last_finished_at']))
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('last_failed_at')
                    ->label(__(self::$model::$attributeLabels['last_failed_at']))
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('last_skipped_at')
                    ->label(__(self::$model::$attributeLabels['last_skipped_at']))
                    ->sortable()
                    ->dateTime(),
            ])
            ->searchPlaceholder(__('ค้นหา') . ' (' . \implode(', ', $searchableLabels) . ')')

            ->filters([])
            ->actions([
                // Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMonitoredScheduledTasks::route('/'),
            // 'create' => Pages\CreateMonitoredScheduledTask::route('/create'),
            // 'edit' => Pages\EditMonitoredScheduledTask::route('/{record}/edit'),
            // 'view' => Pages\ViewMonitoredScheduledTask::route('/{record}'),
        ];
    }
}
