@extends('layouts.app')

@section('title', 'SoundCrafted — Регистрация')

@push('styles')
    @vite('resources/css/auth.css')
@endpush

@section('content')
<div class="auth-wrapper">
    <h1 class="auth-title">Регистрация</h1>
    
    <div class="auth-card">
        @if ($errors->any())
        <div style="color: #ff4d4d; margin-bottom: 15px; font-size: 1vw; text-align: center;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf 
            <div class="auth-label">Логин</div>
            <input type="text" class="auth-input" name="Login" required>

            <div class="auth-label" style="margin-top: 2vh;">Пароль</div>
            <input type="password" class="auth-input" name="Password" required>

            <div class="auth-label" style="margin-top: 2vh;">Подтверждение пароля</div>
            <input type="password" class="auth-input" name="Password_confirmation" required>

            <button type="submit" class="auth-btn">Регистрация</button>
        </form>
        <a href="{{ route('login') }}" class="auth-switch">Войти</a>
    </div>
</div>
@endsection