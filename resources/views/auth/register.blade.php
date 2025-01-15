@extends('layouts.default')

@section('main')

<form method="POST" action="{{ url('/register') }}" class="auth-form">
    <p class="title">Register</p>

    @if($errors->any())
        <p class="form-error">{{ $errors->first() }}</p>
    @endif

    @csrf

    <div class="input-container">
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Joe Random" />
    </div>

    <div class="input-container">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="email@example.com"/>
    </div>

    <div class="input-container">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="•••••••••"/>
    </div>

    <button class="button button-primary">Register</button>

    <p class='link'>Have An Account?<br /><a href="{{ route('login') }}">Login Here</a></p>
</form>

@endsection
