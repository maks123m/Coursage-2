@extends('layouts.app')

@section('title', 'SoundCrafted — Виды инструментов')

@push('styles')
    @vite('resources/css/typesTools.css')
@endpush

@section('content')
<div class="wrapper">
    <section class="instrument-types">
        <h2>Виды музыкальных инструментов</h2>
        <div class="slider">
            <button class="arrow-btn left">
                <img src="{{ asset('img/strelka1.png') }}" alt="">
            </button>
            <div class="cards-row">
                <a href="{{ route('catalog') }}" class="type-card small text-small">
                    <img src="{{ asset('img/instruments/piano.png') }}" alt="">
                    <span>Электронные</span>
                </a>
                <a href="{{ route('catalog') }}" class="type-card medium text-medium">
                    <img src="{{ asset('img/instruments/baraban.jpg') }}" alt="">
                    <span>Ударные</span>
                </a>
                <a href="{{ route('catalog') }}" class="type-card big text-big">
                    <img src="{{ asset('img/instruments/violinchel.jpg') }}" alt="">
                    <span>Струнные</span>
                </a>
                <a href="{{ route('catalog') }}" class="type-card medium text-medium">
                    <img src="{{ asset('img/instruments/dudka.jpg') }}" alt="">
                    <span>Духовые</span>
                </a>
                <a href="{{ route('catalog') }}" class="type-card small text-small">
                    <img src="{{ asset('img/instruments/akkordeon.jpg') }}" alt="">
                    <span>Язычковые</span>
                </a>
            </div>
            <button class="arrow-btn right">
                <img src="{{ asset('img/strelka2.png') }}" alt="">
            </button>
        </div>
    </section>
</div>
@endsection