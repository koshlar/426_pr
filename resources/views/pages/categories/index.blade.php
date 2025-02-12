@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Product categories</h1>
        <a href="{{ route('categories.create') }}" class="button">Create product category</a>
        <div class="catalog__wrapper">
            @forelse ($categories as $category)
                <article class="product__card">
                    <p>{{ $category->name }}</p>
                    <div class="product__admin">
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="button">Edit</a>
                        <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                Delete
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <p>No product categories</p>
            @endforelse
        </div>
    </div>
@endsection
