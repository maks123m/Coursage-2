@extends('layouts.app')

@section('title', 'SoundCrafted — Подбор инструмента')

@push('styles')
    @vite('resources/css/survey.css')
@endpush

@section('content')
<div class="wrapper">
    <h1>Давайте узнаем какой инструмент вам может подойти!</h1>
    <div class="survey">
        <p>Вы знаете какой инструмент хотите?</p>
        <div class="option">
            <input type="checkbox" id="know-instrument" name="instrument" value="yes">
            <label for="know-instrument">Да, уже знаю</label>
        </div>
        <div class="option">
            <input type="checkbox" id="dont-know" name="instrument" value="no">
            <label for="dont-know">Нет, еще не знаю</label>
        </div>
    </div>
    <div class="next">

        <a href="{{ route('catalog') }}" class="next-btn">Далее</a>
    </div>
</div>
@endsection