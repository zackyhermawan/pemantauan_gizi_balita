<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Prayer;
use Illuminate\Http\Request;

class PrayerController extends Controller
{
    //
   public function index(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('search');

        $query = Prayer::query();

        if ($category && $category !== 'Semua') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        $prayers = $query->get();
        
        $categories = Prayer::whereNotNull('category')->distinct()->pluck('category');

        return view('prayer.index', compact('prayers', 'categories', 'category', 'search'));
    }
}
