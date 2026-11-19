@extends('layouts.app')
@section('title', 'SoundCrafted — Авторизация')
@push('styles')
    @vite('resources/css/auth.css')
@endpush
@section('content')
<div class="auth-wrapper">
    <h1 class="auth-title">Авторизация</h1>
    <div class="auth-card">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="auth-label">Логин</div>
            <input type="text" class="auth-input" name="Login" required>
            <div class="auth-label" style="margin-top: 2vh;">Пароль</div>
            <input type="password" class="auth-input" name="Password" required>
            <button type="submit" class="auth-btn">Войти</button>
        </form>
        <a href="{{ route('register') }}" class="auth-switch">Регистрация</a>
    </div>
</div>
@endsection