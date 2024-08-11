<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Ysfkaya\FilamentPhoneInput\Tables\PhoneColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 2;
    // protected static ?string $navigationIcon = 'gmdi-image-search-tt';

    public static function getNavigationGroup(): ?string
    {
        return Utils::isResourceNavigationGroupEnabled()
            ? __('filament-shield::filament-shield.nav.group')
            : '';
    }

    public static function getNavigationLabel(): string
    {
        return __('จัดการผู้ใช้งาน');
    }

    public static function getModelLabel(): string
    {
        return __('ผู้ใช้งาน');
    }

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Split::make([
                    Section::make('personal_info')
                        ->heading(__('ข้อมูลส่วนตัว'))
                        ->description(__('จัดการข้อมูลส่วนตัว เช่น ชื่อ-นามสกุล, อีเมล, โทรศัพท์มือถือ'))
                        // ->aside()
                        ->schema([
                            TextInput::make('name')
                                ->label(__(User::$attributeLabels['name']))
                                ->required(),
                            TextInput::make('email')
                                ->label(__(User::$attributeLabels['email']))
                                ->email()
                                ->unique(ignoreRecord: true)
                                ->required(),
                            PhoneInput::make('mobile_no')
                                ->label(__(User::$attributeLabels['mobile_no']))
                            // ->required()
                            ,
                            Select::make('job_title_id')
                                ->label(__(User::$attributeLabels['jobTitle']))
                                ->relationship('jobTitle', 'name')
                                ->preload()
                                ->searchable()
                            // ->required()
                            ,
                            Toggle::make('active')
                                ->label(__(User::$attributeLabels['active']))
                                ->onIcon('heroicon-m-check')
                                ->offIcon('heroicon-m-x-mark')
                                // ->offColor('danger')
                                ->onColor('success')
                                // ->inline(false)

                        ])->columns(2),
                    Section::make('user_info')
                        ->heading(__('ข้อมูลผู้ใช้งานในระบบ'))
                        ->description(__('ข้อมูลผู้ใช้งานในระบบ'))
                        // ->aside()
                        ->schema([
                            TextInput::make('username')
                                ->label(__(User::$attributeLabels['username']))
                                ->unique(ignoreRecord: true)
                            // ->required()
                            ,
                            TextInput::make('password')
                                ->label(__(User::$attributeLabels['password']))
                                ->revealable()
                                ->password()
                                // ->rules([
                                //     Password::default()->mixedCase()->uncompromised(3),
                                // ])
                                ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                ->dehydrated(fn (?string $state): bool => filled($state))
                                ->required(fn (string $operation): bool => $operation == 'create'),
                            TextInput::make('confirmPassword')
                                ->label(__(User::$attributeLabels['confirmPassword']))
                                ->revealable()
                                ->password()
                                ->same('password')
                                ->dehydrated(false)
                                ->required(fn (string $operation, Get $get): bool => $operation == 'create' || !empty($get('password'))),
                            Select::make('roles')
                                ->label(__(User::$attributeLabels['roles']))
                                ->relationship('roles', 'name')
                                ->multiple()
                                ->preload()
                                ->required()
                                ->searchable(),
                        ])->grow(false),
                ])
                    ->columnSpanFull()
                    ->from('md'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $searchableLabels = [
            __(User::$attributeLabels['name']),
            __(User::$attributeLabels['email']),
            __(User::$attributeLabels['mobile_no']),
            __(User::$attributeLabels['username']),
        ];
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__(User::$attributeLabels['name']))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__(User::$attributeLabels['email']))
                    ->searchable(),
                PhoneColumn::make('mobile_no')
                    ->label(__(User::$attributeLabels['mobile_no']))
                    ->displayFormat(PhoneInputNumberType::NATIONAL)
                    ->searchable(),
                TextColumn::make('username')
                    ->label(__(User::$attributeLabels['username']))
                    ->searchable()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('roles.name')
                    ->label(__(Role::$attributeLabels['name'])),
                IconColumn::make('active')
                    ->label(__(Role::$attributeLabels['active']))
                    ->boolean(),
                TextColumn::make('updatedBy.name')
                    ->label(__(User::$attributeLabels['updated_by']))
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                TextColumn::make('updated_at')
                    ->label(\__(User::$attributeLabels['updated_at']))
                    ->dateTime()
                    ->toggleable()
                    ->toggledHiddenByDefault(),
            ])
            ->searchPlaceholder(__('ค้นหา') . ' (' . \implode(', ', $searchableLabels) . ')')
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
                // TernaryFilter::make('active')
                //     ->label(__(Role::$attributeLabels['active']))
                //     ->placeholder(__('ทั้งหมด')),
                SelectFilter::make('roles')
                    ->label(__(Role::$attributeLabels['name']))
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
            ])
            // ->filtersTriggerAction(
            //     fn (Action $action) => $action
            //         ->button()
            //     ->slideOver(),
            // )
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
