@extends('layouts.main')

@section('content')
    <h1>Create product category page</h1>
    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('components.inputs.Input', [
            'name' => 'name',
            'placeholder' => 'Name',
        ])
        <button type="submit">Create product category</button>
    </form>
@endsection
