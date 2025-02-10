@extends('layouts.main')

@section('content')
    <h1>Register page</h1>
    <form action="{{ route('register') }}" method="post">
        @csrf
        @include('components.Input', [
            'name' => 'name',
            'placeholder' => 'Name',
        ])
        @include('components.Input', [
            'name' => 'surname',
            'placeholder' => 'Surname',
        ])
        @include('components.Input', [
            'name' => 'patronymic',
            'placeholder' => 'Patronymic',
        ])
        @include('components.Input', [
            'type' => 'email',
            'name' => 'email',
            'placeholder' => 'Email',
        ])
        @include('components.Input', [
            'type' => 'number',
            'name' => 'phone',
            'placeholder' => 'Phone',
        ])
        @include('components.Input', [
            'type' => 'password',
            'name' => 'password',
            'placeholder' => 'Password',
        ])
        @include('components.Input', [
            'type' => 'password',
            'name' => 'password_confirmation',
            'placeholder' => 'Password again',
        ])
        <button type="submit">Register</button>
    </form>
@endsection
