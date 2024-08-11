<?php

namespace App\Filament\Pages;

use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults as PagesHealthCheckResults;
use Spatie\Health\Commands\RunHealthChecksCommand;

class HealthCheckResults extends PagesHealthCheckResults
{
  use HasPageShield;

  public static function getNavigationGroup(): ?string
  {
    return __('การตรวจสอบแอปพลิเคชัน');
  }
  public function getTitle(): string
  {
    return __('filament-spatie-health::health.pages.health_check_results.navigation.label');
  }

  public function refresh(): void
  {
    Artisan::call(RunHealthChecksCommand::class);

    $this->dispatch('refresh-component');

    Notification::make()
      ->title(__('ตรวจสอบสุขภาพแอปพลิเคชันเรียบร้อยแล้ว'))
      ->success()
      ->send();
  }
}