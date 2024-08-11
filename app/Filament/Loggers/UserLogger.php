<?php

namespace App\Filament\Loggers;

use App\Models\User;
use App\Filament\Resources\UserResource;
use Illuminate\Contracts\Support\Htmlable;
use Noxo\FilamentActivityLog\Loggers\Logger;
use Noxo\FilamentActivityLog\ResourceLogger\Field;
use Noxo\FilamentActivityLog\ResourceLogger\RelationManager;
use Noxo\FilamentActivityLog\ResourceLogger\ResourceLogger;
use Spatie\Activitylog\Models\Activity;

class UserLogger extends Logger
{
    public static ?string $model = User::class;

    public static function getLabel(): string | Htmlable | null
    {
        return UserResource::getModelLabel();
    }

    public function getSubjectRoute(Activity $activity): ?string
    {
        return UserResource::getUrl('edit', ['record' => $activity->subject_id]);
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
                    ->label(__(User::$attributeLabels['name'])),
                Field::make('email')
                    ->label(__(User::$attributeLabels['email'])),
                Field::make('mobile_no')
                    ->label(__(User::$attributeLabels['mobile_no'])),

                Field::make('jobTitle.name')
                    ->label(__(User::$attributeLabels['jobTitle']))
                    ->hasOne('jobTitle')
                    ->badge(),

                Field::make('active')
                    ->label(__(User::$attributeLabels['active']))
                    ->boolean(),
                Field::make('username')
                    ->label(__(User::$attributeLabels['username'])),
                Field::make('roles.name')
                    ->label(__(User::$attributeLabels['roles']))
                    ->hasMany('roles')
                    ->badge(),
            ])
            ->relationManagers([
                //
            ]);
    }
}
