<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property int|null $course_id ID del curso al que pertenece
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name Nombre completo del estudiante (atributo calculado)
 * @property-read \App\Models\Course|null $course Relación con el curso
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments Pagos del estudiante
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
        'course_id',
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

    /**
     * Obtiene el curso al que pertenece el estudiante.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relación con el modelo Course
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Obtiene los pagos del estudiante.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relación con el modelo Payment
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Verifica si el estudiante ha pagado la mensualidad del mes actual.
     */
    public function hasPaidCurrentMonth(): bool
    {
        return $this->payments()
            ->where('type', Payment::TYPE_MENSUALIDAD)
            ->where('month', now()->month)
            ->where('year', now()->year)
            ->exists();
    }

    /**
     * Verifica si el estudiante ha pagado la matrícula del año actual.
     */
    public function hasPaidEnrollment(): bool
    {
        return $this->payments()
            ->where('type', Payment::TYPE_MATRICULA)
            ->where('year', now()->year)
            ->exists();
    }

    /**
     * Obtiene el estado de pago del estudiante.
     */
    public function getPaymentStatusAttribute(): string
    {
        if (!$this->hasPaidCurrentMonth()) {
            return 'pendiente';
        }
        return 'al_dia';
    }
}
