@extends('layouts.app')

@section('title', 'Katalog Doa Anak')

@section('content')
<div class="px-2">
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">
            Katalog Doa Anak
        </h1>
        <p class="text-xs md:text-sm text-slate-500 font-medium mt-1">
            Kumpulan doa harian dan tuntunan spiritual untuk membimbing si kecil.
        </p>
    </div>

    {{-- Filter & Search Bar --}}
    <div class="bg-white p-5 md:p-6 rounded-2xl md:rounded-3xl shadow-sm border border-rose-50 mb-6 mx-2">
        <form action="{{ route('prayer.index') }}" method="GET" class="space-y-4">
            
            {{-- Row 1: Search Bar & Button Action --}}
            <div class="flex flex-col md:flex-row gap-3">
                {{-- Input Pencarian --}}
                <div class="flex-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase mb-1.5 block ml-1 tracking-widest italic">Cari Doa</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Ketik judul doa atau kata kunci..." 
                            class="w-full px-4 py-3 bg-slate-100 border-none rounded-xl text-sm font-bold text-slate-700 focus:ring-2 focus:ring-rose-200 transition-all placeholder:font-normal placeholder:text-slate-400"
                        >
                    </div>
                </div>

                {{-- Keep hidden category when submitting search via button --}}
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                {{-- Tombol Cari & Reset --}}
                <div class="flex items-end gap-2 pt-1 md:pt-0">
                    <button type="submit" class="flex-1 md:flex-none md:px-8 py-3 bg-slate-800 text-white font-black rounded-xl text-xs uppercase tracking-widest hover:bg-slate-700 transition-all shadow-md active:scale-95">
                        Cari
                    </button>
                    <a href="{{ route('prayer.index') }}" class="px-4 py-3 bg-slate-100 text-slate-500 font-bold rounded-xl text-xs uppercase tracking-widest flex items-center justify-center hover:bg-slate-200 transition-all active:scale-95">
                        Reset
                    </a>
                </div>
            </div>

            {{-- Row 2: Tab Categories (Quick Filter Pills) --}}
            <div>
                <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block ml-1 tracking-widest italic">Kategori Doa</label>
                <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
                    {{-- Tab Semua --}}
                    <a 
                        href="{{ route('prayer.index', array_filter(['search' => request('search')])) }}" 
                        class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider whitespace-nowrap transition-all {{ !request('category') || request('category') === 'Semua' ? 'bg-rose-500 text-white shadow-md shadow-rose-200 scale-100' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                    >
                        ✨ Semua
                    </a>

                    {{-- Dynamic Category Tabs --}}
                    @foreach($categories as $cat)
                    <a 
                        href="{{ route('prayer.index', array_filter(['category' => $cat, 'search' => request('search')])) }}" 
                        class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider whitespace-nowrap transition-all {{ request('category') === $cat ? 'bg-rose-500 text-white shadow-md shadow-rose-200 scale-100' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                    >
                        {{ $cat }}
                    </a>
                    @endforeach
                </div>
            </div>

        </form>
    </div>

    {{-- Grid Kartu Doa --}}
    @if($prayers->isEmpty())
        <div class="bg-white p-8 rounded-3xl text-center border border-rose-50 text-slate-400 italic text-sm">
            Doa tidak ditemukan. Coba gunakan kata kunci atau filter lain.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            @foreach($prayers as $prayer)
            <div class="bg-white rounded-3xl p-6 border border-rose-50 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                <div>
                    {{-- Badge Kategori & Judul --}}
                    <div class="flex items-center justify-between mb-3">
                        <span class="bg-rose-50 text-rose-600 text-[10px] md:text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider">
                            {{ $prayer->category ?? 'Umum' }}
                        </span>
                    </div>

                    <h3 class="text-base md:text-lg font-black text-slate-800 mb-4">
                        {{ $prayer->title }}
                    </h3>

                    {{-- Teks Arab --}}
                    <div class="text-right my-4 bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                        <p class="text-xl md:text-2xl font-serif leading-loose text-slate-900 font-bold">
                            {{ $prayer->arabic_text }}
                        </p>
                    </div>

                    {{-- Terjemahan --}}
                    <p class="text-xs md:text-sm text-slate-600 italic mb-4 leading-relaxed font-medium">
                        "{{ $prayer->translation }}"
                    </p>

                    @if(!empty($prayer->fadhilah))
                    <div class="bg-emerald-50/70 rounded-2xl p-2 border border-emerald-100 mb-3">
                        <div class="flex items-start space-x-2.5">
                            <span class="text-emerald-600 text-sm">✨</span>
                            <p class="text-xs text-slate-700 font-medium leading-relaxed">
                                <strong class="text-emerald-800 font-bold">Keutamaan:</strong> {{ $prayer->fadhilah }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Catatan / Tips Pengajaran --}}
                @if(!empty($prayer->notes))
                <div class="bg-amber-50/70 rounded-2xl p-3.5 border border-amber-200/60 mt-2">
                    <div class="flex items-start space-x-2.5">
                        <span class="text-amber-600 text-sm">💡</span>
                        <p class="text-xs text-slate-700 font-medium leading-relaxed">
                            <strong class="text-amber-800 font-bold">Tips Bunda:</strong> {{ $prayer->notes }}
                        </p>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection