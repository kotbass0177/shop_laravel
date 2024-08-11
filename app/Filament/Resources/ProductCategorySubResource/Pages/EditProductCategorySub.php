<?php

namespace App\Filament\Resources\ProductCategorySubResource\Pages;

use App\Filament\Resources\ProductCategorySubResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductCategorySub extends EditRecord
{
    protected static string $resource = ProductCategorySubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
