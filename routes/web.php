<?php

use Illuminate\Support\Facades\Route;
use App\Models\MusicGroup;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FavoriteController;

// Главная
Route::get('/', function () {
    return view('pages.index');
})->name('home');

// Виды инструментов
Route::get('/types', function () {
    return view('pages.typesTools');
})->name('typesTools');

//каталог всех инструментов
Route::get('/catalog', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\MusicInstrument::query();

    // Поиск по названию
    if ($request->has('search') && $request->search != '') {
        $query->where('Name', 'like', '%' . $request->search . '%');
    }

    $instruments = $query->paginate(6)->withQueryString();
    
    return view('pages.catalog', ['instruments' => $instruments]);
})->name('catalog');

// Конкретный инструмент
Route::get('/tool/{id}', function ($id) {
    $instrument = \App\Models\MusicInstrument::findOrFail($id);
    return view('pages.tool', ['instrument' => $instrument]);
})->name('tool');

// Группы

Route::get('/groups', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\MusicGroup::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('Name', 'like', '%' . $request->search . '%');
    }

    if ($request->has('genre') && $request->genre != '') {

        $genreId = ($request->genre == 'Рок') ? 1 : (($request->genre == 'Поп') ? 2 : 3);
        $query->where('Genre_ID', $genreId);
    }


    $groups = $query->paginate(6)->withQueryString();
    
    return view('pages.groups', ['groups' => $groups]);
})->name('groups');

// Опрос
Route::get('/survey', function () {
    return view('pages.survey');
})->name('survey');

// Избранное
Route::get('/favourites', function () {
    return view('pages.favourites');
})->name('favourites');

Route::get('/group/{id}', function ($id) {
    $group = \App\Models\MusicGroup::findOrFail($id);
    return view('pages.group', ['group' => $group]);
})->name('group');



// Регистрация
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Авторизация
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Выход
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Feedback
Route::post('/feedback', [FeedbackController::class, 'store'])->middleware('auth')->name('feedback.store');

Route::post('/favorite/toggle', [FavoriteController::class, 'toggle'])->name('favorite.toggle');