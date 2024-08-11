<?php

namespace App\Providers;

use App\Forms\Components\DateTimePicker;
use App\Policies\ExceptionPolicy;
use BezhanSalleh\FilamentExceptions\Models\Exception;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\QueueCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        $this->app->register(TelescopeServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Table::$defaultDateDisplayFormat = \config('displayDateFormat', 'd/m/Y');
        Table::$defaultDateTimeDisplayFormat = \config('displayDateTimeFormat', 'd/m/Y H:i:s');
        Table::$defaultTimeDisplayFormat = \config('displayTimeFormat', 'H:i:s');

        DateTimePicker::$defaultDateDisplayFormat = \config('displayDateFormat', 'd/m/Y');
        DateTimePicker::$defaultDateTimeDisplayFormat = \config('displayDateTimeFormat', 'd/m/Y H:i:s');
        DateTimePicker::$defaultTimeDisplayFormat = \config('displayTimeFormat', 'H:i:s');
        DateTimePicker::configureUsing(function (DateTimePicker $component) {
            $component
                ->native(false)
                ->closeOnDateSelection();
        });

        // DatePicker::$defaultDateDisplayFormat = \config('displayDateFormat', 'd/m/Y');
        // DatePicker::$defaultDateTimeDisplayFormat = \config('displayDateTimeFormat', 'd/m/Y H:i:s');
        // DatePicker::$defaultTimeDisplayFormat = \config('displayTimeFormat', 'H:i:s');

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('google', \SocialiteProviders\Google\Provider::class);
        });

        if (env('APP_FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }

        Gate::policy(Exception::class, ExceptionPolicy::class);
        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/custom.css')->loadedOnRequest(),
            AlpineComponent::make('date-time-picker', __DIR__ . '/../../resources/js/dist/components/date-time-picker.js'),

        ]);
        FilamentColor::register([
            'indigo' => Color::Indigo,
        ]);

        Health::checks([
            OptimizedAppCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            DatabaseCheck::new(),
            RedisCheck::new(),
            CacheCheck::new(),
            QueueCheck::new(),
            ScheduleCheck::new(),
            UsedDiskSpaceCheck::new(),
            SecurityAdvisoriesCheck::new(),
        ]);

        Feature::discover();
    }
}
