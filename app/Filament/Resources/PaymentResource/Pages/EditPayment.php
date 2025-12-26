<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPayment extends EditRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Eliminar'),
        ];
    }

    protected function getSaveFormAction(): \Filament\Actions\Action
    {
        return parent::getSaveFormAction()
            ->label('Guardar Cambios');
    }

    protected function getCancelFormAction(): \Filament\Actions\Action
    {
        return parent::getCancelFormAction()
            ->label('Cancelar');
    }

    public function getTitle(): string
    {
        return 'Editar Pago';
    }
}

