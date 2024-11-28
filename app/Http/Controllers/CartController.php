<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

class CartController extends Controller
{
    public function index()
    {
        // Obtener los artículos del carrito desde la sesión
        $cartItems = session()->get('cart', []);
        
        return view('cart.cart', compact('cartItems')); // Redirigir a la vista 'cart' con los productos del carrito
    }

    public function add(Request $request, $productName)
    {
        // Lista de productos "imaginarios" con nombre y precio
        $products = [
            'Bananas' => ['name' => 'Bananas', 'price' => 18.00],
            'Galletitas Saladas' => ['name' => 'Galletitas Saladas', 'price' => 10.00],
            'Pepinos' => ['name' => 'Pepinos', 'price' => 8.50],
            'Leche' => ['name' => 'Leche', 'price' => 20.50],
        ];
    
        // Obtener la cantidad seleccionada desde el formulario
        $quantity = $request->input('quantity', 1);
    
        // Validar que la cantidad es un número positivo
        if ($quantity < 1) {
            return redirect()->route('cart.index')->with('error', 'La cantidad debe ser mayor a 0');
        }
    
        // Verificar si el producto existe en el arreglo de productos
        if (isset($products[$productName])) {
            // Crear un artículo para agregar al carrito
            $cartItem = [
                'name' => $products[$productName]['name'],
                'price' => $products[$productName]['price'],
                'quantity' => $quantity,
            ];
    
            // Obtener el carrito actual desde la sesión
            $cart = session()->get('cart', []);
    
            // Verificar si el producto ya existe en el carrito
            if (isset($cart[$productName])) {
                // Si existe, actualizar la cantidad
                $cart[$productName]['quantity'] += $quantity;
            } else {
                // Si no existe, agregar el producto al carrito
                $cart[$productName] = $cartItem;
            }
    
            // Guardar el carrito actualizado en la sesión
            session()->put('cart', $cart);
        }
    
        // Redirigir al carrito
        return redirect()->route('cart.index');
    }
    public function clear()
{
    // Vaciar el carrito en la sesión
    session()->forget('cart');

    // Redirigir a la página del carrito con un mensaje
    return redirect()->route('cart.index')->with('success', 'Carrito vacío');
}
public function processPayment(Request $request)
{
    // Validar datos del formulario
    $request->validate([
        'mpAlias' => 'required|string|max:255',
        'total' => 'required|numeric|min:0.01',
    ]);

    // Simular el procesamiento del pago
    $total = $request->input('total');
    $mpAlias = $request->input('mpAlias');

    // Aquí podrías agregar lógica adicional, como guardar la transacción en la base de datos

    // Limpiar el carrito después del pago
    session()->forget('cart');

    // Redirigir con un mensaje de éxito
    return redirect()->route('cart.index')->with('success', 'Pago realizado con éxito. Gracias por usar Mercado Pago (Alias: ' . $mpAlias . ')!');
}


}
