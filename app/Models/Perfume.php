<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    protected $table = 'perfumes';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'marca', 'precio', 'genero', 'volumen',
        'id_categoria', 'rating', 'envio_gratis', 'etiquetas', 'imagen'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
