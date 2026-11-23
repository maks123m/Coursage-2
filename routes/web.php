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
    $favoriteInstrumentIds = auth()->check() ? \App\Models\Favorite::where('User_ID', auth()->id())->whereNotNull('Instrument_ID')->pluck('Instrument_ID')->toArray() : [];
    return view('pages.catalog', ['instruments' => $instruments, 'favoriteInstrumentIds' => $favoriteInstrumentIds]);
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
    $favoriteGroupIds = auth()->check() ? \App\Models\Favorite::where('User_ID', auth()->id())->whereNotNull('Group_ID')->pluck('Group_ID')->toArray() : [];

    return view('pages.groups', ['groups' => $groups, 'favoriteGroupIds' => $favoriteGroupIds]);
})->name('groups');

// Опрос
Route::get('/survey', function () {
    return view('pages.survey');
})->name('survey');

// Избранное
Route::get('/favourites', function (\Illuminate\Http\Request $request) {
    $userId = auth()->id();
    $filter = $request->get('filter', 'all');

    $groupsQuery = \App\Models\MusicGroup::whereHas('favorites', function($q) use ($userId) {
        $q->where('User_ID', $userId);
    });
    
    $instrumentsQuery = \App\Models\MusicInstrument::whereHas('favorite', function($q) use ($userId) {
        $q->where('User_ID', $userId);
    });

    $favoriteGroups = collect();
    $favoriteInstruments = collect();

    if ($filter === 'groups') {
        $favoriteGroups = $groupsQuery->paginate(6)->withQueryString();
    } elseif ($filter === 'instruments') {
        $favoriteInstruments = $instrumentsQuery->paginate(6)->withQueryString();
    } else {
        $favoriteGroups = $groupsQuery->take(6)->get();
        $favoriteInstruments = $instrumentsQuery->take(6)->get();
    }

    return view('pages.favourites', compact('favoriteGroups', 'favoriteInstruments', 'filter'));
})->middleware('auth')->name('favourites');

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