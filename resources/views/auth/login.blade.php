<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-rose-100 via-white to-rose-50 antialiased">
    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 md:p-10 transition-all">
        <div class="w-full lg:max-w-md min-h-[580px] md:min-h-0 bg-white/80 backdrop-blur-xl border border-rose-100 shadow-2xl rounded-[2.5rem] p-8 md:p-10 flex flex-col justify-center transition-all">

            <div class="text-center mb-10 transition-all">
                <div class="w-16 h-16 mx-auto bg-rose-100 text-rose-500 rounded-2xl flex items-center justify-center shadow-inner mb-6 transition-transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A9 9 0 1118.364 4.56 9 9 0 015.12 17.804z" />
                    </svg>
                </div>

                <h2 class="text-3xl md:text-2xl font-black text-slate-800 tracking-tight transition-all">
                    Selamat Datang
                </h2>
                <p class="text-base md:text-sm text-slate-400 font-medium mt-2 transition-all">
                    Silakan login untuk melanjutkan
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-600 rounded-2xl text-sm font-bold flex items-center gap-3 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            <form method="POST" action="/login" onsubmit="handleLogin(this)" class="space-y-6 md:space-y-5">
                @csrf

                {{-- USERNAME --}}
                <div class="relative group">
                    <input type="text" name="username"
                        placeholder="Username"
                        class="w-full pl-12 pr-4 py-4 md:py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-base md:text-sm font-bold text-slate-700 focus:ring-4 focus:ring-rose-200 shadow-inner outline-none transition-all focus:bg-white focus:border-rose-100">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xl md:text-lg opacity-60 group-focus-within:opacity-100 transition-opacity">👤</span>
                </div>

                {{-- PASSWORD --}}
                <div class="relative group">
                    <input type="password" name="password"
                        placeholder="Password"
                        class="w-full pl-12 pr-4 py-4 md:py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-base md:text-sm font-bold text-slate-700 focus:ring-4 focus:ring-rose-200 shadow-inner outline-none transition-all focus:bg-white focus:border-rose-100">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-xl md:text-lg opacity-60 group-focus-within:opacity-100 transition-opacity">🔒</span>
                </div>

                {{-- BUTTON --}}
                <button type="submit" id="loginBtn"
                    class="w-full py-3 md:py-4 bg-rose-500 text-white font-black rounded-2xl shadow-xl shadow-rose-200 hover:bg-rose-600 hover:-translate-y-0.5 active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                    
                    <span id="btnText" class="text-lg md:text-base transition-all">Masuk Sekarang</span>

                    <svg id="spinner" class="hidden animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

            {{-- FOOTER --}}
            <div class="mt-10 md:mt-8 transition-all">
                <p class="text-sm md:text-xs text-center text-slate-400 font-medium uppercase tracking-widest transition-all">
                    Belum punya akun?
                    <a href="/register" class="text-rose-500 font-black hover:text-rose-600 ml-1 transition-colors hover:underline">
                        Daftar
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function handleLogin(form) {
            const btn = document.getElementById('loginBtn');
            const text = document.getElementById('btnText');
            const spinner = document.getElementById('spinner');

            btn.disabled = true;
            btn.classList.add('opacity-80', 'cursor-not-allowed');

            text.innerText = 'Menghubungkan...'; 
            spinner.classList.remove('hidden');

            return true;
        }
    </script>
</body>
</html>