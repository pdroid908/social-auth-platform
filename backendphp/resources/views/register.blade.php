<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0b0f1a">
    <title>Buat Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background:
                radial-gradient(circle at 15% 0%, rgba(139, 92, 246, 0.18), transparent 40%),
                radial-gradient(circle at 85% 20%, rgba(34, 211, 238, 0.14), transparent 40%),
                radial-gradient(circle at 50% 100%, rgba(236, 72, 153, 0.10), transparent 45%),
                #0a0e1a;
        }

        .glass {
            background: rgba(17, 22, 39, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .card {
            background: linear-gradient(180deg, rgba(255,255,255,0.05), rgba(255,255,255,0.02));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
            transition: transform .15s ease, box-shadow .2s ease, filter .2s ease;
        }
        .btn-primary:hover { filter: brightness(1.12); box-shadow: 0 10px 26px rgba(99, 102, 241, 0.5); }
        .btn-primary:active { transform: scale(.98); }

        .field {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        }
        .field:focus {
            outline: none;
            background: rgba(255,255,255,0.06);
            border-color: rgba(139, 92, 246, 0.6);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }

        .field::placeholder { color: rgba(203,213,225,0.35); }

        .fade-in { animation: fadeIn .4s ease both; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="text-slate-100 min-h-screen flex items-center justify-center px-4 sm:px-6 py-10">

@if($errors->any())
<div class="fixed inset-0 flex items-center justify-center bg-black/70 backdrop-blur-sm z-50 px-4">
    <div class="glass p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-2xl text-center max-w-sm w-full">
        <div class="text-rose-400 mb-4 text-4xl">⚠️</div>
        <h3 class="text-lg sm:text-xl font-bold text-slate-100 mb-2">Terjadi Kesalahan</h3>
        <p class="text-slate-400 mb-6 text-sm sm:text-base">Mohon lengkapi data dengan benar.</p>
        <button onclick="this.parentElement.parentElement.remove()"
                class="w-full btn-primary text-white py-2 rounded-xl font-semibold">
            Mengerti
        </button>
    </div>
</div>
@endif

<div class="w-full max-w-md">
    <div class="text-center mb-6 sm:mb-8 fade-in">
        <h1 class="text-3xl sm:text-5xl font-extrabold bg-gradient-to-r from-violet-300 via-sky-300 to-emerald-300 bg-clip-text text-transparent">
            ReadSpace
        </h1>
        <p class="text-slate-400 mt-2 sm:mt-3 text-sm sm:text-base">
            Bergabung dan mulai bagikan cerita, ide, serta pemikiranmu.
        </p>
    </div>

    <div class="card rounded-2xl sm:rounded-3xl shadow-2xl shadow-black/40 p-6 sm:p-8 fade-in">
        <h2 class="text-xl sm:text-3xl font-extrabold text-slate-100 mb-2">
            Buat Akun
        </h2>
        <p class="text-slate-400 mb-5 sm:mb-6 text-sm sm:text-base">
            Daftar gratis dan mulai menulis hari ini.
        </p>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div class="mb-4 sm:mb-5">
                <label class="block mb-2 font-medium text-slate-300 text-sm sm:text-base">Nama</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="field w-full text-slate-100 rounded-xl px-4 py-2.5 sm:py-3 text-sm sm:text-base">
            </div>

            <div class="mb-4 sm:mb-5">
                <label class="block mb-2 font-medium text-slate-300 text-sm sm:text-base">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="field w-full text-slate-100 rounded-xl px-4 py-2.5 sm:py-3 text-sm sm:text-base">
            </div>

            <div class="mb-5 sm:mb-6">
                <label class="block mb-2 font-medium text-slate-300 text-sm sm:text-base">Password</label>
                <input
                    type="password"
                    name="password"
                    class="field w-full text-slate-100 rounded-xl px-4 py-2.5 sm:py-3 text-sm sm:text-base">
            </div>

            <button
                type="submit"
                class="w-full btn-primary text-white font-semibold py-2.5 sm:py-3 rounded-xl transition text-sm sm:text-base">
                Buat Akun
            </button>
        </form>

        <div class="mt-6 sm:mt-8 text-center text-slate-400 text-sm sm:text-base">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="font-semibold text-violet-300 hover:text-violet-200 hover:underline">
                Masuk sekarang
            </a>
        </div>
    </div>
</div>

</body>
</html>