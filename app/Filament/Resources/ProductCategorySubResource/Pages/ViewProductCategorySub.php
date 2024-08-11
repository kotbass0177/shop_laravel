<?php

namespace App\Filament\Resources\ProductCategorySubResource\Pages;

use App\Filament\Resources\ProductCategorySubResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductCategorySub extends ViewRecord
{
    protected static string $resource = ProductCategorySubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
