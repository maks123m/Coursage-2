<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'FIO' => 'required',
            'Instrument_Category' => 'required',
            'Description' => 'required',
        ]);

        Feedback::create([
            'FIO' => $request->FIO,
            'Instrument_Category' => $request->Instrument_Category,
            'Description' => $request->Description,
            'User_ID' =>  auth()->id(),
        ]);
        

        return redirect()->back()->with('success', 'Спасибо! Ваша заявка отправлена.');
    }
}