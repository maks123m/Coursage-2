<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\MusicInstrument;
use App\Models\MusicGroup;

class AdminController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::orderBy('Feedback_ID', 'desc')->get();
        return view('admin.index', ['feedbacks' => $feedbacks]);
    }

    public function createInstrument()
    {
        $sounds = \App\Models\InstrumentSound::all(); 
        return view('admin.instruments.create', ['sounds' => $sounds]);
    }

    public function storeInstrument(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Description' => 'required',
            'Category_ID' => 'required',
            'Tag_ID' => 'required',
            'Photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'Sound_File' => 'nullable|mimes:mp3,wav,ogg|max:10240',
        ]);

        $imageName = time().'.'.$request->Photo->extension();  
        $request->Photo->move(public_path('img/instruments'), $imageName);
        $imagePath = 'instruments/' . $imageName;

        $photo = \App\Models\PhotoInstrument::create(['Photo' => $imagePath]);

        $soundId = $request->Sound_ID;
        if ($request->hasFile('Sound_File')) {
            $soundName = time().'.'.$request->Sound_File->extension();  
            $request->Sound_File->move(public_path('sounds'), $soundName);
            $soundPath = 'sounds/' . $soundName;

            $newSound = \App\Models\InstrumentSound::create(['Sound' => $soundPath]);
            $soundId = $newSound->Sound_ID; 
        }

        MusicInstrument::create([
            'Name' => $request->Name,
            'Description' => $request->Description,
            'Category_ID' => $request->Category_ID,
            'Tag_ID' => $request->Tag_ID,
            'Photo_ID' => $photo->Photo_ID,
            'Sound_ID' => $soundId,
        ]);

        return redirect()->route('admin.index')->with('success', 'Инструмент добавлен!');
    }

    public function instrumentsIndex()
    {
        $instruments = MusicInstrument::orderBy('Instrument_ID', 'desc')->get();
        return view('admin.instruments.index', ['instruments' => $instruments]);
    }

    public function editInstrument($id)
    {
        $instrument = MusicInstrument::findOrFail($id);
        $sounds = \App\Models\InstrumentSound::all();
        return view('admin.instruments.edit', ['instrument' => $instrument, 'sounds' => $sounds]);
    }

    public function updateInstrument(Request $request, $id)
    {
        $instrument = MusicInstrument::findOrFail($id);

        $request->validate([
            'Name' => 'required',
            'Description' => 'required',
            'Category_ID' => 'required',
            'Tag_ID' => 'required',
            'Sound_ID' => 'required',
        ]);

        $instrument->update([
            'Name' => $request->Name,
            'Description' => $request->Description,
            'Category_ID' => $request->Category_ID,
            'Tag_ID' => $request->Tag_ID,
            'Sound_ID' => $request->Sound_ID,
        ]);

        return redirect()->route('admin.instruments.index')->with('success', 'Инструмент обновлен!');
    }

    public function destroyInstrument($id)
    {
        $instrument = MusicInstrument::findOrFail($id);
        $instrument->delete();

        return redirect()->back()->with('success', 'Инструмент удален.');
    }
    public function destroyFeedback($id)
    {
        $feedback = \App\Models\Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->back()->with('success', 'Заявка удалена.');
    }

    // --- УПРАВЛЕНИЕ ГРУППАМИ ---

    // 1. Список групп
    public function groupsIndex()
    {
        $groups = MusicGroup::orderBy('Group_ID', 'desc')->get();
        return view('admin.groups.index', ['groups' => $groups]);
    }

    // 2. Форма создания группы
    public function createGroup()
    {
        $genres = \App\Models\Genre::all(); // Достаем жанры
        return view('admin.groups.create', ['genres' => $genres]);
    }

    // 3. Сохранение новой группы
    public function storeGroup(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Description' => 'required',
            'Genre_ID' => 'required',
            'Group_composition' => 'required',
            'Photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'Video_File' => 'nullable|mimes:mp4,mov,webm|max:51200',
        ]);

        // Загружаем картинку
        $imageName = time().'.'.$request->Photo->extension();
        $request->Photo->move(public_path('img/groups'), $imageName);
        $imagePath = 'groups/' . $imageName;

        // Загружаем видео, если оно пришло
        $videoPath = null;
        if ($request->hasFile('Video_File')) {
            $videoName = time().'_video.'.$request->Video_File->extension();
            $request->Video_File->move(public_path('videos'), $videoName);
            $videoPath = 'videos/' . $videoName;
        }

        // Создаем медиа-запись (одну!)
        $media = \App\Models\MediaGroup::create([
            'Media_file' => $imagePath,
            'Video_File' => $videoPath,
        ]);

        // Создаем группу
        MusicGroup::create([
            'Name' => $request->Name,
            'Description' => $request->Description,
            'Genre_ID' => $request->Genre_ID,
            'Group_composition' => $request->Group_composition,
            'Media_group_ID' => $media->Media_group_ID,
        ]);

        return redirect()->route('admin.groups.index')->with('success', 'Группа добавлена!');
    }


    // 4. Форма редактирования группы
    public function editGroup($id)
    {
        $group = MusicGroup::findOrFail($id);
        $genres = \App\Models\Genre::all();
        return view('admin.groups.edit', ['group' => $group, 'genres' => $genres]);
    }

    // 5. Сохранение изменений
    public function updateGroup(Request $request, $id)
    {
        $group = MusicGroup::findOrFail($id);

        $request->validate([
            'Name' => 'required',
            'Description' => 'required',
            'Genre_ID' => 'required',
            'Group_composition' => 'required',
        ]);

        $group->update([
            'Name' => $request->Name,
            'Description' => $request->Description,
            'Genre_ID' => $request->Genre_ID,
            'Group_composition' => $request->Group_composition,
        ]);
        if ($request->hasFile('Video_File')) {
            $videoName = time().'_video.'.$request->Video_File->extension();
            $request->Video_File->move(public_path('videos'), $videoName);

            $media = $group->media;
            if ($media) {
                $media->update(['Video_File' => 'videos/' . $videoName]);
            } else {
                $media = \App\Models\MediaGroup::create([
                    'Media_file' => 'groups/default.jpg',
                    'Video_File' => 'videos/' . $videoName,
                ]);
                $group->update(['Media_group_ID' => $media->Media_group_ID]);
            }
        }


        return redirect()->route('admin.groups.index')->with('success', 'Группа обновлена!');
    }

    // 6. Удаление группы
    public function destroyGroup($id)
    {
        $group = MusicGroup::findOrFail($id);
        $group->delete();

        return redirect()->back()->with('success', 'Группа удалена.');
    }
}