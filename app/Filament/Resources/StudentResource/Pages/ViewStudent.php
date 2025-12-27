<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\Student;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewStudent extends Page
{
    use InteractsWithRecord;

    protected static string $resource = StudentResource::class;

    protected string $view = 'filament.resources.student-resource.pages.view-student';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->record->load(['course.teacher', 'payments']);
    }

    public function getTitle(): string|Htmlable
    {
        return 'Detalle del Estudiante';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('registrar_pago')
                ->label('Registrar Pago')
                ->icon('heroicon-o-banknotes')
                ->color('success')
                ->modalSubmitActionLabel('Guardar Pago')
                ->modalCancelActionLabel('Cancelar')
                ->visible(fn (): bool => !$this->record->hasPaidCurrentMonth())
                ->form([
                    Select::make('type')
                        ->label('Tipo de Pago')
                        ->options([
                            'matricula' => 'Matrícula',
                            'mensualidad' => 'Mensualidad',
                        ])
                        ->default('mensualidad')
                        ->required()
                        ->native(false),
                    TextInput::make('amount')
                        ->label('Monto')
                        ->numeric()
                        ->prefix('$')
                        ->required()
                        ->minValue(0),
                    Select::make('month')
                        ->label('Mes')
                        ->options([
                            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
                        ])
                        ->default(now()->month)
                        ->required()
                        ->native(false),
                    TextInput::make('year')
                        ->label('Año')
                        ->numeric()
                        ->default(now()->year)
                        ->required(),
                    DatePicker::make('payment_date')
                        ->label('Fecha de Pago')
                        ->default(now())
                        ->required()
                        ->displayFormat('d/m/Y'),
                    Textarea::make('notes')
                        ->label('Notas')
                        ->rows(2),
                ])
                ->action(function (array $data): void {
                    $this->record->payments()->create($data);
                    
                    Notification::make()
                        ->success()
                        ->title('¡Pago registrado!')
                        ->body('El pago ha sido registrado exitosamente.')
                        ->send();
                    
                    $this->redirect(StudentResource::getUrl('view', ['record' => $this->record]));
                }),
            Actions\EditAction::make()
                ->label('Editar')
                ->url(fn (): string => StudentResource::getUrl('edit', ['record' => $this->record])),
        ];
    }

    public function getPaymentsByYear(): array
    {
        return $this->record->payments()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get()
            ->groupBy('year')
            ->toArray();
    }

    public function getMonthName(int $month): string
    {
        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
        ];
        return $months[$month] ?? '';
    }

    public function getTypeLabel(string $type): string
    {
        return match($type) {
            'matricula' => 'Matrícula',
            'mensualidad' => 'Mensualidad',
            default => $type,
        };
    }

    public function formatMoney(float $amount): string
    {
        return '$ ' . number_format($amount, 0, ',', '.');
    }

    public function formatDate(string $date): string
    {
        return \Carbon\Carbon::parse($date)->format('d/m/Y');
    }

    public function getGradeColor(?string $grade): string
    {
        return match ($grade) {
            'Párvulo' => 'info',
            'Primero' => 'success',
            'Segundo' => 'warning',
            'Tercero' => 'danger',
            'Cuarto' => 'primary',
            'Quinto' => 'gray',
            default => 'gray',
        };
    }
}

