<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0b0f1a">
    <title>ReadSpace</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

        .avatar-glow {
            background: linear-gradient(135deg, #8b5cf6, #22d3ee);
            box-shadow: 0 8px 24px rgba(139, 92, 246, 0.4);
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

        .like-btn { transition: transform .15s ease, background .25s ease, color .2s ease; }
        .like-btn:active { transform: scale(.9); }

        .pill-track { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06); }

        textarea::placeholder { color: rgba(203,213,225,0.4); }

        .scrollbar-none::-webkit-scrollbar { display:none; }

        @media (max-width:640px) {
            .max-w-4xl { padding-left:1rem; padding-right:1rem }
        }

        .fade-in { animation: fadeIn .5s ease both; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

</head>

<body class="text-slate-100">

<!-- Header -->
<header x-data="{open:false}" class="sticky top-0 z-50">
    <div class="glass border-b border-white/5 shadow-lg shadow-black/20">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl avatar-glow text-white flex items-center justify-center font-extrabold text-lg">
                        LS
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-lg font-extrabold tracking-tight bg-gradient-to-r from-violet-300 via-sky-300 to-emerald-300 bg-clip-text text-transparent">
                            ReadSpace
                        </h1>
                        <p class="text-xs text-slate-400">Connect • Share • Inspire</p>
                    </div>
                </a>
            </div>

            <nav class="flex items-center gap-3">
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('posts.mine') }}" class="px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition">My Posts</a>
                    
                </div>

                <div class="hidden sm:flex items-center gap-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn-danger text-white px-4 py-2 rounded-full font-semibold text-sm">Logout</button>
                    </form>
                </div>

                <button @click="open = !open" class="sm:hidden p-2 rounded-md bg-white/5 border border-white/10">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </nav>
        </div>

        <div x-show="open"
             x-transition
             class="absolute w-full sm:hidden border-b border-white/10 glass shadow-lg z-40">
            <div class="px-4 py-3 flex flex-col gap-1">
                <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition">Home</a>
                <a href="{{ route('posts.mine') }}" class="px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition">My Posts</a>
                <a href="#" class="px-3 py-2 rounded-lg text-slate-300 hover:text-white hover:bg-white/5 transition">Explore</a>
                <form action="{{ route('logout') }}" method="POST" class="pt-2 border-t border-white/10 mt-1">
                    @csrf
                    <button class="w-full btn-danger text-white px-4 py-2 rounded-lg font-semibold">Logout</button>
                </form>
            </div>
        </div>
    </div>
</header>

