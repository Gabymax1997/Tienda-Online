@foreach($products as $product)
    <div class="col">
        <div class="product-item">
            <figure>
                <a href="index.html" title="{{ $product->name }}">
                    <img src="{{ $product->image }}" class="tab-image">
                </a>
            </figure>
            <h3>{{ $product->name }}</h3>
            <span class="price">${{ number_format($product->price, 2) }}</span>
            <div class="d-flex align-items-center justify-content-between">
                <div class="input-group product-qty">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                            <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                        </button>
                    </span>
                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                            <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                        </button>
                    </span>
                </div>
                <!-- Formulario "Add to Cart" -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="quantity" value="1" class="product-quantity"> <!-- Valor por defecto -->
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
@endforeach
