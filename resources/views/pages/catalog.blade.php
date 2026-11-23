@extends('layouts.app')

@section('title', 'SoundCrafted — Струнные инструменты')

@section('content')
@push('styles')
    @vite('resources/css/toolsMain.css')
@endpush
@push('scripts')
    @vite('resources/js/feedback.js')
@endpush

@push('styles')
    @vite('resources/css/feedback.css')
@endpush

<div id="discussion">
    <img src="{{ asset('img/discussion.png') }}" alt="Написать нам">
</div>

<div id="feedbackModal" class="modal-overlay">
    <div class="modal-content">
        <span id="closeFeedbackModal" class="modal-close">&times;</span>
        
        <h2 class="modal-title">Знаешь инструмент которого у нас нет?<br>Напиши нам, мы добавим!</h2>
        
        <form action="{{ route('feedback.store') }}" method="POST" class="modal-form">
            @csrf
            
            <label>ФИО</label>
            <input type="text" name="FIO" required>
            
            <label>Категория инструмента</label>
            <input type="text" name="Instrument_Category" required>
            
            <label>Описание</label>
            <textarea name="Description" rows="4" required></textarea>
            
            <button type="submit" class="modal-submit">Отправить</button>
        </form>
    </div>
</div>
<div class="wrapper">
    <section class="about-section">
        <h2 class="about-title">Струнные</h2>
        <div class="about-card">
            <p>Струнные — инструменты, звук которых создаётся колебанием струн. Делятся на смычковые (скрипка, виолончель), щипковые (гитара, арфа) и клавишные (рояль). Широко используются в классике, джазе, роке и народной музыке.</p>
        </div>
                
        <div class="tools-search">
            <form action="{{ route('catalog') }}" method="GET">
                <input type="text" name="search" placeholder="Поиск..." value="{{ request('search') }}">
                <button type="submit" class="search-btn">
                    <img class="search-icon" src="{{ asset('img/search.png') }}">
                </button>
            </form>
        </div>

        <section class="tools-grid">
            @foreach($instruments as $instrument)
                <div class="tool-card">
                    <a href="{{ route('tool', $instrument->Instrument_ID) }}">
                        <img src="{{ asset('img/' . ($instrument->photo->Photo ?? 'default.png')) }}" alt="...">
                        <div class="tool-info">
                            <span>{{ $instrument->Name ?? 'Инструмент #' . $instrument->Instrument_ID }}</span>
                            <button class="heart-btn" data-id="{{ $instrument->Instrument_ID }}" data-type="instrument" style="background: none; border: none; padding: 0; cursor: pointer;">
                                @if(in_array($instrument->Instrument_ID, $favoriteInstrumentIds ?? []))
                                    <img class="heart" src="{{ asset('img/heart_filled.png') }}" alt="В избранном">
                                @else
                                    <img class="heart" src="{{ asset('img/heart.png') }}" alt="Добавить в избранное">
                                @endif
                            </button>
                        </div>
                    </a>
                </div>
            @endforeach
        </section>

    <div class="pagination">
        @for ($i = 1; $i <= $instruments->lastPage(); $i++)
            @if ($i == $instruments->currentPage())
                <span class="page-dot active"></span>
            @else
                <a href="{{ $instruments->url($i) }}" class="page-dot"></a>
            @endif
        @endfor
    </div>
    </section>
</div>

@endsection