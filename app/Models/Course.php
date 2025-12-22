<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Course (Curso)
 * 
 * Representa un curso del colegio con su director de grupo asignado.
 * 
 * @property int $id
 * @property string $name Nombre del curso (ej: "1A", "2B")
 * @property string $grade Grado al que pertenece (Párvulo, Primero, Segundo, Tercero, Cuarto, Quinto)
 * @property int|null $teacher_id ID del profesor director de grupo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Teacher|null $teacher Relación con el profesor director de grupo
 */
class Course extends Model
{
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'grade',
        'teacher_id',
    ];

    /**
     * Obtiene el profesor director de grupo asignado al curso.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relación con el modelo Teacher
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
