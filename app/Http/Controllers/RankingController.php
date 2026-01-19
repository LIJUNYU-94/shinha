<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        $allTime = Score::with('user')->orderByDesc('points')->take(10)->get();
        $daily = Score::with('user')->whereDate('created_at', Carbon::today())->orderByDesc('points')->take(10)->get();

        return view('rankings', compact('allTime', 'daily'));
    }
}
