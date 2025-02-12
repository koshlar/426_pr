@extends('layouts.main')

@section('content')
    <h1>Create product page</h1>
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('components.Input', [
            'name' => 'name',
            'placeholder' => 'Name',
        ])
        @include('components.Input', [
            'type' => 'number',
            'name' => 'price',
            'placeholder' => 'Price',
        ])
        @include('components.Input', [
            'type' => 'file',
            'name' => 'image',
        ])
        @include('components.Input', [
            'name' => 'description',
            'placeholder' => 'Description',
        ])
        <button type="submit">Create product</button>
    </form>
@endsection