<div class="max-w-4xl mx-auto py-8 px-4">

    <!-- Welcome -->
    <div class="mb-6 fade-in">
        <h2 class="text-3xl font-extrabold tracking-tight">
            Halo,
            <span class="bg-gradient-to-r from-violet-300 via-sky-300 to-emerald-300 bg-clip-text text-transparent">{{ Auth::user()->name }}</span>
            
        </h2>
        <p class="text-slate-400 mt-1">Bagikan sesuatu kepada semua orang.</p>
    </div>

    <!-- Success -->
    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-400/30 text-emerald-300 rounded-2xl p-4 mb-6 fade-in">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error -->
    @if($errors->any())
        <div class="bg-rose-500/10 border border-rose-400/30 text-rose-300 rounded-2xl p-4 mb-6 fade-in">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create Status -->
    <div x-data="{ open:false }" class="mb-8">

        <button
            @click="open=!open"
            class="w-full btn-primary text-white py-3 rounded-2xl font-bold transition">
             Post
        </button>

        <div
            x-show="open"
            x-transition
            class="mt-4 card rounded-2xl p-6">

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <textarea
                    name="content"
                    maxlength="7000"
                    rows="6"
                    class="w-full bg-white/5 border border-white/10 text-slate-100 rounded-xl p-4 min-h-[160px] sm:min-h-[220px] text-base sm:text-lg leading-relaxed resize-y focus:ring-2 focus:ring-violet-400 focus:border-violet-400 focus:outline-none placeholder:text-slate-500"
                    placeholder="Apa yang sedang kamu pikirkan?">{{ old('content') }}</textarea>

                <div class="flex justify-between items-center mt-4">
                    <small class="text-slate-500">Maksimal 1000 karakter</small>

                    <button
                        type="submit"
                        onclick="this.disabled=true;this.innerText='Posting...';this.form.submit();"
                        class="btn-primary text-white px-6 py-2 rounded-xl font-semibold">
                        Post Status
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Feed Title -->
    <h2 class="text-xl font-bold mb-5 flex items-center gap-2">
        <span>🌎</span>
        <span class="bg-gradient-to-r from-slate-100 to-slate-400 bg-clip-text text-transparent">Feed Global</span>
    </h2>

    @forelse($posts as $post)
        <article class="group relative card rounded-2xl sm:rounded-3xl p-4 sm:p-6 mb-4 sm:mb-6 overflow-hidden fade-in">

            <div class="absolute top-0 left-0 w-1 h-full accent-bar opacity-70"></div>

            <div class="flex items-start gap-3 sm:gap-5">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl avatar-glow flex items-center justify-center font-bold text-white text-base sm:text-xl">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </div>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-2 sm:mb-3 gap-2">
                        <div class="min-w-0">
                            <h3 class="font-extrabold text-slate-100 text-sm sm:text-lg tracking-tight hover:text-violet-300 transition-colors cursor-pointer truncate">
                                {{ $post->user->name }}
                            </h3>
                            <p class="text-[9px] sm:text-[11px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <button class="flex-shrink-0 text-slate-500 hover:text-slate-200 transition">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/><circle cx="5" cy="12" r="2"/></svg>
                        </button>
                    </div>

                    <div class="mb-3 sm:mb-5" x-data="{ expanded:false }">
                        <p
                            x-bind:class="expanded ? '' : 'line-clamp-6'"
                            class="text-slate-300 text-sm sm:text-[16px] leading-relaxed font-medium break-words whitespace-pre-wrap">
                            {{ $post->content }}
                        </p>

                        @if(strlen($post->content) > 280 || substr_count($post->content, "\n") >= 5)
                            <button
                                type="button"
                                @click="expanded = !expanded"
                                class="mt-2 text-violet-300 hover:text-violet-200 text-xs sm:text-sm font-bold hover:underline"
                                x-text="expanded ? 'Sembunyikan' : 'Baca selengkapnya'">
                            </button>
                        @endif
                    </div>

                   <div class="flex items-center gap-1 pill-track p-1 rounded-xl sm:rounded-2xl w-fit">
    <form x-data="{ 
        liked: {{ $post->likes->contains('user_id', Auth::id()) ? 'true' : 'false' }},
        count: {{ $post->likes_count + $post->fake_likes }}
    }" 
    @submit.prevent="
        fetch('{{ route('posts.like', $post) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            liked = !liked;
            count = liked ? count + 1 : count - 1;
        })
    " 
    class="inline-block">
        @csrf
        <button type="submit"
            :class="liked ? 'bg-rose-500/15 text-rose-500' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200'"
            class="flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg sm:rounded-xl transition-all duration-200">
            
            <span class="text-sm sm:text-lg" x-text="liked ? '❤️' : '🤍'"></span>
            <span class="font-bold text-xs sm:text-sm" x-text="count"></span>
        </button>
    </form>

    <button class="flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg sm:rounded-xl text-slate-400 hover:bg-white/5 hover:text-sky-300 transition-all duration-300">
        <span class="text-sm sm:text-base">💬</span>
        <span class="text-xs sm:text-sm font-bold">Reply</span>
    </button>
</div>
                </div>
            </div>
        </article>

    @empty
        <div class="text-center py-20 text-slate-500 fade-in">
            <div class="text-5xl mb-4">✨</div>
            <p>Belum ada postingan, jadilah yang pertama!</p>
        </div>
    @endforelse

</div>

</body>
</html>