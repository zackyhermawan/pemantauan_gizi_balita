<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DailyQuote;
use Illuminate\Http\Request;

class DailyQuoteController extends Controller
{
    public function index()
    {
        $totalQuotes = DailyQuote::count();
        $dailyQuote = null;

        if ($totalQuotes > 0) {
            $dayOfYear = now()->dayOfYear;
            
            $skipIndex = $dayOfYear % $totalQuotes;
            
            $dailyQuote = DailyQuote::skip($skipIndex)->first() ?? DailyQuote::first();
        }

        return view('dashboard', compact('children', 'latestFood', 'dailyQuote'));
    }
}
