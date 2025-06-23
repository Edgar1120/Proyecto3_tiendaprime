<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias'; 
    public $timestamps = false; 

    protected $fillable = ['nombre']; 

    public function perfumes()
{
    return $this->hasMany(Perfume::class);
}
}
