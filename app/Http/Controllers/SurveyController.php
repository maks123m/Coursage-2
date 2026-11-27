<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicInstrument;

class SurveyController extends Controller
{
    public function result(Request $request)
    {
        $answers = [
            $request->input('q1'),
            $request->input('q2'),
            $request->input('q3'),
            $request->input('q4'),
            $request->input('q5'),
        ];

        $scores = array_count_values($answers);
        arsort($scores);
        
        $winningTagId = array_key_first($scores);
        $recommended = MusicInstrument::where('Tag_ID', $winningTagId)->take(3)->get();

        return view('pages.survey', ['recommended' => $recommended]);
    }
}