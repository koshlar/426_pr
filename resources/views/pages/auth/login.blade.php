@extends('layouts.main')

@section('content')
    <h1>Login page</h1>
    <form action="{{ route('login') }}" method="post">
        @csrf
        @include('components.Input', [
            'type' => 'email',
            'name' => 'email',
            'placeholder' => 'Email',
        ])
        @include('components.Input', [
            'type' => 'password',
            'name' => 'password',
            'placeholder' => 'Password',
        ])
        <button type="submit">Login</button>
    </form>
@endsection
