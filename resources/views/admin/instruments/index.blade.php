@extends('layouts.app')

@section('title', 'Управление инструментами')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('content')
<div class="admin-wrapper">
    <h1 class="admin-title">Управление инструментами</h1>
    
    <div class="admin-nav">
        <a href="{{ route('admin.index') }}" class="inactive">Заявки</a>
        <a href="{{ route('admin.instruments.index') }}" class="active">Инструменты</a>
        <a href="{{ route('admin.groups.index') }}" class="inactive">Группы</a>
    </div>

    <div style="margin: 20px 0; text-align: center;">
        <a href="{{ route('admin.instrument.create') }}" class="btn-edit" style="padding: 10px 20px; font-size: 1.2vw;">Добавить новый инструмент</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($instruments as $inst)
                <tr>
                    <td>{{ $inst->Instrument_ID }}</td>
                    <td>{{ $inst->Name }}</td>
                    <td>{{ $inst->Category_ID }}</td>
                    <td style="display: flex; gap: 10px;">
                        <a href="{{ route('admin.instrument.edit', $inst->Instrument_ID) }}" class="btn-edit">Ред.</a>
                        
                        <form action="{{ route('admin.instrument.destroy', $inst->Instrument_ID) }}" method="POST" onsubmit="return confirm('Удалить?');">
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