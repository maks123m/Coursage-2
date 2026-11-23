@extends('layouts.app')

@section('title', 'SoundCrafted — Понравившееся')

@push('styles')
    @vite('resources/css/favourites.css')
@endpush

@section('content')
<div class="wrapper">
    <h2 class="page-title">Понравившееся</h2>
    
    <div class="filters">
        <a href="{{ route('favourites', ['filter' => 'all']) }}" class="filter-btn {{ $filter == 'all' ? 'active' : '' }}">Все</a>
        <a href="{{ route('favourites', ['filter' => 'groups']) }}" class="filter-btn {{ $filter == 'groups' ? 'active' : '' }}">Группы</a>
        <a href="{{ route('favourites', ['filter' => 'instruments']) }}" class="filter-btn {{ $filter == 'instruments' ? 'active' : '' }}">Инструменты</a>
    </div>

    @if($favoriteGroups->isNotEmpty())
        <section class="section">
            <h3 class="section-title">Любимые группы</h3>
            <div class="cards-grid">
                @foreach($favoriteGroups as $group)
                    <div class="group-card">
                        <a href="{{ route('group', $group->Group_ID) }}">
                            <img src="{{ asset('img/groups/' . ($group->media->Media_file ?? 'default.png')) }}" alt="{{ $group->Name }}">
                            <div class="group-info">
                                <span>{{ $group->Name }}</span>
                                <img class="heart" src="{{ asset('img/heart_filled.png') }}">
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @if($filter === 'groups' && $favoriteGroups->hasPages())
                <div class="pagination">
                    @for ($i = 1; $i <= $favoriteGroups->lastPage(); $i++)
                        @if ($i == $favoriteGroups->currentPage())
                            <span class="page-dot active"></span>
                        @else
                            <a href="{{ $favoriteGroups->url($i) }}" class="page-dot"></a>
                        @endif
                    @endfor
                </div>
            @endif
        </section>
    @endif

    @if($favoriteInstruments->isNotEmpty())
        <section class="section">
            <h3 class="section-title">Любимые инструменты</h3>
            <div class="cards-grid">
                @foreach($favoriteInstruments as $instrument)
                    <div class="tool-card">
                        <a href="{{ route('tool', $instrument->Instrument_ID) }}">
                            <img src="{{ asset('img/' . ($instrument->photo->Photo ?? 'default.png')) }}" alt="{{ $instrument->Name }}">
                            <div class="tool-info">
                                <span>{{ $instrument->Name }}</span>
                                <img class="heart" src="{{ asset('img/heart_filled.png') }}">
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            
            @if($filter === 'instruments' && $favoriteInstruments->hasPages())
                <div class="pagination">
                    @for ($i = 1; $i <= $favoriteInstruments->lastPage(); $i++)
                        @if ($i == $favoriteInstruments->currentPage())
                            <span class="page-dot active"></span>
                        @else
                            <a href="{{ $favoriteInstruments->url($i) }}" class="page-dot"></a>
                        @endif
                    @endfor
                </div>
            @endif
        </section>
    @endif

    @if($favoriteGroups->isEmpty() && $favoriteInstruments->isEmpty())
        <div style="text-align: center; color: #F6F6F6; font-family: 'Binggrae'; margin-top: 50px;">
            <p>У вас пока нет избранных групп или инструментов.</p>
            <p>Перейдите в <a href="{{ route('groups') }}" style="color: #FFA600;">группы</a> или <a href="{{ route('catalog') }}" style="color: #FFA600;">инструменты</a>, чтобы добавить их.</p>
        </div>
    @endif
</div>
@endsection