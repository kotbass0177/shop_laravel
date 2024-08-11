<?php

namespace App\Filament\Resources;

use App\enums\StatusMasterEnum;
use App\Filament\Resources\ProductCategorySubResource\Pages;
use App\Filament\Resources\ProductCategorySubResource\RelationManagers;
use App\Models\ProductCategorySub;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductCategorySubResource extends Resource
{
    protected static ?string $model = ProductCategorySub::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?string $navigationGroup = 'จัดการ';

    protected static ?string $navigationLabel = 'หมวดหมู่สินค้ารอง';

    protected static ?string $modelLabel = 'หมวดหมู่สินค้ารอง';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\Select::make('product_category_main_id')
                        ->label(self::$model::$attributeLabels['product_category_main_id'])
                        ->relationship('productCategoryMain', 'name')
                        ,
                ]),
                Forms\Components\Split::make([
                    Forms\Components\Group::make([
                        Forms\Components\Section::make([
    
                            Forms\Components\TextInput::make('code')
                                ->label(self::$model::$attributeLabels['code'])
                                ,
                            Forms\Components\TextInput::make('name')
                                ->label(self::$model::$attributeLabels['name'])
                                ,
                            Forms\Components\TextInput::make('status')
                                ->label(self::$model::$attributeLabels['status'])
                                ->readOnly()
                                ,
                            Forms\Components\Toggle::make('active')
                                ->label(self::$model::$attributeLabels['active'])
                                ->required(),
                        ]),
                    ]),
                    Forms\Components\Section::make([
                        Forms\Components\FileUpload::make('image')
                            ->label(self::$model::$attributeLabels['image'])
                            ->image()
                            ->imagePreviewHeight('150'),
                        Forms\Components\Textarea::make('remark')
                            ->label(self::$model::$attributeLabels['remark'])
                            ,
                    ]),
                ])
                ->columnSpanFull(),
                
                Forms\Components\Section::make([
                    Forms\Components\RichEditor::make('description')
                        ->label(self::$model::$attributeLabels['description'])
                        ,
                ]),
                
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
                    ->defaultImageUrl(function($record){
                        return 'https://ui-avatars.com/api/?name='.urlencode($record->name);
                    }),
                Tables\Columns\TextColumn::make('productCategoryMain.name')
                    ->label(self::$model::$attributeLabels['product_category_main_id'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label(self::$model::$attributeLabels['code'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                ->label(self::$model::$attributeLabels['name'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state): string => match ($state){
                        'PENDING' => 'warning',
                        'COMPLETE' => 'success',
                    })
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                // Tables\Columns\TextColumn::make('description')
                //     ->label(self::$model::$attributeLabels['description'])
                //     ->searchable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('remark')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListProductCategorySubs::route('/'),
            'create' => Pages\CreateProductCategorySub::route('/create'),
            'view' => Pages\ViewProductCategorySub::route('/{record}'),
            'edit' => Pages\EditProductCategorySub::route('/{record}/edit'),
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
