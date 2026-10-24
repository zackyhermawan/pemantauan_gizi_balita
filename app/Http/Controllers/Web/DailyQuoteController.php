<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DailyQuote;
use Illuminate\Http\Request;

class DailyQuoteController extends Controller
{
    //
    public function index()
    {
        $totalQuotes = DailyQuote::count();
        $dailyQuote = null;

        if ($totalQuotes > 0) {
            $dayOfYear = now()->dayOfYear;
            
            // Hitung offset/urutan baris (mulai dari index 0 sampai $totalQuotes - 1)
            $skipIndex = $dayOfYear % $totalQuotes;
            
            // Ambil 1 data dengan cara skip/offset sejumlah $skipIndex
            $dailyQuote = DailyQuote::skip($skipIndex)->first() ?? DailyQuote::first();
        }

        dd($dailyQuote);
        // Mengirim ke view
        return view('dashboard', compact('children', 'latestFood', 'dailyQuote'));
    }
}
