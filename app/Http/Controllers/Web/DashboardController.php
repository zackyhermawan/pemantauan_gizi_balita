<?php

namespace App\Http\Controllers\Web;

use App\Models\Children;
use App\Models\GrowthRecord;
use App\Models\FoodRecord;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\DailyQuote;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $children = Children::where('user_id', $user->id)
            ->with([
                'latestGrowthRecord',
                'monitorings' => function ($q) {
                    $q->latest();
                }
            ])
            ->get();

        $latestFood = FoodRecord::whereIn('child_id', $children->pluck('id'))
            ->with('child')
            ->latest()
            ->take(5)
            ->get();

        // 2. Tambahkan logika pengambil Mutiara Qur'an
        $totalQuotes = DailyQuote::count();
        $dailyQuote = null;

        if ($totalQuotes > 0) {
            $dayOfYear = now()->dayOfYear;
            $offset = $dayOfYear % $totalQuotes;
            
            $dailyQuote = DailyQuote::offset($offset)->first() ?? DailyQuote::first();
        }

        // 3. Masukkan 'dailyQuote' ke dalam compact
        return view('dashboard', compact('children', 'latestFood', 'dailyQuote'));
    }
}