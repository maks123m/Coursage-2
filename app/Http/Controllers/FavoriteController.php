<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'type' => 'required|in:group,instrument',
            'id' => 'required|integer'
        ]);

        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'Не авторизован'], 401);
        }

        $type = $request->type;
        $id = $request->id;

        $query = Favorite::where('User_ID', $userId);
        if ($type === 'group') {
            $query->where('Group_ID', $id);
        } else {
            $query->where('Instrument_ID', $id);
        }

        $favorite = $query->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'User_ID' => $userId,
                'Group_ID' => $type === 'group' ? $id : null,
                'Instrument_ID' => $type === 'instrument' ? $id : null,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}