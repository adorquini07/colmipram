<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;

    protected function getCreateFormAction(): \Filament\Actions\Action
    {
        return parent::getCreateFormAction()
            ->label('Crear');
    }

    // Ocultar el botón "Crear y crear otro"
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
        return 'Crear Curso';
    }

    // Redirigir al listado después de crear
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Mensaje de éxito personalizado
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('¡Curso creado!')
            ->body('El curso ha sido creado exitosamente.');
    }
}

