<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_entrega',
        'estado',
        'user_id',
    ];

    protected $casts = [
        'fecha_entrega' => 'date', // 👈 Esto convierte automáticamente a Carbon
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }
}
