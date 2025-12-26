<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $title = 'Historial de Pagos';

    protected static ?string $modelLabel = 'Pago';

    protected static ?string $pluralModelLabel = 'Pagos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
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
                    ->required()
                    ->minValue(2020)
                    ->maxValue(2100),
                DatePicker::make('payment_date')
                    ->label('Fecha de Pago')
                    ->default(now())
                    ->required()
                    ->displayFormat('d/m/Y'),
                Textarea::make('notes')
                    ->label('Notas')
                    ->rows(2)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('type')
            ->columns([
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
                    }),
                Tables\Columns\TextColumn::make('year')
                    ->label('Año'),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Fecha de Pago')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('payment_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'matricula' => 'Matrícula',
                        'mensualidad' => 'Mensualidad',
                    ]),
                Tables\Filters\SelectFilter::make('year')
                    ->label('Año')
                    ->options(array_combine(
                        range(now()->year - 2, now()->year + 1),
                        range(now()->year - 2, now()->year + 1)
                    )),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Registrar Pago'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

