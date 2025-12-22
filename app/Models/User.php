<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo User (Usuario)
 * 
 * Representa a un usuario del sistema (administrador).
 * 
 * @property int $id
 * @property string $name Nombre del usuario
 * @property string $email Correo electrónico del usuario (único)
 * @property \Illuminate\Support\Carbon|null $email_verified_at Fecha de verificación del email
 * @property string $password Contraseña hasheada
 * @property string|null $remember_token Token de recordar sesión
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notice> $notices Noticias creadas por el usuario
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Los atributos que deben ocultarse para la serialización.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtiene los atributos que deben ser convertidos a tipos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Obtiene las noticias creadas por este usuario.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relación con el modelo Notice
     */
    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }
}
