<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Noxo\FilamentActivityLog\Extensions\LogCreateRecord;

class CreateUser extends CreateRecord
{
    use LogCreateRecord;

    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return  $this->getResource()::getUrl('index');
    }
    
    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['password'] = Hash::make($data['password']);
    //     unset($data['confirmPassword']);

    //     return $data;
    // }
}
