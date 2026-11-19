@extends('layouts.app')

@section('title', $group->Name)

@push('styles')
    @vite('resources/css/musicGroup.css')
@endpush

@section('content')
<div class="back">
    <a href="{{ route('groups') }}" class="back-btn">Вернуться</a>
</div>

<section class="band-section">
    <h1 class="band-title">{{ $group->Name }}</h1>
    
    <div class="band-image-wrapper">
        <img src="{{ asset('img/groups/' . ($group->media->Media_file ?? 'default.png')) }}" alt="{{ $group->Name }}" class="band-image">
    </div>
    
    <div class="band-info-row">
        <div class="band-info-card" id="card-left">
            {!! nl2br(e($group->Group_composition)) !!}
        </div>

        <div class="band-info-card" id="card-right">
            Жанр ID: {{ $group->Genre_ID }}
        </div>
    </div>
    
    <div class="band-about">
        {{ $group->Description }}
    </div>
</section>
@endsection