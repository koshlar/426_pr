@extends('layouts.main')

@section('content')
    <h1>Register page</h1>
    <form action="{{ route('register') }}" method="post">
        @csrf
        @include('components.inputs.Input', [
            'name' => 'name',
            'placeholder' => 'Name',
        ])
        @include('components.inputs.Input', [
            'name' => 'surname',
            'placeholder' => 'Surname',
        ])
        @include('components.inputs.Input', [
            'name' => 'patronymic',
            'placeholder' => 'Patronymic',
        ])
        @include('components.inputs.Input', [
            'type' => 'email',
            'name' => 'email',
            'placeholder' => 'Email',
        ])
        @include('components.inputs.Input', [
            'type' => 'number',
            'name' => 'phone',
            'placeholder' => 'Phone',
        ])
        @include('components.inputs.Input', [
            'type' => 'password',
            'name' => 'password',
            'placeholder' => 'Password',
        ])
        @include('components.inputs.Input', [
            'type' => 'password',
            'name' => 'password_confirmation',
            'placeholder' => 'Password again',
        ])
        <button type="submit">Register</button>
    </form>
@endsection
