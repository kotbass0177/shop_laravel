<?php

namespace App\Filament\Resources\TokenResource\Pages;

use App\Filament\Resources\TokenResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateToken extends CreateRecord
{
    protected static string $resource = TokenResource::class;
    public $plainTextToken;

    protected function handleRecordCreation(array $data): Model
    {
        // $this->plainTextToken = $this->user->createToken($data['token_name'], array_values($data['abilities']), $data['expires_at'] ? Carbon::createFromFormat('Y-m-d', $data['expires_at']) : null)->plainTextToken;
        // Notification::make()
        //     ->success()
        //     ->title(__('filament-breezy::default.profile.sanctum.create.notify'))
        //     ->send();
        $token = \auth()->user()->createToken($data['name'], array_values($data['abilities']), $data['expires_at'] ? Carbon::createFromFormat('Y-m-d', $data['expires_at']) : null);
        $this->plainTextToken = $token->plainTextToken;
        return $token->accessToken;
    }

    protected function getCreatedNotification(): ?Notification
    {
        $message = __('filament-breezy::default.profile.sanctum.create.message');
        $body =<<<body
            <div class="space-y-2">
                <p class="text-sm">{$message}</p>
                <p class="text-xl p-2 rounded-lg bg-gray-100 text-danger-600">{$this->plainTextToken}</p>
            </div>
body;


        return Notification::make()
            ->success()
            ->title(__('filament-breezy::default.profile.sanctum.create.notify'))
            ->body($body)
            ->persistent()
            ->actions([
                Action::make('Copied')
                    ->label(__('filament-breezy::default.profile.sanctum.copied.label'))
                    ->button()
                    ->close(),
            ])
            ->send();
    }

    protected function getRedirectUrl(): string
    {
        return  $this->getResource()::getUrl('index');
    }
}
