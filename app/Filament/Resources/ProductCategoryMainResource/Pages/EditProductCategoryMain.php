<?php

namespace App\Filament\Resources\ProductCategoryMainResource\Pages;

use App\Filament\Resources\ProductCategoryMainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductCategoryMain extends EditRecord
{
    protected static string $resource = ProductCategoryMainResource::class;

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
