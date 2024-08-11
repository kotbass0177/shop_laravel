<?php

namespace App\Filament\Resources\FeatureResource\RelationManagers;

use App\Models\Feature;
use Filament\Facades\Filament;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;
use Stephenjude\FilamentFeatureFlag\Events\FeatureSegmentModified;
use Stephenjude\FilamentFeatureFlag\Events\FeatureSegmentRemoved;
use Stephenjude\FilamentFeatureFlag\Events\RemovingFeatureSegment;
use Stephenjude\FilamentFeatureFlag\Models\FeatureSegment;

class FeatureSegmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'featureSegments';

    public static function getModelLabel(): string
    {
        return __(Feature::$attributeLabels['featureSegments']);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __(Feature::$attributeLabels['featureSegments']);
    }

    private static function createValuesFields(): array
    {
        return collect(config('filament-feature-flags.segments'))
            ->map(
                function ($segment) {
                    $column = $segment['column'];
                    $label = $segment['label'];
                    $model = $segment['source']['model'];
                    $value = $segment['source']['value'];
                    $key = $segment['source']['key'];

                    return Select::make('values')
                        ->label(str($label)->title())
                        ->hidden(fn (Get $get) => $get('scope') !== $column)
                        ->required()
                        ->multiple()
                        ->searchable()
                        ->columnSpanFull()
                        ->getSearchResultsUsing(
                            fn (string $search): array => $model::where($value, 'like', "%{$search}%")
                                ->limit(50)->pluck($value, $key)->toArray()
                        );
                }
            )
            ->toArray();
    }

    private static function segmentOptionsList(): array
    {
        return collect(config('filament-feature-flags.segments'))
            // ->pluck('column')
            // ->mapWithKeys(fn ($segment) => [$segment => str($segment)->plural()->title()->toString()])
            ->mapWithKeys(function ($segment) {
                $res = [$segment['column'] => str($segment['label'])->title()->toString()];
                return $res;
            })
            ->toArray();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select::make('feature')
                //     ->required()
                //     ->options(FeatureSegment::featureOptionsList())
                //     ->columnSpanFull(),

                Select::make('scope')
                    ->label(__(Feature::$attributeLabels['featureSegments']))
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('values', null))
                    ->required()
                    ->columnSpanFull()
                    ->options(static::segmentOptionsList()),

                ...static::createValuesFields(),

                Select::make('active')
                    ->label(\__(Feature::$attributeLabels['status']))
                    ->options([true => Feature::$attributeLabels['ACTIVATED'], false => Feature::$attributeLabels['DEACTIVATED']])
                    ->unique(
                        ignoreRecord: true,
                        modifyRuleUsing: function (Unique $rule, Get $get, RelationManager $livewire) {

                            // \dump($livewire->getOwnerRecord()->key);
                            // \dd($get);
                            return $rule
                                ->where('feature', $livewire->getOwnerRecord()->key)
                                ->where('scope', $get('scope'))
                                ->where('active', $get('active'));
                        }
                    )
                    ->validationMessages([
                        // 'unique' => 'Feature segmentation already exists! Please note that each feature scope can only have an activated and a deactivated segment. Modify existing segment or remove it and create a new segment.',
                        'unique' => __('เงื่อนไขสำหรับผู้ใช้งานนี้มีอยู่แล้ว! จะมีเพียงรายการที่เปิดใช้งานและรายการที่ปิดใช้งานอย่างละ 1 รายการได้เท่านั้น'),
                    ])
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scope')
                    ->label(__(Feature::$attributeLabels['featureSegments']))
                    ->getStateUsing(function (FeatureSegment $record) {
                        return static::segmentOptionsList()[$record->scope];
                    }),
                Tables\Columns\TextColumn::make('values')
                    ->label(__(Feature::$attributeLabels['values']))
                    ->wrap()
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__(Feature::$attributeLabels['status']))
                    ->badge()
                    ->color(fn (FeatureSegment $record, string $state): string => Feature::getStatusColor($record->active))
                    ->weight(FontWeight::ExtraBold)
                    ->getStateUsing(function (FeatureSegment $record) {
                        return Feature::getStatusLabel($record->active);
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    // ->label(__())
                    ->icon('heroicon-o-plus'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(fn (FeatureSegment $record) => FeatureSegmentModified::dispatch(
                        $record,
                        Filament::auth()->user()
                    )),
                Tables\Actions\DeleteAction::make()
                    ->before(fn (FeatureSegment $record) => RemovingFeatureSegment::dispatch(
                        $record,
                        Filament::auth()->user()
                    ))
                    ->after(fn () => FeatureSegmentRemoved::dispatch(Filament::auth()->user())),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->before(fn (Collection $records) => $records->each(
                        fn (Model $record) => RemovingFeatureSegment::dispatch(
                            $record,
                            Filament::auth()->user()
                        )
                    ))
                    ->after(fn (Collection $records) => FeatureSegmentRemoved::dispatch(Filament::auth()->user())),
            ]);
    }
}
