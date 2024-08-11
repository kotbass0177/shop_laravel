<?php

namespace App\Livewire;

use App\Filament\Agent;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Jeffgreco13\FilamentBreezy\Actions\PasswordButtonAction;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;
use Throwable;

class BrowserSession extends MyProfileComponent
{
    protected string $view = 'livewire.browser-session';

    // public ?array $data = [];
    // protected $user;
    // protected $sessions;

    public static $sort = 40;

    public function mount()
    {
        // $this->user = Filament::getCurrentPanel()->auth()->user();
        // $this->sessions = $this->sessions();
    }

    public function isUsingDatabaseDriver(): bool
    {
        return config('session.driver') === 'database';
    }

    public function sessions(): Collection
    {
        if (!$this->isUsingDatabaseDriver()) {
            return collect();
        }

        return collect(
            $this->sessionsDb()
                ->orderBy('last_activity', 'desc')
                ->get(),
        )->map(function ($session) {
            return (object) [
                'id' => Crypt::encryptString($session->id),
                'agent' => $this->createAgent($session),
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === session()->getId(),
                'last_active' => Date::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    public function revokeAction(): Action
    {
        return Action::make('revoke')
            ->color('danger')
            ->label(__('ยกเลิกเซสชัน'))
            ->size('sm')
            ->form([
                $this->getPasswordInput(),
            ])
            ->modalSubmitActionLabel(__('ยกเลิกเซสชัน'))
            ->modalWidth('lg')
            ->action(function (array $arguments, Form $form) {
                /** @var string $sessionId */
                $sessionId = rescue(fn () => Crypt::decryptString($arguments['session'] ?? ''));

                if (!$sessionId) {
                    return;
                }

                $this->deleteSessionById($sessionId, $form->getState()['password']);

                Notification::make()
                    ->success()
                    ->title(__('เซสชันถูกยกเลิกแล้ว'))
                    ->send();
            });
    }

    public function revokeAllAction(): Action
    {
        return Action::make('revokeAll')
            ->color('danger')
            ->label(__('ยกเลิกเซสชันอื่นๆ ทั้งหมด'))
            ->size('sm')
            ->form([
                $this->getPasswordInput(),
            ])
            ->modalWidth('lg')
            ->modalSubmitActionLabel(__('ยกเลิกเซสชันอื่นๆ ทั้งหมด'))
            ->modalHeading(__('ยกเลิกเซสชันอื่นๆ ทั้งหมด'))
            ->action(function (Form $form) {
                Auth::logoutOtherDevices($form->getState()['password']);

                $this->deleteOtherSessions();

                session()->put([
                    "password_hash_{$this->getGuard()}" => Filament::auth()->user()->getAuthPassword(),
                ]);

                Notification::make()
                    ->success()
                    ->title(__('เซสชันอื่นๆ ทั้งหมดถูกยกเลิกแล้ว'))
                    ->send();
            });
    }

    protected function getPasswordInput(): Component
    {
        return TextInput::make('password')
            ->password()
            ->label(__('รหัสผ่านของคุณ'))
            ->helperText(__('จำเป็นต้องใช้รหัสผ่านของคุณเพื่อบังคับให้ยกเลิกเซสชันที่อาจมีการตั้งค่าคุกกี้ "จำฉัน"'))
            ->currentPassword()
            ->required();
    }

    protected function deleteSessionById(string $sessionId, string $password): void
    {
        if (!$this->isUsingDatabaseDriver()) {
            return;
        }

        Filament::auth()->user()->forceFill([
            'password' => $password,
        ])->save();

        session()->put([
            "password_hash_{$this->getGuard()}" => Filament::auth()->user()->getAuthPassword(),
        ]);

        $this->sessionsDb()
            ->whereNotIn('id', [session()->getId(), $sessionId])
            ->select(['id', 'payload'])
            ->cursor()
            ->each(function (object $session) {
                try {
                    $payload = unserialize(base64_decode($session->payload));

                    $payload["password_hash_{$this->getGuard()}"] = Filament::auth()->user()->getAuthPassword();

                    $this->sessionsDb()
                        ->where('id', $session->id)
                        ->update([
                            'payload' => base64_encode(serialize($payload)),
                        ]);
                } catch (Throwable) {
                }
            });

        $this->sessionsDb()
            ->where('id', $sessionId)
            ->delete();
    }

    protected function deleteOtherSessions(): void
    {
        if (!$this->isUsingDatabaseDriver()) {
            return;
        }

        $this->sessionsDb()
            ->where('id', '!=', session()->getId())
            ->delete();
    }

    protected function createAgent(object $session): Agent
    {
        return tap(new Agent, fn (Agent $agent) => $agent->setUserAgent($session->user_agent));
    }

    // protected function view(): string
    // {
    //   return 'profile-filament::livewire.sessions.session-manager';
    // }

    protected function sessionsDb(): Builder
    {
        return DB::connection(config('session.connection'))
            ->table(config('session.table', 'sessions'))
            ->where('user_id', Filament::auth()->id());
    }

    protected function getGuard(): string
    {
        return Filament::getCurrentPanel()?->getAuthGuard()
            ?? Auth::getDefaultDriver();
    }

    // public function enableAction(): Action
    // {
    //   return PasswordButtonAction::make('enable')
    //     ->label(__('filament-breezy::default.profile.2fa.actions.enable'))
    //     ->action(function () {
    //       // sleep(1);
    //       $this->user->enableTwoFactorAuthentication();
    //       Notification::make()
    //         ->success()
    //         ->title(__('filament-breezy::default.profile.2fa.enabled.notify'))
    //         ->send();
    //     });
    // }

    // public function disableAction(): Action
    // {
    //   return PasswordButtonAction::make('disable')
    //     ->label(__('filament-breezy::default.profile.2fa.actions.disable'))
    //     ->color('primary')
    //     ->requiresConfirmation()
    //     ->action(function () {
    //       $this->user->disableTwoFactorAuthentication();
    //       Notification::make()
    //         ->warning()
    //         ->title(__('filament-breezy::default.profile.2fa.disabling.notify'))
    //         ->send();
    //     });
    // }

    // public function confirmAction(): Action
    // {
    //   return Action::make('confirm')
    //     ->color('success')
    //     ->label(__('filament-breezy::default.profile.2fa.actions.confirm_finish'))
    //     ->modalWidth('sm')
    //     ->form([
    //       Forms\Components\TextInput::make('code')
    //         ->label(__('filament-breezy::default.fields.2fa_code'))
    //         ->placeholder('###-###')
    //         ->required(),
    //     ])
    //     ->action(function ($data, $action, $livewire) {
    //       if (!filament('filament-breezy')->verify(code: $data['code'])) {
    //         $livewire->addError('mountedActionsData.0.code', __('filament-breezy::default.profile.2fa.confirmation.invalid_code'));
    //         $action->halt();
    //       }
    //       $this->user->confirmTwoFactorAuthentication();
    //       $this->user->setTwoFactorSession();
    //       Notification::make()
    //         ->success()
    //         ->title(__('filament-breezy::default.profile.2fa.confirmation.success_notification'))
    //         ->send();
    //     });
    // }

    // public function regenerateCodesAction(): Action
    // {
    //   return PasswordButtonAction::make('regenerateCodes')
    //     ->label(__('filament-breezy::default.profile.2fa.actions.regenerate_codes'))
    //     ->requiresConfirmation()
    //     ->action(function () {
    //       // These needs to regenerate the codes, then show the section.
    //       $this->user->reGenerateRecoveryCodes();
    //       $this->showRecoveryCodes = true;
    //       Notification::make()
    //         ->success()
    //         ->title(__('filament-breezy::default.profile.2fa.regenerate_codes.notify'))
    //         ->send();
    //     });
    // }

    // public function getRecoveryCodesProperty(): Collection
    // {
    //   return collect($this->user->two_factor_recovery_codes ?? []);
    // }

    // public function getTwoFactorQrCode()
    // {
    //   return filament('filament-breezy')->getTwoFactorQrCodeSvg($this->user->getTwoFactorQrCodeUrl());
    // }

    // public function toggleRecoveryCodes()
    // {
    //   $this->showRecoveryCodes = !$this->showRecoveryCodes;
    // }

    // public function showRequiresTwoFactorAlert()
    // {
    //   return filament('filament-breezy')->shouldForceTwoFactor();
    // }
}
