<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductCategorySub;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-fire';

    protected static ?string $navigationGroup = 'จัดการ';

    protected static ?string $navigationLabel = 'สินค้า';

    protected static ?string $modelLabel = 'สินค้า';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('ประเภท')
                    ->schema([
                        Forms\Components\Select::make('product_category_main_id')
                            ->label(self::$model::$attributeLabels['product_category_main_id'])
                            ->relationship('productCategoryMain', 'name')
                            ->live(),
                        Forms\Components\Select::make('product_category_sub_id')
                            ->label(self::$model::$attributeLabels['product_category_sub_id'])
                            // ->relationship('productCategorySub', 'name')
                            ->options(function (callable $get) {
                                Log::info('product_category_sub_id');
                                Log::info($get('product_category_main_id'));
                                return ProductCategorySub::where('product_category_main_id', $get('product_category_main_id'))->get()->pluck('name', 'id');
                            })
                            ->disabled(function (callable $get) {
                                return !empty($get('product_category_main_id')) ? false : true;
                            }),
                    ])
                    ->columns(2),
                Forms\Components\Split::make([
                    Forms\Components\Section::make('ข้อมูลพื้นฐาน')
                        ->schema([
                            Forms\Components\TextInput::make('code')
                                ->label(self::$model::$attributeLabels['code']),
                            Forms\Components\TextInput::make('name')
                                ->label(self::$model::$attributeLabels['name']),
                            Forms\Components\TextInput::make('status')
                                ->label(self::$model::$attributeLabels['status']),
                            Forms\Components\Toggle::make('active')
                                ->label(self::$model::$attributeLabels['active'])
                                ->required(),
                        ]),
                    Forms\Components\Section::make('ราคาและโปรโมชั่น')
                        ->schema([
                            Forms\Components\Group::make([
                                Forms\Components\TextInput::make('cost')
                                    ->label(self::$model::$attributeLabels['cost'])
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('price')
                                    ->label(self::$model::$attributeLabels['price'])
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('quantity')
                                    ->label(self::$model::$attributeLabels['quantity'])
                                    ->numeric()
                                    ->columnSpan(2),
                            ])->columns(2),
                            Forms\Components\Group::make([
                                Forms\Components\Toggle::make('is_new')
                                    ->label(self::$model::$attributeLabels['is_new'])
                                    ->required(),
                                Forms\Components\Toggle::make('is_recommend')
                                    ->label(self::$model::$attributeLabels['is_recommend'])
                                    ->required(),
                                Forms\Components\Toggle::make('is_popular')
                                    ->label(self::$model::$attributeLabels['is_popular'])
                                    ->required(),
                                Forms\Components\Toggle::make('is_discount')
                                    ->label(self::$model::$attributeLabels['is_discount'])
                                    ->required(),
                            ])->columns(2)

                        ])
                ])
                ->columnSpanFull(),
                Forms\Components\Section::make([
                    Forms\Components\FileUpload::make('image')
                        ->image(),
                    Forms\Components\Textarea::make('remark'),
                ])
                ->columnSpanFull()
                ->columns(2),
                Forms\Components\Section::make([
                    Forms\Components\RichEditor::make('description')
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
                    ->label(self::$model::$attributeLabels['image']),
                Tables\Columns\TextColumn::make('productCategoryMain.name')
                    ->label(self::$model::$attributeLabels['product_category_main_id'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('productCategorySub.name')
                    ->label(self::$model::$attributeLabels['product_category_sub_id'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label(self::$model::$attributeLabels['code'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(self::$model::$attributeLabels['name'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(self::$model::$attributeLabels['description'])
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('cost')
                    ->label(self::$model::$attributeLabels['cost'])
                    ->money('THB')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(self::$model::$attributeLabels['price'])
                    ->money('THB')
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(self::$model::$attributeLabels['quantity'])
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(self::$model::$attributeLabels['status'])
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->label(self::$model::$attributeLabels['active'])
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_new')
                    ->label(self::$model::$attributeLabels['is_new'])
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_recommend')
                    ->label(self::$model::$attributeLabels['is_recommend'])
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_popular')
                    ->label(self::$model::$attributeLabels['is_popular'])
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_discount')
                    ->label(self::$model::$attributeLabels['is_discount'])
                    ->boolean(),
                Tables\Columns\TextColumn::make('remark')
                    ->label(self::$model::$attributeLabels['remark'])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
