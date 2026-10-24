<?php

namespace App\Http\Controllers\Web;

use App\Models\FoodRecord;
use App\Models\Children;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FoodRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = FoodRecord::whereHas('child', function ($q) {
            $q->where('user_id', Auth::id());
        })->with('child');

        $query->when($request->child_id, function ($q) use ($request) {
            $q->where('child_id', $request->child_id);
        });

        $query->when($request->feeding_period, function ($q) use ($request) {
            $q->where('feeding_period', $request->feeding_period);
        });

        $query->when($request->date, function ($q) use ($request) {
            $q->whereDate('record_date', $request->date);
        });

        $records = $query->latest()->paginate(10)->withQueryString();

        $children = \App\Models\Children::where('user_id', Auth::id())->get();

        return view('food.index', compact('records', 'children'));
    }

    public function create()
    {
        if (Auth::user()->role === 'admin') {
            $children = Children::all();
        } else {
            $children = Children::where('user_id', Auth::id())->get();
        }

        return view('food.create', compact('children'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required',
            'record_date' => 'required|date',
            'food_type' => 'required',
            'feeding_period' => 'required'
        ], [
            'child_id.required' => 'Pilih anak',
            'record_date.required' => 'Tanggal wajib diisi',
            'food_type.required' => 'Jenis makanan wajib diisi',
            'feeding_period.required' => 'Waktu wajib diisi',
        ]);

        FoodRecord::create([
            'child_id' => $request->child_id,
            'record_date' => $request->record_date,
            'food_type' => $request->food_type,
            'feeding_period' => $request->feeding_period
        ]);

        return redirect('/food')->with('success', 'Data makanan berhasil disimpan');
    }

    public function edit($id)
    {
        $record = FoodRecord::with('child')->findOrFail($id);

        if (Auth::user()->role === 'user' && $record->child->user_id != Auth::id()) {
            abort(403);
        }

        $children = Children::where('user_id', Auth::id())->get();

        return view('food.edit', compact('record', 'children'));
    }

    public function update(Request $request, $id)
    {
        $record = FoodRecord::with('child')->findOrFail($id);

        if (Auth::user()->role === 'user' && $record->child->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'child_id' => 'required',
            'record_date' => 'required|date',
            'food_type' => 'required',
            'feeding_period' => 'required'
        ]);

        $record->update($request->only('child_id', 'record_date', 'food_type', 'feeding_period'));

        return redirect('/food')->with('success', 'Data makanan berhasil diupdate');
    }

    public function destroy($id)
    {
        $record = FoodRecord::findOrFail($id);
        $currentPage = request('page', 1);
        $record->delete();

        $remainingItems = FoodRecord::whereHas('child', function ($q) {
                $q->where('user_id', Auth::id());
            })->count();

        $itemsPerPage = 10;
        $lastPage = ceil($remainingItems / $itemsPerPage);

        if ($currentPage > $lastPage && $lastPage > 0) {
            return redirect()->route('food.index', ['page' => $lastPage])->with('success', 'Catatan berhasil dihapus.');
        }

        return redirect('/food')->with('success', 'Catatan berhasil dihapus.');
    }
}