<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TokenResource\Pages;
use App\Filament\Resources\TokenResource\RelationManagers;
use App\Forms\Components\DatePicker;
use App\Models\Token;
use BezhanSalleh\FilamentShield\FilamentShield;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Jeffgreco13\FilamentBreezy\Livewire\SanctumTokens;
use Rupadana\ApiService\ApiServicePlugin;

class TokenResource extends Resource
{
    protected static ?string $model = Token::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $modelLabel = 'API Token';
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return Utils::isResourceNavigationGroupEnabled()
            ? __('filament-shield::filament-shield.nav.group')
            : '';
    }
    public static function getNavigationLabel(): string
    {
        return __('filament-breezy::default.profile.sanctum.title');
    }

    public static function form(Form $form,): Form
    {
        return $form
            ->schema(static::getSanctumFormSchema());
    }

    public static function table(Table $table): Table
    {
        $searchableLabels = [
            __('filament-breezy::default.fields.token_name')
        ];
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('filament-breezy::default.fields.token_name')),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->label(__('filament-breezy::default.fields.created'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('expires_at')
                    ->color(fn ($record) => now()->gt($record->expires_at) ? 'danger' : null)
                    ->date()
                    ->label(__('filament-breezy::default.fields.expires'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('abilities')
                    ->badge()
                    ->label(__('filament-breezy::default.fields.abilities'))
                    ->getStateUsing(fn ($record) => count($record->abilities)),
            ])
            ->searchPlaceholder(__('ค้นหา') . ' (' . \implode(', ', $searchableLabels) . ')')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTokens::route('/'),
            'create' => Pages\CreateToken::route('/create'),
            'edit' => Pages\EditToken::route('/{record}/edit'),
        ];
    }

    public static function getSanctumFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label(__('filament-breezy::default.fields.token_name'))
                ->required()
                ->disabled(fn ($operation) => $operation === 'edit'),
            DatePicker::make('expires_at')
                ->label(__('filament-breezy::default.fields.token_expiry')),
            // CheckboxList::make('abilities')
            //   ->label(__('filament-breezy::default.fields.abilities'))
            //   ->options(filament('filament-breezy')->getSanctumPermissions())
            //   ->columns($this->abilityColumns)
            //   ->required(),
            // Section::make('Abilities')
            //   ->label(__('filament-breezy::default.fields.abilities'))
            //   ->description('Select abilities of the token')
            //   ->schema(static::getAbilitiesSchema())
            //   ->columns([
            //     'sm' => 2,
            //     'lg' => 4,
            //   ]),
            Fieldset::make('Abilities')
                ->label(__('filament-breezy::default.fields.abilities'))
                ->schema(static::getAbilitiesSchema())
                ->columns([
                    'sm' => 2,
                    'lg' => 3,
                ])
                ->columnSpanFull(),
        ];
    }

    public static function getAbilitiesSchema(): array
    {
        $schema = [];

        $abilities = ApiServicePlugin::getAbilities(Filament::getCurrentPanel());

        foreach ($abilities as $resource => $handler) {
            $extractedAbilities = [];
            foreach ($handler as $handlerClass => $ability) {
                foreach ($ability as $a) {
                    $extractedAbilities[$a] = $a;
                }
            }
            $schema[] = 
                // Section::make(str($resource)->beforeLast('Resource')->explode('\\')->last())
                //     ->description($resource)
                Section::make(FilamentShield::getLocalizedResourceLabel($resource))
                    // ->description($resource)
                    ->schema([
                        CheckboxList::make('abilities')
                            ->label(false)
                            ->options($extractedAbilities)
                            ->bulkToggleable(),
                    ])
                    ->columnSpan(1)
                    ->collapsible();
        }

        return $schema;
    }
}
