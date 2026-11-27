@extends('layouts.app')

@section('title', 'Добавить группу')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('content')
<div class="admin-wrapper">
    <h1 class="admin-title">Добавить новую группу</h1>
    
    <form action="{{ route('admin.group.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        
        <label>Название</label>
        <input type="text" name="Name" required>

        <label>Описание</label>
        <textarea name="Description" rows="3" required></textarea>

        <label>Состав группы</label>
        <textarea name="Group_composition" rows="2" required></textarea>

        <label>Жанр</label>
        <select name="Genre_ID" required>
            @foreach($genres as $genre)
                <option value="{{ $genre->Genre_ID }}">{{ $genre->Genre }}</option>
            @endforeach
        </select>

        <label>Фотография группы</label>
        <input type="file" name="Photo" required>

        
        <label>Видео (необязательно, mp4)</label>
        <input type="file" name="Video_File" accept="video/mp4">

        <button type="submit">Сохранить</button>
    </form>
</div>
@endsection