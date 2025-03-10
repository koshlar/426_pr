@extends('layouts.main')

@section('content')
    <h1>Update product page</h1>
    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('components.inputs.Input', [
            'name' => 'name',
            'placeholder' => 'Name',
            'value' => $product->name,
        ])
        @include('components.inputs.Input', [
            'type' => 'number',
            'name' => 'price',
            'placeholder' => 'Price',
            'value' => $product->price,
        ])
        @include('components.inputs.Input', [
            'type' => 'file',
            'name' => 'image',
        ])
        @include('components.inputs.Input', [
            'name' => 'description',
            'placeholder' => 'Description',
            'value' => $product->description,
        ])
        @component('components.inputs.InputContainer', ['name' => 'product_category_id'])
            <select name="product_category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        @endcomponent
        <button type="submit">Create product</button>
    </form>
@endsection
