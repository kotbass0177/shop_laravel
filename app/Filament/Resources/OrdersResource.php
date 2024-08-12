<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdersResource\Pages;
use App\Filament\Resources\OrdersResource\RelationManagers;
use App\Forms\Components\TextH1;
use App\Models\Orders;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;

class OrdersResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function getNavigationLabel(): string
    {
        return __('สั่งซื้อสินค้า');
    }

    public static function getModelLabel(): string
    {
        return __('สั่งซื้อสินค้า');
    }

    public static function form(Form $form): Form
    {

        $order = Orders::orderBy('id', 'desc')->first();
        $orderCode = "";
        if (!isset($order)) {
            $orderCode = 'ORDER-1';
        } else {
            $orderCode = 'ORDER-' . time();
        }

        return $form
            ->schema([
                // Forms\Components\Section::make('ทดสอบ')->schema([
                //     Forms\Components\Actions::make([
                //         Forms\Components\Actions\Action::make('test')
                //             ->label('ทดสอบ')
                //             ->icon('heroicon-o-beaker')
                //             ->outlined(),
                //     ]),
                //     Forms\Components\Group::make([
                //         Forms\Components\TextInput::make('product_code')
                //             ->label('scan barcode')
                //             ->dehydrated(false)
                //             ->live()
                //             ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get, \Livewire\Component $livewire) {
                //                 self::setProducts($state, $set, $get, $livewire);
                //             })->autofocus(),
                //         Forms\Components\Select::make('product')
                //             ->dehydrated(false)
                //             ->options(function () {
                //                 return Product::where('active', true)->where('deleted_at', null)->orderBy('id')->get()->pluck('name', 'id');
                //             })
                //             ->live()
                //             ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get, \Livewire\Component $livewire) {

                //                 $_product = Product::where('id', $state)->first();
                //                 if (isset($_product)) {
                //                     $set('product_code', $_product->code);
                //                     self::setProducts($_product->code, $set, $get, $livewire);
                //                 }
                //             }),
                //         Forms\Components\TextInput::make('product_qty')
                //             ->label('จำนวน')
                //             ->dehydrated(false)
                //             ->default(1),
                //     ])
                //         ->columns(3)
                // ])
                //     ->collapsible(true)
                //     ->visibleOn('create'),
                
                
                Forms\Components\Hidden::make('price_total'),
                Forms\Components\Split::make([
                    Forms\Components\Group::make([
                            
                            Forms\Components\Section::make()
                                ->schema([
                                    Forms\Components\TextInput::make('product_code')
                                        ->label('scan barcode')
                                        ->dehydrated(false)
                                        ->live()
                                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get, \Livewire\Component $livewire) {
                                            self::setProducts($state, $set, $get, $livewire);
                                        })
                                        ->autofocus(),
                                    Forms\Components\TextInput::make('product_qty')
                                        ->label('จำนวน')
                                        ->dehydrated(false)
                                        ->default(1)
                                ])->columns(2),
                            Forms\Components\TextInput::make('order_code')
                                ->label(self::$model::$attributeLabels['order_code'])
                                ->readOnly()
                                ->default($orderCode)
                                ->columnSpanFull(),
                            Forms\Components\Hidden::make('order_date')
                                ->default(now()),
                            Forms\Components\Hidden::make('status')
                                ->default("pending"),
                            Forms\Components\Hidden::make('type')
                                ->default("ORDER"),

                            TableRepeater::make('products')
                                ->label('')
                                ->headers([
                                    Header::make('รหัส')->width('150px'),
                                    Header::make('ชื่อ')->width('150px'),
                                    Header::make('ราคา')->width('150px'),
                                    Header::make('จำนวน')->width('150px'),
                                ])
                                ->emptyLabel('ไม่มีรายการสินค้า')
                                ->schema([
                                    // Forms\Components\FileUpload::make('image')
                                        //     ->image()
                                        //     ->imagePreviewHeight('80')
                                        //     ->deletable(false),
                                        Forms\Components\TextInput::make('code')
                                            // ->label(Product::$attributeLabels['code'])
                                            ->readOnly(),
                                        Forms\Components\TextInput::make('name')
                                            // ->label(Product::$attributeLabels['name'])
                                            ->readOnly(),
                                        Forms\Components\TextInput::make('price')
                                            // ->label(Product::$attributeLabels['price'])
                                            ->readOnly(),
                                        Forms\Components\TextInput::make('qty')
                                            // ->label('จำนวนสินค้า')
                                            ->numeric()
                                            ->readOnly()
                                ])
                                ->deleteAction(function (Action $action, string $operation, $state, Forms\Set $set, Forms\Get $get, \Livewire\Component $livewire) {

                                    return $action
                                        ->requiresConfirmation()
                                        ->modalDescription('Are you sure you\'d like to delete this item? This cannot be undone.')
                                        ->before(function ($component, $get, $set, $state, $livewire) {
                                            Log::emergency('ลบ Start');
                                        })
                                        ->after(function ($component, $get, $set, $state, $livewire) {
                                            Log::emergency('ลบ End');
                                            self::updateTotals($set, $get, $livewire);

                                            Notification::make()
                                                ->icon('heroicon-o-check-circle')
                                                ->success()
                                                ->title('สำเร็จ!')
                                                ->body('ลบสินค้าออกจากตะกร้าสำเร็จ')
                                                ->send();
                                        });
                                })
                                ->default([])
                                ->columnSpanFull()
                                ->addable(false)
                                ->orderable(false)
                                ,
                        ]),
                    Forms\Components\Group::make([
                        Section::make('gross')
                            ->heading('')
                            ->schema([
                                TextH1::make('price_total')
                                    ->label('ราคารวม')
                                    ->default(0)
                                    ->backgroundColor('bg-blue-500'),
                                Forms\Components\TextInput::make('received_amount')
                                    ->label('รับเงินจากลูกค้า')
                                    ->dehydrated(false)
                                    ->live(false)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get, \Livewire\Component $livewire) {
                                        if(strlen($state) > 1) {
                                            $pt = floatval($get('price_total'));
                                            $ra = floatval($state);
                                            $ca = $ra - $pt;
                                            $set('change_amount', $ca);
                                        }
                                    })
                                    ->suffix('บาท')
                                    ,
                                TextH1::make('change_amount')
                                    ->label('เงินทอน')
                                    ->default(0)
                                    ->dehydrated(false)
                                    ->backgroundColor('bg-yellow-500'),
                                Forms\Components\ToggleButtons::make('payment_type')
                                    ->label('รับเงินสดหรือโอน')
                                    ->dehydrated(false)
                                    ->boolean()
                                    ->inline()
                                    ->grouped()
                                    ->default(0)
                                    ->options([
                                        'เงินสด','เงินโอน'
                                    ])
                                    ->icons([
                                        0 => 'heroicon-o-banknotes',
                                        1 => 'heroicon-o-credit-card',
                                    ])
                            ])
                    ])
                ])
                ->columnSpanFull(),
                Forms\Components\Hidden::make('active')
                    ->default(true),
                // Forms\Components\TextInput::make('created_by')
                //     ->numeric(),
                // Forms\Components\TextInput::make('updated_by')
                //     ->numeric(),
                // Forms\Components\TextInput::make('deleted_by')
                //     ->numeric(),
            ]);
    }

    public static function setProducts($state, Forms\Set $set, Forms\Get $get, $livewire): void
    {
        Log::info($state);
        if (strlen($state) > 2) {
            $carts = $get('products');
            $cartChecks = $get('products');
            if (count($cartChecks) == 1) {
                foreach ($cartChecks as $cart) {
                    if (empty($cart['name'])) {
                        $carts = [];
                    }
                }
            }

            $product = Product::where('code', $state)->first();
            if (isset($product)) {

                Notification::make()
                    ->icon('heroicon-o-x-circle')
                    ->success()
                    ->title('สำเร็จ!')
                    ->body('เพิ่มสินค้าเข้าตำกร้าเรียบร้อย')
                    ->duration(1000)
                    ->send();

                if (count($carts) == 0) {
                    Log::warning("ไม่มีสินค้าในตะกร้า");
                    array_push($carts, [
                        'code' => $product->code,
                        'name' => $product->name,
                        'price' => $product->price,
                        'image' => [$product->image],
                        'qty' => $get('product_qty')
                    ]);
                } else {
                    Log::warning("มีสินค้าในตะกร้า");
                    $checkHas = false;
                    foreach ($carts as &$cart) {
                        if ($cart['code'] == $state) {
                            $cart['qty'] += $get('product_qty');
                            $checkHas = true;
                            break;
                        }
                    }

                    if ($checkHas == false) {
                        array_push($carts, [
                            'code' => $product->code,
                            'name' => $product->name,
                            'price' => $product->price,
                            'image' => [$product->image],
                            'qty' => 1
                        ]);
                    }
                }
                Log::info($carts);
                $set('products', $carts);

                self::updateTotals($set, $get, $livewire);

                $set('product_code', '');
                $set('product', '');
            } else {

                Notification::make()
                    ->icon('heroicon-o-x-circle')
                    ->danger()
                    ->title('แจ้งเตือน!')
                    ->body('ไม่พบสินค้าในระบบ')
                    ->send();
            }
        }
    }

    public static function updateTotals(Forms\Set $set, Forms\Get $get, $livewire): void
    {
        $items = $get('products');
        Log::info($items);
        $price = 0;
        foreach ($items as $item) {
            $price += (int)$item['price'] * (int)$item['qty'];
        }
        $set('price_total', $price);
        Log::info('ราคาสุทธิ');
        Log::info($price);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                // Tables\Columns\TextColumn::make('created_by')
                //     ->numeric()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_by')
                //     ->numeric()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('deleted_by')
                //     ->numeric()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('deleted_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(auth()->user()->hasRole('administrator')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrders::route('/create'),
            'view' => Pages\ViewOrders::route('/{record}'),
            'edit' => Pages\EditOrders::route('/{record}/edit'),
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
