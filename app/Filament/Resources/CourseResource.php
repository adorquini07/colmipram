<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use App\Models\Teacher;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-book-open';
    }

    public static function getNavigationLabel(): string
    {
        return 'Cursos';
    }

    public static function getModelLabel(): string
    {
        return 'Curso';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Cursos';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Gestión Escolar';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del Curso')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre del Curso')
                            ->placeholder('Ej: 1A, 2B, 3C')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Ingrese el nombre del curso (ej: 1A, 2B)'),
                        Select::make('grade')
                            ->label('Grado')
                            ->options([
                                'Párvulo' => 'Párvulo',
                                'Primero' => 'Primero',
                                'Segundo' => 'Segundo',
                                'Tercero' => 'Tercero',
                                'Cuarto' => 'Cuarto',
                                'Quinto' => 'Quinto',
                            ])
                            ->required()
                            ->native(false),
                        Select::make('teacher_id')
                            ->label('Director de Grupo')
                            ->relationship('teacher', 'name', fn (Builder $query) => $query->where('is_group_director', true))
                            ->getOptionLabelFromRecordUsing(fn (Teacher $record): string => "{$record->name} {$record->last_name}")
                            ->searchable(['name', 'last_name'])
                            ->preload()
                            ->helperText('Solo se muestran profesores que son directores de grupo'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre del Curso')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('grade')
                    ->label('Grado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
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
                Tables\Columns\TextColumn::make('students_count')
                    ->label('Alumnos')
                    ->counts('students')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-users')
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->label('Director de Grupo')
                    ->formatStateUsing(fn ($record) => $record->teacher ? "{$record->teacher->name} {$record->teacher->last_name}" : 'Sin asignar')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('teacher', function (Builder $query) use ($search) {
                            $query->where('name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    })
                    ->badge()
                    ->color(fn ($state) => $state === 'Sin asignar' ? 'gray' : 'success')
                    ->icon(fn ($state) => $state === 'Sin asignar' ? 'heroicon-o-x-circle' : 'heroicon-o-user'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('grade')
                    ->label('Grado')
                    ->options([
                        'Párvulo' => 'Párvulo',
                        'Primero' => 'Primero',
                        'Segundo' => 'Segundo',
                        'Tercero' => 'Tercero',
                        'Cuarto' => 'Cuarto',
                        'Quinto' => 'Quinto',
                    ]),
                Tables\Filters\SelectFilter::make('teacher_id')
                    ->label('Director de Grupo')
                    ->relationship('teacher', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Teacher $record): string => "{$record->name} {$record->last_name}")
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                EditAction::make()->label('Editar'),
                DeleteAction::make()->label('Eliminar'),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}

