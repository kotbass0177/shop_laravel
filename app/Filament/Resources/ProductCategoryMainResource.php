<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryMainResource\Pages;
use App\Filament\Resources\ProductCategoryMainResource\RelationManagers;
use App\Models\ProductCategoryMain;
use App\enums\StatusMasterEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductCategoryMainResource extends Resource
{
    protected static ?string $model = ProductCategoryMain::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'จัดการ';

    protected static ?string $navigationLabel = 'หมวดหมู่สินค้าหลัก';

    protected static ?string $modelLabel = 'หมวดหมู่สินค้าหลัก';

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
                            Forms\Components\TextInput::make('status')
                                ->label(self::$model::$attributeLabels['status'])
                                ->readOnly()
                                ->default(StatusMasterEnum::PENDING->value),
                            Forms\Components\Toggle::make('active')
                                ->label(self::$model::$attributeLabels['active'])
                                ->required()
                                ->default(true)
                                ->onIcon('heroicon-s-check-circle')
                                ->onColor('success')
                                ->offIcon('heroicon-s-x-circle')
                                ->offColor('danger'),
                        ]),
                    Forms\Components\Section::make([
                        Forms\Components\FileUpload::make('image')
                            ->label(self::$model::$attributeLabels['image'])
                            ->image()
                            ->imagePreviewHeight('209'),
                        Forms\Components\Textarea::make('remark')
                            ->label(self::$model::$attributeLabels['remark'])
                            ->rows(2),
                    ]),
                ])
                ->columnSpanFull(),

                Forms\Components\Section::make('เพิ่มเติม')
                ->schema([
                    Forms\Components\RichEditor::make('description')
                        ->label(self::$model::$attributeLabels['description'])
                        ->columnSpanFull(),
                ])

                // Forms\Components\TextInput::make('created_by')
                //     ->numeric(),
                // Forms\Components\TextInput::make('updated_by')
                //     ->numeric(),
                // Forms\Components\TextInput::make('deleted_by')
                //     ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(self::$model::$attributeLabels['image'])
                    ->defaultImageUrl(function($record){
                        return 'https://ui-avatars.com/api/?name='.urlencode($record->name);
                    })
                    ,
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('remark')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('description')
                //     ->searchable(),
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
            'index' => Pages\ListProductCategoryMains::route('/'),
            'create' => Pages\CreateProductCategoryMain::route('/create'),
            'view' => Pages\ViewProductCategoryMain::route('/{record}'),
            'edit' => Pages\EditProductCategoryMain::route('/{record}/edit'),
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
