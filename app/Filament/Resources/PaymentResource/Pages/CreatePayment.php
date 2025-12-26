<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()
            ->label('Registrar Pago');
    }

    protected function getCreateAnotherFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateAnotherFormAction()
            ->hidden();
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label('Cancelar');
    }

    public function getTitle(): string
    {
        return 'Registrar Pago';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('¡Pago registrado!')
            ->body('El pago ha sido registrado exitosamente.');
    }
}

