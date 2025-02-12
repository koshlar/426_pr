@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Catalog</h1>
        @if (auth()->user()->role_id == 3)
            <a href="{{ route('products.create') }}" class="button">Create product</a>
        @endif
        <div class="catalog__wrapper">
            @forelse ($products as $product)
                @include('components.ProductCard', ['product' => $product])
            @empty
                <p>No products</p>
            @endforelse
        </div>
    </div>
@endsection
