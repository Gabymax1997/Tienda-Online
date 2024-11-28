<div class="container">
    <h3>Carrito de Compras</h3>
    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mostrar el total -->
    @php
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    @endphp
    <div class="container mt-4">
        <h4>Total: ${{ number_format($total, 2) }}</h4>
    </div>

    <!-- Botón para vaciar el carrito -->
    <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-danger">Vaciar Carrito</button>
    </form>

    <!-- Formulario de pago -->
    <div class="container mt-4">
        <h4>Realice su Pago</h4>
        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="mpAlias">Alias de Mercado Pago:</label>
                <input type="text" name="mpAlias" id="mpAlias" class="form-control" placeholder="alias.mercadopago" required>
            </div>
            <div class="form-group mt-3">
                <label for="cardNumber">Número de Tarjeta:</label>
                <input type="text" name="cardNumber" id="cardNumber" class="form-control" placeholder="1234 5678 9101 1121" maxlength="19" required>
            </div>
            <input type="hidden" name="total" value="{{ $total }}">
            <button type="submit" class="btn btn-success mt-4">Pagar Ahora</button>
        </form>
    </div>

    <!-- Botón para volver a la página principal -->
    <div class="mt-4">
        <a href="{{ url('/') }}" class="btn btn-primary">Volver a la Página Principal</a>
    </div>
</div>
