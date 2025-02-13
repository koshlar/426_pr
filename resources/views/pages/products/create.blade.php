@extends('layouts.main')

@section('content')
    <h1>Create product page</h1>
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('components.inputs.Input', [
            'name' => 'name',
            'placeholder' => 'Name',
        ])
        @include('components.inputs.Input', [
            'type' => 'number',
            'name' => 'price',
            'placeholder' => 'Price',
        ])
        @include('components.inputs.Input', [
            'type' => 'file',
            'name' => 'image',
        ])
        @include('components.inputs.Input', [
            'name' => 'description',
            'placeholder' => 'Description',
        ])
        @component('components.inputs.InputContainer', ['name' => 'product_category_id'])
            <select name="product_category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('product_category_id') && old('product_category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        @endcomponent
        <button type="submit">Create product</button>
    </form>
@endsection
