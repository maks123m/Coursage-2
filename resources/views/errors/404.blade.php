@extends('layouts.app')

@section('title', '404 — Страница не найдена')

@push('styles')
    @vite('resources/css/mistake.css')
@endpush

@section('content')
<div class="error-wrapper">
    <div class="error-block">
        <h1 class="error-title">404</h1>
        <p class="error-text">Страница не найдена</p>
        <div class="error-desc">
            Похоже, вы попали не туда.<br>
            Возможно, страница была удалена или временно недоступна.
        </div>
        <a href="{{ route('home') }}" class="error-btn">Вернуться на главную</a>
    </div>
</div>
@endsection