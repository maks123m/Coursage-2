@extends('layouts.app')

@section('title', 'SoundCrafted — Главная')

@section('content')
<div class="wrapper">
    <h2 class="title">Мир музыки - это волшебно!</h2>

    <div class="content">
        <div class="cards">
            <div class="card">
                <a href="{{ route('typesTools') }}">
                    <div class="card-title">Виды <br> инструментов</div>
                    <img src="{{ asset('img/guitars.png') }}" class="icon" alt="Гитары">
                </a>
            </div>
            <div class="card">
                <a href="{{ route('survey') }}">
                    <div class="card-title">Подбор инструмента</div>
                    <img src="{{ asset('img/GUITAR.png') }}" class="icon" alt="Подбор">
                </a>
            </div>
            <div class="card">
                <a href="{{ route('groups') }}">
                    <div class="card-title">Музыкальные группы</div>
                    <img src="{{ asset('img/group_music.png') }}" class="icon" alt="Группы">
                </a>
            </div>
        </div>
    </div>

    <section class="about-section">
        <h2 class="about-title">О нас</h2>
        <div class="about-card">
            <p>
                Этот сайт посвящён музыкальным инструментам — их звучанию и использованию 
                в реальных музыкальных коллективах. Здесь можно послушать, как звучит каждый 
                инструмент отдельно, а также узнать, в каких группах и жанрах он применяется. 
                Ресурс носит исключительно ознакомительный характер и создан для всех, кто интересуется музыкой и её инструментальной основой.
            </p>
        </div>
    </section>
</div>
@endsection