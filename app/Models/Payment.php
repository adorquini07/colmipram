<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Payment (Pago)
 * 
 * Representa un pago de matrícula o mensualidad de un estudiante.
 * 
 * @property int $id
 * @property int $student_id ID del estudiante
 * @property string $type Tipo de pago (matricula, mensualidad)
 * @property float $amount Monto del pago
 * @property int $month Mes al que corresponde (1-12)
 * @property int $year Año del pago
 * @property \Illuminate\Support\Carbon $payment_date Fecha del pago
 * @property string|null $notes Observaciones
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Student $student Relación con el estudiante
 */
class Payment extends Model
{
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'type',
        'amount',
        'month',
        'year',
        'payment_date',
        'notes',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
    ];

    /**
     * Tipos de pago disponibles.
     */
    public const TYPE_MATRICULA = 'matricula';
    public const TYPE_MENSUALIDAD = 'mensualidad';

    /**
     * Obtiene el estudiante al que pertenece el pago.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Obtiene el nombre del mes.
     */
    public function getMonthNameAttribute(): string
    {
        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        return $months[$this->month] ?? '';
    }

    /**
     * Obtiene la etiqueta del tipo de pago.
     */
    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            self::TYPE_MATRICULA => 'Matrícula',
            self::TYPE_MENSUALIDAD => 'Mensualidad',
            default => $this->type,
        };
    }
}
