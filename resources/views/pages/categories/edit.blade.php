@extends('layouts.main')

@section('content')
    <h1>Update product category page</h1>
    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('components.inputs.Input', [
            'name' => 'name',
            'placeholder' => 'Name',
            'value' => $category->name,
        ])
        <button type="submit">Create product category</button>
    </form>
@endsection
