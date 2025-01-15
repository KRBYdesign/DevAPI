@extends('layouts.default')

@section('main')

<form method="POST" action="{{ url('/login') }}" class="auth-form">
    <p class="title">Login</p>

    @if($errors->any())
        <p class="form-error">{{ $errors->first() }}</p>
    @endif

    @csrf

    <div class="input-container">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="email@example.com"/>
    </div>

    <div class="input-container">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="•••••••••"/>
    </div>

    <div class="checkbox-container">
        <input type="checkbox" name="remember-me" />
        <label for="remember-me">Remember Me</label>
    </div>

    <button class="button button-primary">Login</button>

    <p class='link'>Need An Account?<br /><a href="{{ route('register') }}">Register Here</a></p>
</form>

@endsection
