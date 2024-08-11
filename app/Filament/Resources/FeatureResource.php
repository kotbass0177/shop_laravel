<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Filament\Resources\FeatureResource\RelationManagers;
use App\Filament\Resources\FeatureResource\RelationManagers\FeatureSegmentsRelationManager;
use App\Models\Feature;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;
    protected static ?int $navigationSort = 4;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationIcon(): ?string
    {
        return config('filament-feature-flags.panel.icon');
    }

    public static function getModelLabel(): string
    {
        return config('filament-feature-flags.panel.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('filament-feature-flags.panel.group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('key')
                //     ->disabled(),
                Forms\Components\TextInput::make('name')
                    ->label(__(Feature::$attributeLabels['name']))
                    ->disabled(),
                Forms\Components\Toggle::make('is_activated')
                    ->inline(false)
                    ->label(__(Feature::$attributeLabels['is_activated'])),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('key')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__(Feature::$attributeLabels['name']))
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_activated')
                    ->label(__(Feature::$attributeLabels['is_activated']))
                    ->boolean(),
                TextColumn::make('featureSegments')
                    ->label(__(Feature::$attributeLabels['featureSegments']))
                    ->state(function (Feature $record): int {
                        return count($record->featureSegments);
                    })
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FeatureSegmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
            'create' => Pages\CreateFeature::route('/create'),
            'edit' => Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
