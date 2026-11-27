@extends('layouts.app')

@section('title', 'Админ-панель')

@push('styles')
    @vite('resources/css/admin.css')
@endpush

@section('content')
<div class="admin-wrapper">
    <h1 class="admin-title">Панель администратора</h1>
    
    <div class="admin-nav">
        <a href="{{ route('admin.index') }}" class="active">Заявки</a>
        <a href="{{ route('admin.instruments.index') }}" class="inactive">Инструменты</a>
        <a href="{{ route('admin.groups.index') }}" class="inactive">Группы</a>
    </div>

    <!-- Блок заявок -->
    <div class="admin-content-block">
        <h2 class="admin-block-title">Заявки от пользователей</h2>
        
        @if($feedbacks->isEmpty())
            <p class="admin-empty-text">Заявок пока нет.</p>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ФИО</th>
                        <th>Категория</th>
                        <th>Описание</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $fb)
                        <tr>
                            <td>{{ $fb->Feedback_ID }}</td>
                            <td>{{ $fb->FIO }}</td>
                            <td>{{ $fb->Instrument_Category }}</td>
                            <td>{{ $fb->Description }}</td>
                            <td>
                                <form action="{{ route('admin.feedback.destroy', $fb->Feedback_ID) }}" method="POST" onsubmit="return confirm('Удалить эту заявку?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection