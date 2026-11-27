@extends('layouts.app')

@section('title', 'Добавить инструмент')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('content')
<div class="admin-wrapper">
    <h1 class="admin-title">Добавить новый инструмент</h1>
    
    <form action="{{ route('admin.instrument.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        
        <label>Название</label>
        <input type="text" name="Name" required>

        <label>Описание</label>
        <textarea name="Description" rows="3" required></textarea>

        <label>Категория</label>
        <select name="Category_ID" required>
            <option value="1">Электронные</option>
            <option value="2">Ударные</option>
            <option value="3">Струнные</option>
            <option value="4">Духовые</option>
            <option value="5">Язычковые</option>
        </select>

        <label>Тег (для опросника)</label>
        <select name="Tag_ID" required>
            <option value="3">Струнные</option>
            <option value="4">Духовые</option>
            <option value="5">Ударные</option>
            <option value="6">Клавишные</option>
        </select>

        <label>Фотография</label>
        <input type="file" name="Photo" required>

        <label>Выберите звук из базы</label>
        <select name="Sound_ID">
            @foreach($sounds as $sound)
                <option value="{{ $sound->Sound_ID }}">{{ $sound->Sound }}</option>
            @endforeach
        </select>

        <label>Или загрузите свой звук (mp3)</label>
        <input type="file" name="Sound_File" accept="audio/mpeg">

        <button type="submit">Сохранить</button>
    </form>
</div>
@endsection