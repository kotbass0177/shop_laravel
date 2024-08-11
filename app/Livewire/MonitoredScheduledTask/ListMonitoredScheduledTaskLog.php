<?php

namespace App\Livewire\MonitoredScheduledTask;

use App\Models\MonitoredScheduledTask;
use App\Models\MonitoredScheduledTaskLogItem;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\HtmlString;
use Spatie\ScheduleMonitor\Models\MonitoredScheduledTaskLogItem as BaseMonitoredScheduledTaskLogItem;

class ListMonitoredScheduledTaskLog extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $model = BaseMonitoredScheduledTaskLogItem::class;

    public MonitoredScheduledTask $monitoredScheduledTask;

    public function table(Table $table): Table
    {
        return $table
            ->relationship(fn (): HasMany => $this->monitoredScheduledTask->logItems())
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('type')
                    ->label(__(MonitoredScheduledTaskLogItem::$attributeLabels['type']))
                    // ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        MonitoredScheduledTaskLogItem::TYPE_STARTING => 'info',
                        MonitoredScheduledTaskLogItem::TYPE_FINISHED => 'success',
                        MonitoredScheduledTaskLogItem::TYPE_SKIPPED => 'warning',
                        MonitoredScheduledTaskLogItem::TYPE_FAILED => 'danger',
                    })
                    ->formatStateUsing(
                        fn (string $state): string => __($state)
                    )
                    ->action(
                        ViewAction::make()
                            ->modalHeading('')
                            ->modalContent(
                                fn (BaseMonitoredScheduledTaskLogItem $record): HtmlString => new HtmlString(
                                    sprintf('<pre>%s</pre>', print_r($record->meta, true))
                                )
                            )
                    ),
                TextColumn::make('meta.memory')
                    ->label(__(MonitoredScheduledTaskLogItem::$attributeLabels['memory']))
                    // ->sortable()
                    ->formatStateUsing(fn (string $state): string => sprintf('%d MB', (int) $state / 1024 / 1024)),
                TextColumn::make('meta.runtime')
                    ->label(__(MonitoredScheduledTaskLogItem::$attributeLabels['runtime']))
                    // ->sortable()
                    ->formatStateUsing(fn (string $state): string => sprintf('%.2fs', $state)),
                TextColumn::make('created_at')
                    ->label(__(MonitoredScheduledTaskLogItem::$attributeLabels['created_at']))
                    // ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label(__(MonitoredScheduledTaskLogItem::$attributeLabels['type']))
                    ->multiple()
                    ->options([
                        MonitoredScheduledTaskLogItem::TYPE_STARTING => __('filament-schedule-monitor::translations.' . MonitoredScheduledTaskLogItem::TYPE_STARTING),
                        MonitoredScheduledTaskLogItem::TYPE_FINISHED => __('filament-schedule-monitor::translations.' . MonitoredScheduledTaskLogItem::TYPE_FINISHED),
                        MonitoredScheduledTaskLogItem::TYPE_SKIPPED => __('filament-schedule-monitor::translations.' . MonitoredScheduledTaskLogItem::TYPE_SKIPPED),
                        MonitoredScheduledTaskLogItem::TYPE_FAILED => __('filament-schedule-monitor::translations.' . MonitoredScheduledTaskLogItem::TYPE_FAILED),
                    ]),
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     //
                // ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.monitored-scheduled-task.list-monitored-scheduled-task-log');
    }
}
