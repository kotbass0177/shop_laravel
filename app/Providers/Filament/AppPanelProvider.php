<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login;
use App\Filament\Pages\Activities;
use App\Filament\Pages\auth\MyProfile;
use App\Filament\Pages\HealthCheckResults;
use App\Filament\Resources\Shield\RoleResource;
use App\Livewire\BrowserSession;
use App\Livewire\SanctumTokens;
use BezhanSalleh\FilamentExceptions\FilamentExceptionsPlugin;
use BezhanSalleh\FilamentExceptions\Models\Exception;
use BezhanSalleh\FilamentExceptions\Resources\ExceptionResource\Pages\ListExceptions;
use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use Filament\FontProviders\SpatieGoogleFontProvider;
use Filament\Forms\Components\FileUpload;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationBuilder;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Laravel\Socialite\Contracts\User as SocialiteUserContract;
use App\Filament\Plugins\ApiServicePlugin;
use App\Filament\Version\AppVersionProvider;
use Awcodes\FilamentVersions\VersionsPlugin;
use Awcodes\FilamentVersions\VersionsWidget;
use Illuminate\Contracts\View\View;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->maxContentWidth('8xl')
            ->id('app')
            ->path('/app')
            ->login(Login::class)
            ->passwordReset()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->spa()
            // ->unsavedChangesAlerts()
            ->databaseTransactions()
            ->sidebarCollapsibleOnDesktop()
            // ->topNavigation()
            ->font('Anuphan', provider: SpatieGoogleFontProvider::class)
            // ->font('Anuphan')
            ->viteTheme('resources/css/filament/app/theme.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
                // VersionsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                SetTheme::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->resources([
                // config('filament-logger.activity_resource')
                // RoleResource::class
            ])
            ->plugins([
                \BezhanSalleh\FilamentExceptions\FilamentExceptionsPlugin::make(),
                BreezyCore::make()
                    ->myProfile(
                        hasAvatars: true,
                    )
                    ->myProfileComponents([
                        'browser_session' => BrowserSession::class,
                        // 'sanctum_tokens' => SanctumTokens::class
                    ])
                    ->avatarUploadComponent(fn () => FileUpload::make('avatar_url')->label('รูปประจำตัว')->avatar()->directory('profile-photos')->visibility('private'))
                    // ->enableSanctumTokens()
                    ->customMyProfilePage(MyProfile::class)
                    ->enableTwoFactorAuthentication(
                        force: false // force the user to enable 2FA before they can use the application (default = false)
                        // action: CustomTwoFactorPage::class // optionally, use a custom 2FA page
                    ),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 3,
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 1,
                        'md' => 2,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
                FilamentSocialitePlugin::make()
                    // (required) Add providers corresponding with providers in `config/services.php`.
                    ->setProviders([
                        'google' => [
                            'label' => 'Google',
                            // Custom icon requires an additional package, see below.
                            'icon' => 'fab-google',
                            // (optional) Button color override, default: 'gray'.
                            'color' => 'primary',
                            // // (optional) Button style override, default: true (outlined).
                            'outlined' => true,
                        ],
                    ])
                    ->setRegistrationEnabled(fn (string $provider, SocialiteUserContract $oauthUser, ?Authenticatable $user) => (bool) $user),
                ThemesPlugin::make()
                    ->canViewThemesPage(fn () => auth()->user()?->can('page_Themes') ?? false),
                ApiServicePlugin::make(),
                FilamentSpatieLaravelHealthPlugin::make()
                    ->usingPage(HealthCheckResults::class),
                VersionsPlugin::make()
                ->hasDefaults(false)
                    ->items([
                        new AppVersionProvider(),
                    ]),
                // \Stephenjude\FilamentFeatureFlag\FeatureFlagPlugin::make(),
            ])
            ->databaseNotifications()
            ->userMenuItems([
                MenuItem::make()
                    ->label('Exceptions')
                    ->icon('heroicon-o-cpu-chip')
                    ->visible(fn (): bool => auth()->user()?->can('view_any_exception') ?? false)
                    ->url(fn (): string => ListExceptions::getUrl()),
                MenuItem::make()
                    ->label(__('ประวัติกิจกรรม'))
                    ->icon('heroicon-o-finger-print')
                    ->visible(fn (): bool => auth()->user()?->can('page_Activities') ?? false)
                    ->url(fn (): string => Activities::getUrl())
            ]);
    }

    public function register(): void
    {
        parent::register();
        if (\app()->isLocal()) {
            FilamentView::registerRenderHook(PanelsRenderHook::BODY_END, fn (): string => Blade::render("@vite('resources/js/app.js')"));
        }
        FilamentView::registerRenderHook(PanelsRenderHook::HEAD_START, fn (): View => view('clarity::components.script'));
        // FilamentView::registerRenderHook(PanelsRenderHook::HEAD_START, fn (): string => Blade::render('@googlefonts'));
    }
}
