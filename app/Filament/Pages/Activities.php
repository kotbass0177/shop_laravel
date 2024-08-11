<?php

namespace App\Filament\Pages;

use Noxo\FilamentActivityLog\Pages\ListActivities;

class Activities extends ListActivities
{
    protected static bool $shouldRegisterNavigation = false;
    // protected bool $isCollapsible = true;

    // protected bool $isCollapsed = false;

    // public function getTitle(): string
    // {
    //     return __('filament-activity-log::activities.title');
    // }

    // public static function getNavigationLabel(): string
    // {
    //     return __('filament-activity-log::activities.title');
    // }
}
