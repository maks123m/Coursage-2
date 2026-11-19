@extends('layouts.app')

@section('title', 'SoundCrafted — Музыкальные группы')

@push('styles')
    @vite('resources/css/musicGroupMain.css')
@endpush

@section('content')
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
    <div class="groups-header">
        <h1 class="groups-title">Музыкальные группы</h1>
        <div class="groups-controls">
            

            <div class="groups-filters">
                <a href="{{ route('groups') }}" class="filter-btn {{ request('genre') == '' ? 'active' : '' }}">Все</a>
                <a href="{{ route('groups', ['genre' => 'Рок']) }}" class="filter-btn {{ request('genre') == 'Рок' ? 'active' : '' }}">Рок</a>
                <a href="{{ route('groups', ['genre' => 'Поп']) }}" class="filter-btn {{ request('genre') == 'Поп' ? 'active' : '' }}">Поп</a>

            </div>

            <form action="{{ route('groups') }}" method="GET" class="groups-search" style="display: flex; align-items: center; position: relative;">
                <input type="text" name="search" placeholder="Поиск..." value="{{ request('search') }}">
                <button type="submit" style="background: none; border: none; padding: 0; position: absolute; right: 10px; cursor: pointer;">
                    <img class="search-icon" src="{{ asset('img/search.png') }}" style="width: 20px;">
                </button>
            </form>

        </div>
    </div>

    
    <section class="groups-grid">
    @foreach($groups as $group)
        <div class="group-card">
            <a href="{{ route('group', $group->Group_ID) }}">
                <img src="{{ asset('img/groups/' . ($group->media->Media_file ?? 'default.png')) }}" alt="{{ $group->Name }}">
                <div class="group-info">
                    <span>{{ $group->Name }}</span>
                    <button class="heart-btn" data-id="{{ $group->Group_ID }}" data-type="group" style="background: none; border: none; padding: 0; cursor: pointer;">
                        <img class="heart" src="{{ asset('img/heart.png') }}">
                    </button>
                </div>
            </a>
        </div>
    @endforeach
    </section>

    <div class="pagination">
        @for ($i = 1; $i <= $groups->lastPage(); $i++)
            @if ($i == $groups->currentPage())
                <span class="page-dot active"></span>
            @else
                <a href="{{ $groups->url($i) }}" class="page-dot"></a>
            @endif
        @endfor
    </div>
</div>

@endsection