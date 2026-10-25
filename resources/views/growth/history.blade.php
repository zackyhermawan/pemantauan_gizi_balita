@extends('layouts.app')

@section('title', 'Riwayat Validasi')

@section('content')

<div class="py-4 md:py-6 px-2 md:px-4 w-full max-w-5xl mx-auto">
    <div class="mb-6 md:mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="px-2">
            <h1 class="text-xl md:text-xl font-black text-slate-800 leading-tight">Riwayat Validasi</h1>
            <p class="text-slate-400 text-xs md:text-sm font-bold mt-1">Pantau hasil pemeriksaan & saran tenaga medis.</p>
        </div>
        
        <div class="bg-white px-5 py-4 rounded-xl border border-slate-100 flex items-center shadow-sm self-start md:self-auto min-w-[180px]">
            <div class="w-10 h-10 bg-rose-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-rose-100 mr-4 shrink-0">
                <x-heroicon-o-chart-bar class="w-6 h-6" />
            </div>
            <div>
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Data</p>
                <p class="text-xl font-black text-slate-800 leading-none">{{ $history->total() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 md:p-6 rounded-xl shadow-sm border border-slate-50 mb-8 mx-2">
        <form action="/growth/history" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
            <div>
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 mb-2 block italic">Filter Anak</label>
                <select name="child_id" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-rose-200 transition-all appearance-none">
                    <option value="">Semua Anak</option>
                    @foreach($children as $child)
                        <option value="{{ $child->id }}" {{ request('child_id') == $child->id ? 'selected' : '' }}>{{ $child->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 mb-2 block italic">Status Gizi</label>
                <select name="nutritional_status" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-rose-200 transition-all appearance-none">
                    <option value="">Semua Status</option>
                    <option value="Gizi Baik" {{ request('nutritional_status') == 'Gizi Baik' ? 'selected' : '' }}>Gizi Baik</option>
                    <option value="Stunting" {{ request('nutritional_status') == 'Stunting' ? 'selected' : '' }}>Stunting</option>
                    <option value="Gizi Kurang" {{ request('nutritional_status') == 'Gizi Kurang' ? 'selected' : '' }}>Gizi Kurang</option>
                </select>
            </div>

            <div>
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 mb-2 block italic">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-700 focus:ring-2 focus:ring-rose-200 transition-all">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-3 bg-slate-800 text-white font-black rounded-xl uppercase text-[10px] tracking-widest shadow-md hover:bg-slate-700 active:scale-95 transition-all">
                    Cari
                </button>
                <a href="/growth/history" class="px-4 py-3 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center hover:bg-slate-200 transition-all active:scale-95">
                    <x-heroicon-o-arrow-path class="w-5 h-5" />
                </a>
            </div>
        </form>
    </div>

    <div class="space-y-6 px-2">
        @forelse($history as $item)
            <div class="bg-white border border-slate-100 rounded-xl p-6 md:p-8 shadow-sm hover:shadow-md transition-all relative overflow-hidden">
                
                <div class="absolute top-0 right-0 w-24 h-24 bg-rose-50/50 rounded-full -mr-10 -mt-10"></div>

                <div class="flex justify-between items-start mb-6 relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-rose-100 text-rose-500 rounded-xl flex items-center justify-center text-lg md:text-xl font-black shadow-inner border border-rose-50">
                            {{ substr($item->child->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-[9px] md:text-[10px] font-black text-rose-500 uppercase tracking-[0.15em] leading-none mb-1">Profil Balita</p>
                            <h3 class="font-bold text-slate-800 text-lg md:text-xl">
                                {{ $item->child->name }}
                            </h3>
                        </div>
                    </div>

                    <div class="text-right">
                        <span class="px-3 py-1.5 bg-slate-50 text-slate-400 rounded-lg text-[9px] font-black uppercase tracking-widest border border-slate-100">
                            {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y') }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 md:gap-4 mb-6 relative z-10">
                    {{-- Fisik --}}
                    <div class="bg-slate-50/50 p-4 rounded-xl border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Data Fisik</p>
                        <p class="text-base md:text-lg font-black text-slate-700 italic">
                            {{ $item->growth->weight ?? '—' }}<span class="text-[10px] opacity-50 ml-0.5">kg</span> 
                            <span class="text-slate-300 mx-1">/</span> 
                            {{ $item->growth->height ?? '—' }}<span class="text-[10px] opacity-50 ml-0.5">cm</span>
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border flex flex-col justify-center {{ $item->nutritional_status == 'Gizi Baik' ? 'bg-emerald-50/50 border-emerald-100' : 'bg-amber-50/50 border-amber-100' }}">
                        <p class="text-[9px] font-black {{ $item->nutritional_status == 'Gizi Baik' ? 'text-emerald-400' : 'text-amber-500' }} uppercase mb-1 tracking-widest">Status Gizi</p>
                        <span class="text-sm md:text-base font-black {{ $item->nutritional_status == 'Gizi Baik' ? 'text-emerald-600' : 'text-amber-600' }} uppercase italic">
                            {{ $item->nutritional_status ?? 'Dalam Proses' }}
                        </span>
                    </div>

                    <div class="bg-rose-50/50 p-4 rounded-xl border border-rose-100 flex flex-col justify-center">
                        <p class="text-[9px] font-black text-rose-400 uppercase mb-1 tracking-widest">Status Validasi</p>
                        <span class="text-sm md:text-base font-black text-rose-600 uppercase italic">
                            {{ $item->status }}
                        </span>
                    </div>
                </div>

                @if($item->admin_notes)
                <div class="relative z-10 mt-2 mb-4">
                    <div class="bg-white p-4 md:p-5 rounded-xl border-2 border-rose-50 relative">
                        {{-- Little speech bubble triangle --}}
                        <div class="absolute -top-2 left-6 w-4 h-4 bg-white border-t-2 border-l-2 border-rose-50 transform rotate-45"></div>
                        
                        <div class="flex items-center mb-2">
                            <x-heroicon-m-chat-bubble-left-right class="w-4 h-4 text-rose-400 mr-2" />
                            <span class="text-[10px] font-black text-rose-500 uppercase tracking-widest italic">Rekomendasi Admin:</span>
                        </div>
                        <p class="text-xs md:text-sm font-bold text-slate-600 italic leading-relaxed pl-1">
                            "{{ $item->admin_notes }}"
                        </p>
                    </div>
                </div>
                @endif

                @if($item->quranVerse)
                <div class="relative z-10 mt-4 bg-emerald-50/40 border border-slate-100 rounded-2xl p-5 md:p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-base">🌿</span>
                        <h4 class="text-xs font-black text-emerald-800 uppercase tracking-widest">Renungan untuk Bunda</h4>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 border border-emerald-100 space-y-3">
                        <p class="text-xs font-bold text-emerald-700 flex items-center gap-1.5">
                            <span>📖</span> {{ $item->quranVerse->surah }}
                        </p>

                        <p class="text-right text-lg md:text-xl font-serif text-slate-800 leading-loose py-1" dir="rtl">
                            {{ $item->quranVerse->arabic_text }}
                        </p>

                        <p class="text-xs md:text-sm font-medium text-slate-600 italic leading-relaxed bg-emerald-50/30 p-3 rounded-lg border-l-2 border-emerald-400">
                            "{{ $item->quranVerse->translation }}"
                        </p>

                        <div class="pt-2 border-t border-slate-100">
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-wider mb-1">Makna & Hikmah:</p>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                {{ $item->quranVerse->meaning }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        @empty
            <div class="bg-white rounded-xl p-16 text-center border-2 border-dashed border-slate-100 mx-2">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <x-heroicon-o-document-magnifying-glass class="w-8 h-8 text-slate-300" />
                </div>
                <p class="text-slate-400 font-black italic uppercase text-xs tracking-widest">
                    Data riwayat tidak ditemukan
                </p>
            </div>
        @endforelse
    </div>

    <div class="mt-10 flex justify-center scale-90 md:scale-100">
        {{ $history->links() }}
    </div>

</div>

@endsection