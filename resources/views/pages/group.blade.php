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
    
    <div class="band-image-wrapper" style="position: relative; width: 70%; margin: 0 auto; border: 3px solid #FFA600; border-radius: 20px; overflow: hidden;">
        @if(isset($group->media->Video_File) && $group->media->Video_File)
            <!-- Видео -->
            <video id="groupVideo" width="100%" controls poster="{{ asset('img/groups/' . ($group->media->Media_file ?? 'default.png')) }}" style="display: block;">
                <source src="{{ asset($group->media->Video_File) }}" type="video/mp4">
                Ваш браузер не поддерживает видео.
            </video>
        @else
            <!-- Если видео нет, показываем картинку -->
            <img src="{{ asset('img/groups/' . ($group->media->Media_file ?? 'default.png')) }}" alt="{{ $group->Name }}" class="band-image" style="width: 100%; display: block;">
        @endif
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