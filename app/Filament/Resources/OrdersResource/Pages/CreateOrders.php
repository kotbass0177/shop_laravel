<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\OrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrders extends CreateRecord
{
    protected static string $resource = OrdersResource::class;

    protected function getCreateFormAction(): Actions\Action
    {
        return parent::getCreateFormAction()->extraAttributes(['type' => 'button', 'wire:click' => 'create']);
    }

    protected function beforeCreate(): void
    {
        // dd($this->record);
    }
    protected function afterCreate(): void
    {
        //dd($this->record);
    }
    
}
