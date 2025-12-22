<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Notice (Noticia)
 * 
 * Representa una noticia o anuncio del colegio.
 * 
 * @property int $id
 * @property string $title Título de la noticia
 * @property string $content Contenido completo de la noticia
 * @property string|null $image Ruta de la imagen asociada a la noticia
 * @property \Illuminate\Support\Carbon $publication_date Fecha de publicación
 * @property int $user_id ID del usuario autor de la noticia
 * @property bool $is_active Indica si la noticia está activa y visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author Relación con el usuario autor
 */
class Notice extends Model
{
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'publication_date',
        'user_id',
        'is_active',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Obtiene el usuario autor de la noticia.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relación con el modelo User
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
