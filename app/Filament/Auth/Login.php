<?php
namespace App\Filament\Auth;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseAuth;
use Illuminate\Validation\ValidationException;

class Login extends BaseAuth
{
  // ...
  protected function getForms(): array
  {
    return [
      'form' => $this->form(
        $this->makeForm()
          ->schema([
            $this->getUserFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getRememberFormComponent(),
          ])
          ->statePath('data'),
      ),
    ];
  }
  protected function getUserFormComponent(): Component
  {
    return TextInput::make('user')
    ->label(__('ชื่อผู้ใช้งานหรืออีเมลล์'))
    ->required()
    ->autocomplete()
    ->autofocus()
    ->extraInputAttributes(['tabindex' => 1]);
  }
  protected function throwFailureValidationException(): never
  {
    throw ValidationException::withMessages([
      'data.user' => __('filament-panels::pages/auth/login.messages.failed'),
    ]);
  }
  protected function getCredentialsFromFormData(array $data): array
  {
    $field = filter_var($data['user'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    return [
      $field => $data['user'],
      'password'  => $data['password'],
      'active' => true
    ];
  }

  // public function getExtraBodyAttributes(): array
  // {
  //   return [
  //     'style' => 'background-color: red',
  //   ];
  // }
}