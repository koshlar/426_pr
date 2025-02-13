@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Cart</h1>
        <form action="" method="post">
            @csrf
            <button type="submit" class="product__button">
                Make order
            </button>
        </form>
        <div class="catalog__wrapper">
            @forelse ($products as $product)
                @include('components.ProductCard', ['product' => $product->product])
            @empty
                <p>No products in cart</p>
            @endforelse
        </div>
    </div>
@endsection
