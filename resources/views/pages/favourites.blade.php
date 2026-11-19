@extends('layouts.app')

@section('title', 'SoundCrafted — Понравившееся')

@push('styles')
    @vite('resources/css/favourites.css')
@endpush

@section('content')
<div class="wrapper">
    <h2 class="page-title">Понравившееся</h2>
    <div class="filters">
        <button class="filter-btn active">Все</button>
        <button class="filter-btn">Группы</button>
        <button class="filter-btn">Инструменты</button>
    </div>

    <section class="section">
        <h3 class="section-title">Любимые группы</h3>
        <div class="cards-grid">
            <div class="group-card">
                <a href="{{ route('group', 1) }}">
                    <img src="{{ asset('img/groups/Korol-i-Shut.png') }}" alt="Король и Шут">
                    <div class="group-info">
                        <span>Король и Шут</span>
                        <img class="heart" src="{{ asset('img/favourites.png') }}">
                    </div>
                </a>
            </div>

        </div>
    </section>

    <section class="section">
        <h3 class="section-title">Любимые инструменты</h3>
        <div class="cards-grid">
            <div class="tool-card">
                <img src="{{ asset('img/instruments/guitarfoto.jpg') }}" alt="Гитара">
                <div class="tool-info">
                    <span>Гитара</span>
                    <img class="heart" src="{{ asset('img/favourites.png') }}">
                </div>
            </div>

        </div>
    </section>
</div>
@endsection