<?php

namespace App\Filament\Resources\ProductCategoryMainResource\Pages;

use App\Filament\Resources\ProductCategoryMainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductCategoryMains extends ListRecords
{
    protected static string $resource = ProductCategoryMainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
