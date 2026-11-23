@extends('layouts.app')

@section('title', 'SoundCrafted — Подбор инструмента')

@push('styles')
    @vite('resources/css/survey.css')
    @vite('resources/css/toolsMain.css')
@endpush

@section('content')
<div class="survey-wrapper">
    
    @if(!isset($recommended))
        <h1 class="survey-title">Давайте узнаем, какой инструмент вам подойдет!</h1>
        
        <form action="{{ route('survey.result') }}" method="POST" class="survey-form">
            @csrf
            
            <!-- Вопрос 1 -->
            <div class="survey-question">
                <p>1. Какая музыка вам больше нравится?</p>
                <label class="survey-option"><input type="radio" name="q1" value="3" required> Классика и акустика</label>
                <label class="survey-option"><input type="radio" name="q1" value="4" required> Джаз и оркестр</label>
                <label class="survey-option"><input type="radio" name="q1" value="5" required> Рок и энергичные ритмы</label>
                <label class="survey-option"><input type="radio" name="q1" value="6" required> Электронная музыка и синтезаторы</label>
            </div>

            <!-- Вопрос 2 -->
            <div class="survey-question">
                <p>2. Что для вас важнее в инструменте?</p>
                <label class="survey-option"><input type="radio" name="q2" value="3" required> Мелодичность и плавность</label>
                <label class="survey-option"><input type="radio" name="q2" value="4" required> Яркость и громкость</label>
                <label class="survey-option"><input type="radio" name="q2" value="5" required> Четкий ритм</label>
                <label class="survey-option"><input type="radio" name="q2" value="6" required> Возможность создавать разные звуки</label>
            </div>

            <!-- Вопрос 3 -->
            <div class="survey-question">
                <p>3. Как вы предпочитаете играть?</p>
                <label class="survey-option"><input type="radio" name="q3" value="3" required> Перебирать струны пальцами</label>
                <label class="survey-option"><input type="radio" name="q3" value="4" required> Дуть в инструмент</label>
                <label class="survey-option"><input type="radio" name="q3" value="5" required> Стучать по поверхности</label>
                <label class="survey-option"><input type="radio" name="q3" value="6" required> Нажимать на клавиши</label>
            </div>

            <!-- Вопрос 4 -->
            <div class="survey-question">
                <p>4. Ваш любимый жанр?</p>
                <label class="survey-option"><input type="radio" name="q4" value="3" required> Фолк и акустический рок</label>
                <label class="survey-option"><input type="radio" name="q4" value="4" required> Джаз и блюз</label>
                <label class="survey-option"><input type="radio" name="q4" value="5" required> Металл и панк</label>
                <label class="survey-option"><input type="radio" name="q4" value="6" required> Поп и электроника</label>
            </div>

            <!-- Вопрос 5 -->
            <div class="survey-question" style="border-bottom: none; padding-bottom: 0;">
                <p>5. Какой инструмент вызывает у вас больше эмоций?</p>
                <label class="survey-option"><input type="radio" name="q5" value="3" required> Гитара или скрипка</label>
                <label class="survey-option"><input type="radio" name="q5" value="4" required> Труба или саксофон</label>
                <label class="survey-option"><input type="radio" name="q5" value="5" required> Барабаны</label>
                <label class="survey-option"><input type="radio" name="q5" value="6" required> Пианино</label>
            </div>

            <button type="submit" class="survey-submit">Узнать результат</button>
        </form>

    @else
        <!-- Результаты -->
        <div class="survey-results">
            <h1 class="survey-title">Мы подобрали для вас инструменты!</h1>
            
            @if($recommended->isNotEmpty())
                <div class="tools-grid">
                    @foreach($recommended as $instrument)
                        <div class="tool-card">
                            <a href="{{ route('tool', $instrument->Instrument_ID) }}" style="text-decoration: none;">
                                <img src="{{ asset('img/' . ($instrument->photo->Photo ?? 'default.png')) }}" alt="{{ $instrument->Name }}">
                                <div class="tool-info">
                                    <span>{{ $instrument->Name ?? 'Инструмент' }}</span>
                                    <img class="heart" src="{{ asset('img/heart.png') }}">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="survey-option">К сожалению, мы не нашли подходящих инструментов. Попробуйте еще раз!</p>
            @endif
            
            <div style="margin-top: 50px;">
                <a href="{{ route('survey') }}" class="survey-option" style="color: #FFA600; text-decoration: underline;">Пройти опрос заново</a>
            </div>
        </div>
    @endif
</div>
@endsection