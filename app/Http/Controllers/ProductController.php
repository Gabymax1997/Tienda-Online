<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Asegúrate de importar el modelo

class ProductController extends Controller
{
    public function index()
    {
        // Recupera todos los productos de la base de datos
        $products = Product::all();

        // Pasa la variable $products a la vista
        return view('template', compact('products')); // Aquí estás pasando la variable
    }
}



