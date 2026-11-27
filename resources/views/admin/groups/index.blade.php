@extends('layouts.app')

@section('title', 'Управление группами')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('content')
<div class="admin-wrapper">
    <h1 class="admin-title">Управление группами</h1>
    
    <div class="admin-nav">
        <a href="{{ route('admin.index') }}" class="inactive">Заявки</a>
        <a href="{{ route('admin.instruments.index') }}" class="inactive">Инструменты</a>
        <a href="{{ route('admin.groups.index') }}" class="active">Группы</a>
    </div>

    <div style="margin: 20px 0; text-align: center;">
        <a href="{{ route('admin.group.create') }}" class="btn-edit" style="padding: 10px 20px; font-size: 1.2vw;">Добавить новую группу</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Жанр</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->Group_ID }}</td>
                    <td>{{ $group->Name }}</td>
                    <td>{{ $group->Genre_ID }}</td>
                    <td style="display: flex; gap: 10px;">
                        <a href="{{ route('admin.group.edit', $group->Group_ID) }}" class="btn-edit">Ред.</a>
                        
                        <form action="{{ route('admin.group.destroy', $group->Group_ID) }}" method="POST" onsubmit="return confirm('Удалить?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection