<article class="product_card">
    <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}" class="product__image">
    <div class="product__info">
        <strong>{{ $product->category->name }}</strong>
        <p class="product__name">{{ $product->name }}</p>
        <p class="product__price">{{ $product->price }}</p>
        @php
            $cartProduct = App\Models\CartProduct::where('user_id', auth()->user()->id)
                ->where('product_id', $product->id)
                ->first();
        @endphp
        @isset($cartProduct)
            <div>
                <form action="{{ route('cart.add') }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="product__button">
                        +
                    </button>
                </form>
                <p>{{ $cartProduct->count }}</p>
                <form action="{{ route('cart.remove') }}" method="post">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="product__button">
                        -
                    </button>
                </form>
            </div>
        @else
            <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="product__button">
                    Add to cart
                </button>
            </form>
        @endisset
        <div class="product__admin">
            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="button">Edit</a>
            <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">
                    Delete
                </button>
            </form>
        </div>
    </div>
</article>
