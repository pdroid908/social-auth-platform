<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0b0f1a">
    <title>My Posts</title>

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
            min-height: 100vh;
        }

        .card {
            background: linear-gradient(180deg, rgba(255,255,255,0.05), rgba(255,255,255,0.02));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.08);
            transition: transform .3s cubic-bezier(.2,.8,.2,1), box-shadow .3s, border-color .3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 45px rgba(99, 102, 241, 0.15), 0 0 0 1px rgba(139,92,246,0.15);
            border-color: rgba(139, 92, 246, 0.3);
        }

        .accent-bar {
            background: linear-gradient(180deg, #8b5cf6, #22d3ee, #ec4899);
        }

        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
            transition: transform .15s ease, box-shadow .2s ease, filter .2s ease;
        }
        .btn-primary:hover { filter: brightness(1.12); box-shadow: 0 10px 26px rgba(99, 102, 241, 0.5); }
        .btn-primary:active { transform: scale(.98); }

        .btn-danger {
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            transition: transform .15s ease, filter .2s ease;
        }
        .btn-danger:hover { filter: brightness(1.1); }
        .btn-danger:active { transform: scale(.97); }

        .fade-in { animation: fadeIn .5s ease both; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

</head>
<body class="text-slate-100">

<div class="max-w-3xl mx-auto py-8 sm:py-10 px-4">

    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight mb-5 sm:mb-6 bg-gradient-to-r from-violet-300 via-sky-300 to-emerald-300 bg-clip-text text-transparent">
        My Posts
    </h1>

    <div class="flex gap-3 mb-5 sm:mb-6">
        <a href="{{ route('dashboard') }}"
           class="btn-primary text-white px-4 sm:px-5 py-2 sm:py-2.5 rounded-xl font-semibold text-sm sm:text-base transition">
            ← Dashboard
        </a>
    </div>

    @if (session()->has('success'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 3000)" 
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         class="fixed bottom-5 right-5 z-[100] bg-emerald-500 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3">
         
        <span>✅</span>
        <p class="font-medium">{{ session('success') }}</p>
    </div>
@endif

    @forelse($posts as $post)

        <div class="group relative card rounded-2xl sm:rounded-3xl p-4 sm:p-6 mb-4 sm:mb-6 overflow-hidden fade-in">

            <div class="absolute top-0 left-0 w-1 h-full accent-bar opacity-70"></div>

            <div class="text-slate-300 text-sm sm:text-[16px] leading-relaxed font-medium whitespace-pre-wrap mb-3 sm:mb-4">
                {{ $post->content }}
            </div>

            <small class="block text-slate-500 text-[11px] sm:text-xs font-bold uppercase tracking-widest mb-3 sm:mb-4">
                {{ $post->created_at->format('d M Y H:i') }}
            </small>

            <form
                action="{{ route('posts.destroy', $post) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus post ini?')"
            >
                @csrf
                @method('DELETE')

                <button class="btn-danger text-white px-4 py-2 rounded-xl font-semibold text-sm">
                    Hapus
                </button>

            </form>

        </div>

    @empty

        <div class="card rounded-2xl sm:rounded-3xl p-8 sm:p-10 text-center fade-in">
            <div class="text-4xl mb-3">✨</div>
            <h3 class="text-slate-300 font-semibold text-sm sm:text-base">Kamu belum memiliki postingan.</h3>
        </div>

    @endforelse

</div>

</body>
</html>