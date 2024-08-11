<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'จัดการ';
    protected static ?string $navigationLabel = 'แบรนด์';
    protected static ?string $modelLabel = 'แบรนด์';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Split::make([
                        Forms\Components\Section::make('ข้อมูลพื้นฐาน')
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label(self::$model::$attributeLabels['code']),
                                Forms\Components\TextInput::make('name')
                                    ->label(self::$model::$attributeLabels['name']),
                                Forms\Components\Toggle::make('active')
                                    ->label(self::$model::$attributeLabels['active'])
                                    ->default(true)
                            ])
                            ->columnSpanFull(),
                        Forms\Components\Section::make([
                                Forms\Components\FileUpload::make('image')
                                    ->label(self::$model::$attributeLabels['image'])
                                    ->image()
                                    ->imagePreviewHeight('230'),
                            ]),
                    ])
                    ->columnSpanFull(),
                Forms\Components\Section::make([
                    Forms\Components\RichEditor::make('description')
                        ->label(self::$model::$attributeLabels['description'])
                ])
                // Forms\Components\TextInput::make('created_by')
                //     ->label(self::$model::$attributeLabels['created_by'])
                //     ->numeric()
                //     ->visibleOn('edit')
                //     ->readOnly(),
                // Forms\Components\TextInput::make('updated_by')
                //     ->label(self::$model::$attributeLabels['updated_by'])
                //     ->numeric()
                //     ->visibleOn('edit')
                //     ->readOnly(),
                // Forms\Components\TextInput::make('deleted_by')
                //     ->label(self::$model::$attributeLabels['deleted_by'])
                //     ->numeric()
                //     ->visibleOn('edit')
                //     ->readOnly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(self::$model::$attributeLabels['image'])
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('code')
                    ->label(self::$model::$attributeLabels['code'])
                    ->searchable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('name')
                    ->label(self::$model::$attributeLabels['name'])
                    ->searchable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('description')
                    ->label(self::$model::$attributeLabels['description'])
                    ->searchable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault:true),
                Tables\Columns\IconColumn::make('active')
                    ->label(self::$model::$attributeLabels['active'])
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_by')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'view' => Pages\ViewBrand::route('/{record}'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
