<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers\PaymentsRelationManager;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-academic-cap';
    }

    public static function getNavigationLabel(): string
    {
        return 'Estudiantes';
    }

    public static function getModelLabel(): string
    {
        return 'Estudiante';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Estudiantes';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Gestión Escolar';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información Personal')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->label('Apellido')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(255),
                        DatePicker::make('birth_date')
                            ->label('Fecha de Nacimiento')
                            ->displayFormat('d/m/Y'),
                    ])->columns(2),
                Section::make('Información Académica')
                    ->schema([
                        Select::make('course_id')
                            ->label('Curso')
                            ->relationship('course', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Course $record): string => "{$record->name} - {$record->grade}")
                            ->searchable(['name', 'grade'])
                            ->preload()
                            ->required()
                            ->native(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Apellido')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->searchable()
                    ->icon('heroicon-m-envelope'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable()
                    ->icon('heroicon-m-phone'),
                Tables\Columns\TextColumn::make('course.name')
                    ->label('Curso')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.grade')
                    ->label('Grado')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Párvulo' => 'info',
                        'Primero' => 'success',
                        'Segundo' => 'warning',
                        'Tercero' => 'danger',
                        'Cuarto' => 'primary',
                        'Quinto' => 'gray',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Estado de Pago')
                    ->badge()
                    ->getStateUsing(fn (Student $record): string => $record->hasPaidCurrentMonth() ? 'Al día' : 'Pendiente')
                    ->color(fn (string $state): string => $state === 'Al día' ? 'success' : 'danger')
                    ->icon(fn (string $state): string => $state === 'Al día' ? 'heroicon-o-check-circle' : 'heroicon-o-exclamation-triangle'),
                Tables\Columns\TextColumn::make('birth_date')
                    ->label('Fecha de Nacimiento')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('course_id')
                    ->label('Curso')
                    ->relationship('course', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Course $record): string => "{$record->name} - {$record->grade}")
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Action::make('registrar_pago')
                    ->label('Pagar')
                    ->icon('heroicon-o-banknotes')
                    ->color('success')
                    ->modalSubmitActionLabel('Guardar Pago')
                    ->modalCancelActionLabel('Cancelar')
                    ->visible(fn (Student $record): bool => !$record->hasPaidCurrentMonth())
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
                    ->action(function (Student $record, array $data): void {
                        $record->payments()->create($data);
                        
                        Notification::make()
                            ->success()
                            ->title('¡Pago registrado!')
                            ->body('El pago ha sido registrado exitosamente.')
                            ->send();
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}

