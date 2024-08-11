<?php

namespace App\Filament\Resources\ProductCategoryMainResource\Pages;

use App\Filament\Resources\ProductCategoryMainResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductCategoryMain extends ViewRecord
{
    protected static string $resource = ProductCategoryMainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
