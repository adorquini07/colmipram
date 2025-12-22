<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Student (Estudiante)
 * 
 * Representa a un estudiante del colegio.
 * 
 * @property int $id
 * @property string $name Nombre del estudiante
 * @property string $last_name Apellido del estudiante
 * @property string|null $email Correo electrónico del estudiante
 * @property string|null $phone Teléfono del estudiante
 * @property \Illuminate\Support\Carbon|null $birth_date Fecha de nacimiento
 * @property string $grade Grado al que pertenece (Párvulo, Primero, Segundo, Tercero, Cuarto, Quinto)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name Nombre completo del estudiante (atributo calculado)
 */
class Student extends Model
{
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'grade',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Obtiene el nombre completo del estudiante.
     * 
     * @return string Nombre completo (nombre + apellido)
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->name} {$this->last_name}";
    }
}
