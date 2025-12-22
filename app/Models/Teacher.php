<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Teacher (Profesor)
 * 
 * Representa a un profesor del colegio.
 * 
 * @property int $id
 * @property string $name Nombre del profesor
 * @property string $last_name Apellido del profesor
 * @property string $email Correo electrónico del profesor (único)
 * @property string|null $phone Teléfono del profesor
 * @property string|null $position Cargo o posición del profesor (ej: "Profesor de Matemáticas")
 * @property bool $is_group_director Indica si el profesor es director de grupo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name Nombre completo del profesor (atributo calculado)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Course> $courses Cursos donde es director de grupo
 */
class Teacher extends Model
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
        'position',
        'is_group_director',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_group_director' => 'boolean',
    ];

    /**
     * Obtiene los cursos donde este profesor es director de grupo.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relación con el modelo Course
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Obtiene el nombre completo del profesor.
     * 
     * @return string Nombre completo (nombre + apellido)
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->name} {$this->last_name}";
    }
}
