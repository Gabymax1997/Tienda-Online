<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';  // Nombre de la tabla
    protected $fillable = ['nombre', 'precio', 'Stock'];  // Columnas de la tabla

    public $timestamps = false; // Si no estás usando columnas 'created_at' y 'updated_at'
}
