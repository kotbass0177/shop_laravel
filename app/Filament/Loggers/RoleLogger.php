<?php

namespace App\Filament\Loggers;

use App\Filament\Resources\Shield\RoleResource;
use App\Models\Role;
use Illuminate\Contracts\Support\Htmlable;
use Noxo\FilamentActivityLog\Loggers\Logger;
use Noxo\FilamentActivityLog\ResourceLogger\Field;
use Noxo\FilamentActivityLog\ResourceLogger\RelationManager;
use Noxo\FilamentActivityLog\ResourceLogger\ResourceLogger;
use Spatie\Activitylog\Models\Activity;

class RoleLogger extends Logger
{
    public static ?string $model = Role::class;

    public static function getLabel(): string | Htmlable | null
    {
        return RoleResource::getModelLabel();
    }

    public function getSubjectRoute(Activity $activity): ?string
    {
        return RoleResource::getUrl('edit', ['record' => $activity->subject_id]);
    }

    public function getRelationManagerRoute(Activity $activity): ?string
    {
        return $this->getSubjectRoute($activity) . '?activeRelationManager=0';
    }

    public static function resource(ResourceLogger $logger): ResourceLogger
    {
        return $logger
            ->fields([
                Field::make('name')
                    ->label(__(Role::$attributeLabels['name'])),
                Field::make('guard_name')
                    ->label(__(Role::$attributeLabels['guard_name'])),
                Field::make('active')
                    ->label(__(Role::$attributeLabels['active']))
                    ->boolean(),
                Field::make('permissions.name')
                    ->label(__(Role::$attributeLabels['permissions']))
                    ->hasMany('permissions')
                    ->badge(),
            ])
            ->relationManagers([
                //
            ]);
    }
}
