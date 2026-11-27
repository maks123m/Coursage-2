@extends('layouts.app')

@section('title', 'Редактировать группу')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('content')
<div class="admin-wrapper">
    <h1 class="admin-title">Редактировать: {{ $group->Name }}</h1>
    
    <form action="{{ route('admin.group.update', $group->Group_ID) }}" method="POST" class="admin-form">
        @csrf
        @method('PUT')
        
        <label>Название</label>
        <input type="text" name="Name" value="{{ $group->Name }}" required>

        <label>Описание</label>
        <textarea name="Description" rows="3" required>{{ $group->Description }}</textarea>

        <label>Состав группы</label>
        <textarea name="Group_composition" rows="2" required>{{ $group->Group_composition }}</textarea>

        <label>Жанр</label>
        <select name="Genre_ID" required>
            @foreach($genres as $genre)
                <option value="{{ $genre->Genre_ID }}" {{ $group->Genre_ID == $genre->Genre_ID ? 'selected' : '' }}>{{ $genre->Genre }}</option>
            @endforeach
        </select>

        <button type="submit">Обновить</button>
    </form>
</div>
@endsection