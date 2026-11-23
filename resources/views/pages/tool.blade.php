@extends('layouts.app')

@section('title', $instrument->Name ?? 'Инструмент')

@push('styles')
    @vite('resources/css/tool.css')
@endpush

@section('content')
<div class="back">
    <a href="{{ route('catalog') }}" class="back-btn">Вернуться</a>
</div>

<div class="wrapper">
    <div class="instrument-page">
        <h2 class="instrument-title">{{ $instrument->Name ?? 'Инструмент' }}</h2>
        <div class="instrument-header">
            <div class="category left">Категория: {{ $instrument->Category_ID }}</div>
            <img class="instrument-image" src="{{ asset('img/' . ($instrument->photo->Photo ?? 'default.png')) }}" alt="...">
            <!-- Тип инструмента (пока статично) -->
            <div class="category right">Струнный</div>
        </div>
        <div class="audio-section">
            @if($instrument->sound)
                <audio controls style="width: 100%; max-width: 400px; margin: 20px auto; display: block;">
                    <source src="{{ asset($instrument->sound->Sound) }}" type="audio/mpeg">
                    Ваш браузер не поддерживает аудио.
                </audio>
            @else
                <p style="color: #F6F6F6; text-align: center;">Аудио для этого инструмента пока нет.</p>
            @endif
        </div>
        <div>
            <h3 class="section-title">Похожие инструменты</h3>
            <section class="tools-grid">

                <div class="tool-card">
                    <a href="#">
                        <img src="{{ asset('img/instruments/guitarfoto.jpg') }}" alt="Гитара">
                        <div class="tool-info"><span>Гитара</span><img class="heart" src="{{ asset('img/heart.png') }}"></div>
                    </a>
                </div>
                <div class="tool-card">
                    <a href="#">
                        <img src="{{ asset('img/instruments/violonchel.jpg') }}" alt="Виолончель">
                        <div class="tool-info"><span>Виолончель</span><img class="heart" src="{{ asset('img/heart.png') }}"></div>
                    </a>
                </div>
                <div class="tool-card">
                    <a href="#">
                        <img src="{{ asset('img/instruments/balalaka.jpg') }}" alt="Балалайка">
                        <div class="tool-info"><span>Балалайка</span><img class="heart" src="{{ asset('img/heart.png') }}"></div>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection