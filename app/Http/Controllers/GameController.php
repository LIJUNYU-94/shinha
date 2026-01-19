<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Screenshot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function index()
    {
        return view('game');
    }

    public function saveScore(Request $request)
    {
        $request->validate([
            'score' => 'required|integer',
        ]);

        Score::create([
            'user_id' => Auth::id(),
            'points' => $request->score,
        ]);

        return response()->json(['message' => 'Score saved successfully!']);
    }

    public function saveScreenshot(Request $request)
    {
        $request->validate([
            'image' => 'required|string', // Base64 string
            'score' => 'nullable|integer',
        ]);

        $image = $request->image;
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'screenshot_' . Auth::id() . '_' . time() . '.png';
        
        // Save to storage/app/public/screenshots
        Storage::disk('public')->put('screenshots/' . $imageName, base64_decode($image));

        Screenshot::create([
            'user_id' => Auth::id(),
            'image_path' => 'screenshots/' . $imageName,
            'score' => $request->score,
        ]);

        return response()->json(['message' => 'Screenshot saved successfully!']);
    }
}
