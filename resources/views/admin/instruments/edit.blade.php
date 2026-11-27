@extends('layouts.app')

@section('title', 'Редактировать инструмент')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('content')
<div class="admin-wrapper">
    <h1 class="admin-title">Редактировать: {{ $instrument->Name }}</h1>
    
    <form action="{{ route('admin.instrument.update', $instrument->Instrument_ID) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')
        
        <label>Название</label>
        <input type="text" name="Name" value="{{ $instrument->Name }}" required>

        <label>Описание</label>
        <textarea name="Description" rows="3" required>{{ $instrument->Description }}</textarea>

        <label>Категория</label>
        <select name="Category_ID" required>
            <option value="1" {{ $instrument->Category_ID == 1 ? 'selected' : '' }}>Электронные</option>
            <option value="2" {{ $instrument->Category_ID == 2 ? 'selected' : '' }}>Ударные</option>
            <option value="3" {{ $instrument->Category_ID == 3 ? 'selected' : '' }}>Струнные</option>
            <option value="4" {{ $instrument->Category_ID == 4 ? 'selected' : '' }}>Духовые</option>
            <option value="5" {{ $instrument->Category_ID == 5 ? 'selected' : '' }}>Язычковые</option>
        </select>

        <label>Тег (для опросника)</label>
        <select name="Tag_ID" required>
            <option value="3" {{ $instrument->Tag_ID == 3 ? 'selected' : '' }}>Струнные</option>
            <option value="4" {{ $instrument->Tag_ID == 4 ? 'selected' : '' }}>Духовые</option>
            <option value="5" {{ $instrument->Tag_ID == 5 ? 'selected' : '' }}>Ударные</option>
            <option value="6" {{ $instrument->Tag_ID == 6 ? 'selected' : '' }}>Клавишные</option>
        </select>

        <label>Звук из базы</label>
        <select name="Sound_ID" required>
            @foreach($sounds as $sound)
                <option value="{{ $sound->Sound_ID }}" {{ $instrument->Sound_ID == $sound->Sound_ID ? 'selected' : '' }}>{{ $sound->Sound }}</option>
            @endforeach
        </select>

        <button type="submit">Обновить</button>
    </form>
</div>
@endsection