<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use App\Models\Student;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-banknotes';
    }

    public static function getNavigationLabel(): string
    {
        return 'Pagos';
    }

    public static function getModelLabel(): string
    {
        return 'Pago';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Pagos';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Gestión Escolar';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del Pago')
                    ->schema([
                        Select::make('student_id')
                            ->label('Estudiante')
                            ->relationship('student', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Student $record): string => "{$record->name} {$record->last_name}")
                            ->searchable(['name', 'last_name'])
                            ->preload()
                            ->required(),
                        Select::make('type')
                            ->label('Tipo de Pago')
                            ->options([
                                'matricula' => 'Matrícula',
                                'mensualidad' => 'Mensualidad',
                            ])
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
                                1 => 'Enero',
                                2 => 'Febrero',
                                3 => 'Marzo',
                                4 => 'Abril',
                                5 => 'Mayo',
                                6 => 'Junio',
                                7 => 'Julio',
                                8 => 'Agosto',
                                9 => 'Septiembre',
                                10 => 'Octubre',
                                11 => 'Noviembre',
                                12 => 'Diciembre',
                            ])
                            ->default(now()->month)
                            ->required()
                            ->native(false),
                        TextInput::make('year')
                            ->label('Año')
                            ->numeric()
                            ->default(now()->year)
                            ->required()
                            ->minValue(2020)
                            ->maxValue(2100),
                        DatePicker::make('payment_date')
                            ->label('Fecha de Pago')
                            ->default(now())
                            ->required()
                            ->displayFormat('d/m/Y'),
                    ])->columns(2),
                Section::make('Observaciones')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Notas')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Estudiante')
                    ->formatStateUsing(fn ($record) => "{$record->student->name} {$record->student->last_name}")
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('student', function (Builder $query) use ($search) {
                            $query->where('name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'matricula' => 'Matrícula',
                        'mensualidad' => 'Mensualidad',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'matricula' => 'info',
                        'mensualidad' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Monto')
                    ->money('COP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('month')
                    ->label('Mes')
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
                        default => (string) $state,
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Año')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Fecha de Pago')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('payment_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo de Pago')
                    ->options([
                        'matricula' => 'Matrícula',
                        'mensualidad' => 'Mensualidad',
                    ]),
                Tables\Filters\SelectFilter::make('month')
                    ->label('Mes')
                    ->options([
                        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
                    ]),
                Tables\Filters\SelectFilter::make('year')
                    ->label('Año')
                    ->options(array_combine(
                        range(now()->year - 2, now()->year + 1),
                        range(now()->year - 2, now()->year + 1)
                    )),
                Tables\Filters\SelectFilter::make('student_id')
                    ->label('Estudiante')
                    ->relationship('student', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Student $record): string => "{$record->name} {$record->last_name}")
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}

