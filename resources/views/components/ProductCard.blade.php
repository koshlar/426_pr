<article class="product_card">
    <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}" class="product__image">
    <div class="product__info">
        <p class="product__name">{{ $product->name }}</p>
        <p class="product__price">{{ $product->price }}</p>
        <form action="" method="post">
            @csrf
            <button type="submit" class="product__button">
                Add to cart
            </button>
        </form>
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
