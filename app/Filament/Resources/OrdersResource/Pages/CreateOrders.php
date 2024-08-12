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

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            $this->getCreateFormAction()
                ->label('บันทึกการขาย'),
            $this->getCancelFormAction(),
            // $this->getCreateAnotherFormAction(),
        ];
    }

    protected function getFormActions(): array
    {
        // return [
        //     $this->getCreateFormAction(),
        //     $this->getCancelFormAction()
        // ];
        return [];
    }

    protected function beforeCreate(): void
    {
        dd($this->record);
    }
    protected function afterCreate(): void
    {
        //dd($this->record);
    }
    
}
