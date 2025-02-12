@extends('layouts.main')

@section('content')
    <h1>Update product page</h1>
    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('components.Input', [
            'name' => 'name',
            'placeholder' => 'Name',
            'value' => $product->name,
        ])
        @include('components.Input', [
            'type' => 'number',
            'name' => 'price',
            'placeholder' => 'Price',
            'value' => $product->price,
        ])
        @include('components.Input', [
            'type' => 'file',
            'name' => 'image',
        ])
        @include('components.Input', [
            'name' => 'description',
            'placeholder' => 'Description',
            'value' => $product->description,
        ])
        <button type="submit">Create product</button>
    </form>
@endsection
