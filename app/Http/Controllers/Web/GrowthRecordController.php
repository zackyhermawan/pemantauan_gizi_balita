<?php

namespace App\Http\Controllers\Web;

use App\Models\GrowthRecord;
use App\Models\Children;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Monitoring;

class GrowthRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = GrowthRecord::with(['child', 'admin']);

        if (Auth::user()->role !== 'admin') {
            $query->whereHas('child', function ($q) {
                $q->where('user_id', Auth::id());
            });
        }

        $query->when($request->child_id, function ($q) use ($request) {
            $q->where('child_id', $request->child_id);
        });

        $query->when($request->status, function ($q) use ($request) {
            $q->where('nutritional_status', $request->status);
        });

        $query->when($request->date, function ($q) use ($request) {
            $q->whereDate('record_date', $request->date);
        });

        $records = $query->latest()->paginate(10)->withQueryString();

        $children = Auth::user()->role === 'admin' ? \App\Models\Children::all()  : \App\Models\Children::where('user_id', Auth::id())->get();

        return view('growth.index', compact('records', 'children'));
    }

    public function create()
    {
        if (Auth::user()->role === 'admin') {
            $children = Children::all();
        } else {
            $children = Children::where('user_id', Auth::id())->get();
        }

        return view('growth.create', compact('children'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required',
            'record_date' => 'required|date',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
        ], [
            'child_id.required' => 'Pilih anak',
            'record_date.required' => 'Tanggal wajib diisi',
            'weight.required' => 'Berat badan wajib diisi',
            'height.required' => 'Tinggi badan wajib diisi',
        ]);

        GrowthRecord::create([
            'child_id' => $request->child_id,
            'record_date' => $request->record_date,
            'weight' => $request->weight,
            'height' => $request->height,
        ]);

        return redirect('/growth')->with('success', 'Data pertumbuhan berhasil disimpan');
    }

    public function edit($id)
    {
        $record = GrowthRecord::with('child')->findOrFail($id);
    
        if (Auth::user()->role === 'user' && $record->child->user_id != Auth::id()) {
            abort(403);
        }
        return view('growth.edit', compact('record'));
    }

    public function update(Request $request, $id)
    {
        $record = GrowthRecord::with('child')->findOrFail($id);

        if (Auth::user()->role === 'user' && $record->child->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'child_id' => 'required',
            'record_date' => 'required|date',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        $record->update($request->only('child_id', 'record_date', 'weight', 'height'));

        return redirect('/growth')->with('success', 'Data pertumbuhan berhasil diupdate');
    }

    public function history(Request $request)
    {
        $query = Monitoring::with(['child', 'growth', 'admin'])
            ->whereHas('child', function ($q) {
                $q->where('user_id', Auth::id());
            });

        $query->when($request->child_id, function ($q) use ($request) {
            $q->where('child_id', $request->child_id);
        });

        $query->when($request->nutritional_status, function ($q) use ($request) {
            $q->where('nutritional_status', $request->nutritional_status);
        });

        $query->when($request->date, function ($q) use ($request) {
            $q->whereDate('created_at', $request->date);
        });

        $history = $query->latest()->paginate(10)->withQueryString();

        $children = \App\Models\Children::where('user_id', Auth::id())->get();

        return view('growth.history', compact('history', 'children'));
    }

    public function destroy(Request $request, $id)
    {
        $record = GrowthRecord::findOrFail($id);

        if (Auth::user()->role === 'user' && $record->child->user_id != Auth::id()) {
            abort(403);
        }

        $currentPage = $request->query('page', 1);

        $record->delete();

        $remainingItems = GrowthRecord::whereHas('child', function ($q) {
            if (Auth::user()->role !== 'admin') {
                $q->where('user_id', Auth::id());
            }
        })->count();

        $itemsPerPage = 10;
        $lastPage = ceil($remainingItems / $itemsPerPage);

        if ($currentPage > $lastPage && $lastPage > 0) {
            return redirect()->route('growth.index', ['page' => $lastPage])
                            ->with('success', 'Catatan berhasil dihapus.');
        }

        return redirect('/growth')->with('success', 'Catatan berhasil dihapus.');
    }
}
