<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Screenshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScreenshotController extends Controller
{
    public function index()
    {
        $screenshots = Screenshot::with('user')->withCount('likes')->latest()->paginate(12);
        return view('gallery', compact('screenshots'));
    }

    public function toggleLike($id)
    {
        $like = Like::where('user_id', Auth::id())->where('screenshot_id', $id)->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'screenshot_id' => $id,
            ]);
        }

        return back();
    }
}
