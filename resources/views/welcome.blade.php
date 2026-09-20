<x-layout>
    {{-- Sebaiknya pindahkan 3 baris font ini ke <head> layout utama --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ========== DESIGN TOKENS ========== */
        :root {
            --bg: #F8FAFC;
            --surface: #FFFFFF;
            --surface-2: #F1F5F9;
            --line: #E2E8F0;
            --fg: #0F172A;
            --fg-soft: #475569;
            --muted: #64748B;
            --accent: #2563EB;
            --accent-soft: #EFF6FF;
            --cta-bg: #2563EB;
            --cta-fg: #FFFFFF;
            --cta-muted: #DBEAFE;
        }
        .dark {
            /* Tema Navy Dark seperti desain UI referensi */
            --bg: #040B16;
            --surface: #0B172A;
            --surface-2: #112240;
            --line: #1E293B;
            --fg: #F1F5F9;
            --fg-soft: #CBD5E1;
            --muted: #8892B0;
            --accent: #3B82F6;
            --accent-soft: rgba(59, 130, 246, 0.15);
            --cta-bg: linear-gradient(135deg, #0B172A, #040B16);
            --cta-fg: #F1F5F9;
            --cta-muted: #8892B0;
        }

        html { scroll-behavior: smooth; }
        .font-display { font-family: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif; }
        .font-body    { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }

        /* ========== UTILITAS WARNA ========== */
        .bg-page      { background-color: var(--bg); }
        .bg-surface   { background-color: var(--surface); }
        .bg-surface-2 { background-color: var(--surface-2); }
        .bg-accent-soft { background-color: var(--accent-soft); }
        .text-fg      { color: var(--fg); }
        .text-soft    { color: var(--fg-soft); }
        .text-muted   { color: var(--muted); }
        .text-accent  { color: var(--accent); }
        .border-line  { border-color: var(--line); }

        /* ========== KOMPONEN ========== */
        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover { 
            border-color: var(--accent); 
            box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.1);
        }

        .icon-circle {
            display: grid; place-items: center;
            width: 3rem; height: 3rem; flex-shrink: 0;
            border-radius: 9999px;
            background: var(--accent-soft); color: var(--accent);
        }
        
        .icon-btn {
            display: grid; place-items: center;
            width: 2.5rem; height: 2.5rem;
            border-radius: 9999px;
            background: var(--surface); border: 1px solid var(--line);
            color: var(--muted);
            transition: color .2s ease, border-color .2s ease;
        }
        .icon-btn:hover { color: var(--accent); border-color: var(--accent); }

        /* Navigasi Desktop & Hover Effects */
        .nav-link { 
            position: relative; 
            color: var(--muted); 
            padding: 0.5rem 0;
            transition: color .2s ease; 
        }
        .nav-link:hover { color: var(--fg); }
        .nav-link.is-active { 
            color: var(--accent); 
            font-weight: 600; 
        }
        .nav-link.is-active::after {
            content: ''; 
            position: absolute; 
            left: 0; right: 0; bottom: -2px;
            height: 2px; 
            border-radius: 9999px; 
            background: var(--accent);
            animation: slideUp 0.2s ease forwards;
        }

        /* Tombol */
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
            padding: .75rem 1.5rem; border-radius: .75rem;
            font-size: .875rem; font-weight: 600;
            transition: all .2s ease;
        }
        .btn-primary { 
            background: var(--accent); color: #fff; 
            box-shadow: 0 4px 14px -4px var(--accent); 
        }
        .btn-primary:hover { transform: translateY(-1px); filter: brightness(1.1); }
        .btn-outline { border: 1px solid var(--line); color: var(--fg); background: transparent; }
        .btn-outline:hover { background: var(--surface-2); border-color: var(--muted); }

        .chip {
            padding: .25rem .75rem; border-radius: 9999px;
            font-size: .6875rem; font-weight: 600; letter-spacing: 0.025em;
            color: var(--fg-soft); background: var(--surface-2); border: 1px solid var(--line);
        }

        /* Ornamen Background */
        .bg-grid {
            background-image: radial-gradient(rgba(59, 130, 246, .2) 1px, transparent 1px);
            background-size: 24px 24px;
            -webkit-mask-image: linear-gradient(to bottom left, #000, transparent 60%);
            mask-image: linear-gradient(to bottom left, #000, transparent 60%);
        }

        .dark .icon-sun  { display: block; }
        .dark .icon-moon { display: none; }
        .icon-sun { display: none; }

        @keyframes slideUp {
            from { transform: translateY(5px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            * { animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
    </style>

    @php
        $name      = $profile?->name ?? 'Sapar Hidayat. S';
        $nameParts = explode(' ', $name, 2);
        $firstName = $nameParts[0];
        $lastName  = $nameParts[1] ?? '';
        $initials  = \Illuminate\Support\Str::upper(mb_substr($firstName, 0, 1) . mb_substr($lastName, 0, 1));
        $title     = $profile?->title ?? 'Software Engineer | AI/ML Engineer | Full-Stack Developer';
        $about     = $profile?->about ?? 'I build modern web applications and explore the world of Artificial Intelligence and Machine Learning to create solutions that make an impact.';
        $email     = $profile?->email ?? 'saparhidayat@email.com';

        // Navigasi
        $navLinks = [
            'home'         => 'Home', 
            'about'        => 'About', 
            'skills'       => 'Skills',
            'projects'     => 'Projects', 
            'certificates' => 'Certificates', 
            'services'     => 'Service Fee', 
            'contact'      => 'Contact',
        ];
    @endphp

    <div class="font-body bg-page text-fg min-h-screen overflow-x-hidden transition-colors duration-300 selection:bg-blue-500/30">

        {{-- ================= NAVBAR ================= --}}
        <header class="fixed inset-x-0 top-0 z-50 border-b border-line backdrop-blur-md" style="background: color-mix(in srgb, var(--bg) 80%, transparent);">
            <nav class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 lg:px-12" aria-label="Main navigation">
                
                <!-- Logo -->
                <a href="#home" class="font-display text-2xl font-bold tracking-tight">My<span class="text-accent">profile</span></a>

                <!-- Desktop Menu -->
                <div class="hidden items-center gap-8 text-sm font-medium md:flex">
                    @foreach($navLinks as $id => $label)
                        <a href="#{{ $id }}" data-nav="{{ $id }}" class="nav-link {{ $loop->first ? 'is-active' : '' }}">{{ $label }}</a>
                    @endforeach
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3">
                    <button type="button" onclick="toggleTheme()" aria-label="Toggle theme" class="icon-btn">
                        <svg class="icon-sun h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <svg class="icon-moon h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    </button>

                    <!-- Dibungkus md:hidden agar tidak bentrok dengan display:grid di .icon-btn -->
                    <div class="md:hidden">
                        <button type="button" id="menu-btn" aria-label="Open menu" aria-expanded="false" class="icon-btn">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>
                </div>
            </nav>

            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="hidden border-t border-line shadow-lg md:hidden" style="background: var(--surface);">
                <div class="mx-auto flex max-w-7xl flex-col px-6 py-4 text-sm font-medium">
                    @foreach($navLinks as $id => $label)
                        <a href="#{{ $id }}" data-nav-mobile="{{ $id }}" class="mobile-link block py-3 text-muted border-b border-line last:border-0 hover:text-accent transition-colors">{{ $label }}</a>
                    @endforeach
                </div>
            </div>
        </header>

        <!-- Padding ditingkatkan pada max-w-7xl agar ada ruang bernafas yang lega -->
        <main class="mx-auto max-w-6xl space-y-24 px-6 pb-20 pt-32 lg:space-y-32 lg:px-12 xl:px-16">

            {{-- ================= HERO ================= --}}
            <!-- Min-height disesuaikan menjadi 85vh dan gap diatur agar konten tidak terlalu merapat -->
            <section id="home" class="relative flex min-h-[70vh] scroll-mt-32 flex-col-reverse items-center justify-center gap-14 text-center lg:flex-row lg:justify-between lg:gap-20 lg:text-left pt-6 lg:pt-0">
                <div class="bg-grid absolute inset-0 -z-10 opacity-40" aria-hidden="true"></div>

                <div class="flex w-full flex-col items-center lg:w-1/2 lg:items-start z-10">
                    <p class="mb-6 inline-flex items-center gap-2 rounded-full border border-accent/20 bg-accent-soft px-3.5 py-1.5 text-xs font-semibold text-accent shadow-sm">
                        <span aria-hidden="true">👋</span> Hello, I'm
                    </p>

                    <h1 class="font-display mb-4 text-5xl font-bold leading-[1.1] tracking-tight md:text-6xl lg:text-6.5xl">
                        {{ $firstName }} <span class="text-accent">{{ $lastName }}</span>
                    </h1>

                    <p class="mb-8 text-lg font-medium text-soft md:text-xl">{{ $title }}</p>

                    <div class="flex flex-wrap justify-center gap-4 lg:justify-start">
                        <a href="#projects" class="btn btn-primary">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            View my projects
                        </a>
                        <a href="#contact" class="btn btn-outline">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Contact me
                        </a>
                    </div>
                    <!-- Link Sosial Media di Hero Section telah dihapus -->
                </div>

                {{-- Foto profil --}}
                <div class="relative flex w-full justify-center lg:w-1/2 lg:justify-end">
                    
                    <!-- Wrapper ini memastikan teks melayang selalu menempel pas di dekat foto -->
                    <div class="relative">
                        <div class="absolute left-1/2 top-1/2 -z-10 h-80 w-80 -translate-x-1/2 -translate-y-1/2 rounded-full bg-blue-600/20 blur-3xl lg:h-[400px] lg:w-[400px]" aria-hidden="true"></div>

                        <!-- Ukuran profil tetap tidak diubah (h-64 w-64 lg:h-90 lg:w-90) -->
                        <div class="h-64 w-64 rounded-full bg-gradient-to-tr from-blue-600 to-cyan-400 p-1 lg:h-90 lg:w-90 shadow-2xl">
                            @if(!empty($profile?->avatar))
                                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="{{ $name }}" class="h-full w-full rounded-full object-cover" style="background: var(--surface);">
                            @else
                                <div class="font-display flex h-full w-full items-center justify-center rounded-full text-6xl font-bold text-muted" style="background: var(--surface);">{{ $initials }}</div>
                            @endif
                        </div>
                    </div>

                </div>
            </section>

            {{-- ================= ABOUT ================= --}}
            <section id="about" class="scroll-mt-28">
                <div class="card p-8 md:p-10 flex flex-col md:flex-row gap-8 items-center border-none shadow-sm" style="background: var(--surface-2)">
                    <div class="w-full md:w-2/3">
                        <p class="text-sm font-bold tracking-wider text-accent uppercase mb-2">About Me</p>
                        <h2 class="font-display text-3xl font-bold mb-4">Let's Know About <span class="text-accent">Me</span></h2>
                        <p class="text-muted leading-relaxed">{{ $about }}</p>
                    </div>
                    
                    <!-- Social Links (Terhubung dengan Database) -->
                    <div class="w-full md:w-1/3 flex flex-col justify-center border-t md:border-t-0 md:border-l border-line pt-6 md:pt-0 md:pl-8">
                        <p class="text-xs font-semibold text-muted uppercase tracking-wider mb-4">Connect with me</p>
                        
                        <div class="flex flex-col gap-3">
                            @if($profile?->github_url)
                                <a href="{{ $profile->github_url }}" target="_blank" rel="noopener" class="flex items-center gap-3 text-sm font-medium text-fg hover:text-accent transition-colors group">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-surface border border-line group-hover:border-accent transition-colors">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                    </span>
                                    GitHub
                                </a>
                            @endif

                            @if($profile?->linkedin_url)
                                <a href="{{ $profile->linkedin_url }}" target="_blank" rel="noopener" class="flex items-center gap-3 text-sm font-medium text-fg hover:text-accent transition-colors group">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-surface border border-line group-hover:border-accent transition-colors">
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                    </span>
                                    LinkedIn
                                </a>
                            @endif

                            @if($profile?->instagram_url)
                                <a href="{{ $profile->instagram_url }}" target="_blank" rel="noopener" class="flex items-center gap-3 text-sm font-medium text-fg hover:text-accent transition-colors group">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-surface border border-line group-hover:border-accent transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                                    </span>
                                    Instagram
                                </a>
                            @endif
                            
                            <!-- Fallback jika belum ada link yang diisi -->
                            @if(empty($profile?->github_url) && empty($profile?->linkedin_url) && empty($profile?->instagram_url))
                                <p class="text-sm text-muted">Belum ada tautan sosial media yang ditambahkan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            {{-- ================= SKILLS ================= --}}
            <section id="skills" class="scroll-mt-28">
                <div class="mb-10 text-center md:text-left">
                    <p class="text-sm font-bold tracking-wider text-accent uppercase mb-2">My Skills</p>
                    <h2 class="font-display text-3xl font-bold">Technologies I <span class="text-accent">Work With</span></h2>
                </div>

                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
                    @forelse($skills as $skill)
                        <div class="card card-hover group flex cursor-default flex-col items-center justify-center gap-4 p-6 text-center">
                            
                            <!-- Pengecekan Gambar -->
                            @if(!empty($skill->image))
                                <!-- Jika ada logo -->
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl transition-transform duration-300 group-hover:-translate-y-1 group-hover:scale-110">
                                    <img src="{{ asset('storage/' . $skill->image) }}" alt="{{ $skill->name }}" class="w-11 h-11 object-contain drop-shadow-sm">
                                </div>
                            @else
                                <!-- Fallback Inisial Jika Belum Ada Logo -->
                                <div class="font-display flex h-14 w-14 items-center justify-center rounded-xl bg-surface-2 text-2xl font-bold text-soft transition-all duration-300 group-hover:bg-accent group-hover:text-white group-hover:shadow-lg group-hover:-translate-y-1">
                                    {{ \Illuminate\Support\Str::upper(mb_substr($skill->name, 0, 1)) }}
                                </div>
                            @endif

                            <span class="text-sm font-semibold text-fg">{{ $skill->name }}</span>
                        </div>
                    @empty
                        <p class="col-span-full text-muted">No skills added yet.</p>
                    @endforelse
                </div>
            </section>

           {{-- ================= PROJECTS ================= --}}
            <section id="projects" class="scroll-mt-28">
                <div class="mb-8 text-center md:text-left">
                    <p class="mb-2 text-sm font-bold uppercase tracking-wider text-accent">
                        Featured Projects
                    </p>
                    <h2 class="font-display text-3xl font-bold">
                        My Recent <span class="text-accent">Projects</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($projects as $project)

                        <article class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-line bg-surface transition-all duration-300 ease-out hover:-translate-y-1 hover:border-accent/40 hover:shadow-xl">

                            {{-- Image --}}
                            <div class="relative aspect-video w-full overflow-hidden bg-surface-2 border-b border-line">
                                @if($project->thumbnail)
                                    <img
                                        src="{{ asset('storage/' . $project->thumbnail) }}"
                                        alt="{{ $project->name }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover object-top transition-transform duration-500 ease-out group-hover:scale-105"
                                    >
                                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/35 via-transparent to-transparent opacity-60 transition-opacity duration-300 group-hover:opacity-80"></div>
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-sm font-medium text-muted">
                                        No Image
                                    </div>
                                @endif

                                {{-- Status --}}
                                @if($project->status)
                                    <div class="absolute left-3 top-2">
                                        <span class="rounded-full border border-white/10 bg-black/60 px-2.5 py-1 text-[11px] font-semibold text-white backdrop-blur-sm">
                                            {{ $project->status }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Content (Diubah ke flex-grow agar lebih rapi) --}}
                            <div class="flex flex-col flex-grow p-5">

                                {{-- Title --}}
                                <h3 class="mb-1.5 line-clamp-1 font-display text-lg font-bold text-fg" title="{{ $project->name }}">
                                    {{ $project->name }}
                               </h3>

                                {{-- Description --}}
                                <p class="mb-4 line-clamp-2 text-sm leading-relaxed text-muted">
                                    {{ $project->description ?? 'No description yet.' }}
                                </p>

                                {{-- Skills --}}
                                @if($project->skills->isNotEmpty())
                                    <div class="mb-4 flex flex-wrap gap-1.5">
                                        @foreach($project->skills->take(4) as $skill)
                                            <span class="rounded-md border border-line bg-surface-2 px-2 py-1 text-[11px] font-medium text-muted transition-colors duration-200 group-hover:border-accent/20 group-hover:text-fg">
                                                {{ $skill->name }}
                                            </span>
                                        @endforeach

                                        @if($project->skills->count() > 4)
                                            <span class="rounded-md border border-line bg-surface-2 px-2 py-1 text-[11px] font-medium text-muted">
                                                +{{ $project->skills->count() - 4 }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                {{-- Footer (mt-auto menjaga bagian ini tetap di dasar card) --}}
                                <div class="mt-auto flex items-center justify-between border-t border-line pt-4">
                                    
                                    {{-- Demo --}}
                                    @if($project->demo_url)
                                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="group/link inline-flex items-center gap-1.5 text-sm font-semibold text-accent transition-colors duration-200 hover:text-blue-600">
                                            View Project
                                            <svg class="h-4 w-4 transition-transform duration-200 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </a>
                                    @else
                                        <span class="text-sm font-medium text-muted">Project</span>
                                    @endif

                                    {{-- GitHub --}}
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" aria-label="View source code" title="View Source Code" class="flex h-9 w-9 items-center justify-center rounded-full border border-line text-muted transition-all duration-200 hover:border-accent/40 hover:bg-surface-2 hover:text-fg hover:scale-105">
                                            <svg class="h-4.5 w-4.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386C24 5.373 18.627 0 12 0z"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="col-span-full py-10 text-center text-muted">No projects published yet.</p>
                    @endforelse
                </div>
            </section>

           {{-- ================= CERTIFICATES ================= --}}
            <section id="certificates" class="scroll-mt-28">
                <div class="mb-10 text-center md:text-left">
                    <p class="text-sm font-bold tracking-wider text-accent uppercase mb-2">Certificates</p>
                    <h2 class="font-display text-3xl font-bold">My <span class="text-accent">Certificates</span></h2>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($certificates as $certificate)
                        <article class="card card-hover group flex flex-col h-full overflow-hidden bg-surface relative">

                            {{-- Gambar sertifikat dengan rasio aspect-video (16:9) agar tidak terlalu tinggi --}}
                            <div class="relative aspect-video w-full overflow-hidden bg-surface-2 border-b border-line">
                                @if($certificate->image)
                                    <img
                                        src="{{ Storage::url($certificate->image) }}"
                                        alt="{{ $certificate->name }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover object-center transition-transform duration-500 group-hover:scale-105"
                                    >
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-transparent pointer-events-none"></div>
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <svg class="h-12 w-12 text-muted/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Bagian Utama Konten - flex-grow agar mengisi ruang yang tersisa --}}
                            <div class="flex flex-col flex-grow p-5">
                                <h3 class="font-display text-base font-bold leading-snug text-fg line-clamp-2 mb-1" title="{{ $certificate->name }}">
                                    {{ $certificate->name }}
                                </h3>

                                {{-- mt-auto dihapus dari sini agar tidak bentrok dengan footer --}}
                                <p class="text-sm font-medium text-muted mb-4">
                                    <span class="text-fg-soft">{{ $certificate->issuer }}</span>
                                    @if($certificate->date)
                                        <span class="mx-1">&bull;</span> {{ \Carbon\Carbon::parse($certificate->date)->format('M Y') }}
                                    @endif
                                </p>

                                {{-- Footer Kredensial - Hanya diletakkan mt-auto di sini --}}
                                <div class="mt-auto pt-4 border-t border-line flex items-center justify-between">
                                    @php
                                        $credentialLink = $certificate->file_url ?: ($certificate->image ? Storage::url($certificate->image) : null);
                                    @endphp
                                    @if($credentialLink)
                                        <a href="{{ $credentialLink }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-sm font-semibold text-accent hover:text-blue-600 transition-colors group/link">
                                            View Credential
                                            <svg class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </a>
                                    @else
                                        <span class="text-xs text-muted">No credential link</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="col-span-full text-center text-muted py-10">No certificates yet.</p>
                    @endforelse
                </div>
            </section>

            {{-- ================= SERVICES ================= --}}
            <section id="services" class="scroll-mt-28 mb-24">
                <div class="mb-8 text-center md:text-left">
                    <p class="mb-1.5 text-sm font-bold uppercase tracking-wider text-accent">
                        What I Do
                    </p>
                    <h2 class="font-display text-3xl font-bold">
                        My <span class="text-accent">Services</span> & Pricing
                    </h2>
                </div>

                @php
                    $visibleServices = $services->where('is_visible', true)->sortBy('display_order');
                @endphp

                {{-- Menjadikan card service berjajar ke samping (2 atau 3 kolom) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($visibleServices as $service)
                        <div class="card p-5 border border-line bg-surface-2 rounded-2xl hover:border-accent/40 transition-colors flex flex-col">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-surface text-accent border border-line">
                                    @if($service->icon)
                                        <x-dynamic-component :component="$service->icon" class="h-4.5 w-4.5" />
                                    @else
                                        <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    @endif
                                </span>
                                <h4 class="font-bold text-base text-fg leading-snug min-w-0">
                                    {{ $service->name }}
                                </h4>
                            </div>

                            @if($service->fee)
                                <div class="mb-3">
                                    <span class="inline-flex items-center text-accent font-semibold text-xs bg-surface px-3 py-1 rounded-full border border-line">
                                        {{ $service->fee }}
                                    </span>
                                </div>
                            @endif

                            @if($service->description)
                                <p class="text-muted text-sm leading-relaxed mt-auto">
                                    {{ $service->description }}
                                </p>
                            @endif
                        </div>
                    @empty
                        <div class="col-span-full card p-6 border border-dashed border-line rounded-2xl text-center">
                            <p class="text-muted text-sm">Belum ada layanan yang ditambahkan.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- ================= CONTACT ================= --}}
            <section id="contact" class="scroll-mt-28 mb-20">
                <div class="mb-8 text-center md:text-left">
                    <p class="mb-1.5 text-sm font-bold uppercase tracking-wider text-accent">
                        Let's Connect
                    </p>
                    <h2 class="font-display text-3xl font-bold">
                        Get In <span class="text-accent">Touch</span>
                    </h2>
                </div>

                {{-- Membagi layout: Info di kiri, Form compact di kanan --}}
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 items-start">
                    
                    <div class="lg:col-span-2 flex flex-col justify-center pt-2">
                        <h3 class="text-xl font-bold text-fg mb-3">Punya Ide Proyek?</h3>
                        <p class="text-muted text-sm leading-relaxed mb-6">
                            Saya selalu terbuka untuk mendiskusikan proyek baru, ide kreatif, atau peluang kerja sama. Jangan ragu untuk mengirimkan pesan, saya akan membalasnya secepat mungkin!
                        </p>
                    </div>

                    <div class="lg:col-span-3 card p-6 border border-line bg-surface rounded-2xl shadow-sm">
                        @if(session('success'))
                            <div class="mb-4 flex items-start gap-2 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-600">
                                <svg class="h-4.5 w-4.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        <form action="/contact/send" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-xs font-medium text-fg mb-1.5">Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Your Name"
                                           class="w-full bg-surface-2 border rounded-lg px-3 py-2 text-sm text-fg focus:outline-none focus:ring-1 transition-all
                                                  @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-line focus:border-accent focus:ring-accent @enderror">
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-xs font-medium text-fg mb-1.5">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="YourEmail@example.com"
                                           class="w-full bg-surface-2 border rounded-lg px-3 py-2 text-sm text-fg focus:outline-none focus:ring-1 transition-all
                                                  @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-line focus:border-accent focus:ring-accent @enderror">
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="message" class="block text-xs font-medium text-fg mb-1.5">Message</label>
                                <textarea id="message" name="message" rows="3" required placeholder="How can I help you?"
                                          class="w-full bg-surface-2 border rounded-lg px-3 py-2 text-sm text-fg focus:outline-none focus:ring-1 transition-all resize-none
                                                 @error('message') border-red-500 focus:border-red-500 focus:ring-red-500 @else border-line focus:border-accent focus:ring-accent @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="mt-1 w-full md:w-auto md:self-end bg-accent hover:bg-blue-600 text-white text-sm font-bold py-2.5 px-6 rounded-lg transition-transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                                Send Message
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        {{-- ================= FOOTER ================= --}}
            <footer class="border-t border-line mt-12 bg-surface">
                <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-6 py-10 md:flex-row">
                    
                    {{-- Bagian Kiri: Branding & Title --}}
                    <div class="text-center md:text-left">
                        <p class="font-display text-2xl font-bold text-fg tracking-tight">
                            {{ $firstName }}<span class="text-accent"> Hidayat. S</span>
                        </p>
                        <p class="mt-1.5 text-sm text-muted max-w-sm">
                            {{ $title }}
                        </p>
                    </div>

                    {{-- Bagian Kanan: Social Links & Copyright --}}
                    <div class="flex flex-col items-center md:items-end">
                        <div class="flex gap-5 mb-4">
                            {{-- Icon GitHub --}}
                            <a href="#" target="_blank" class="text-muted hover:text-accent transition-colors" aria-label="GitHub">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            {{-- Icon LinkedIn --}}
                            <a href="#" target="_blank" class="text-muted hover:text-accent transition-colors" aria-label="LinkedIn">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                        <p class="text-sm text-muted">
                            &copy; {{ date('Y') }} {{ $name }}. All rights reserved.
                        </p>
                    </div>

                </div>
            </footer>
    </div>

    <script>
        // Tema: ikuti pilihan tersimpan, atau preferensi sistem
        (function () {
            var saved = localStorage.getItem('theme');
            var dark = saved ? saved === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', dark);
        })();

        function toggleTheme() {
            var isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        // Menu mobile
        (function () {
            var btn = document.getElementById('menu-btn');
            var menu = document.getElementById('mobile-menu');
            if (!btn || !menu) return;
            
            btn.addEventListener('click', function () {
                var isHidden = menu.classList.contains('hidden');
                if(isHidden) {
                    menu.classList.remove('hidden');
                    btn.setAttribute('aria-expanded', 'true');
                } else {
                    menu.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }
            });

            menu.querySelectorAll('.mobile-link').forEach(function (a) {
                a.addEventListener('click', function () {
                    menu.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                });
            });
        })();

        // Scroll Spy - Tandai menu aktif sesuai section yang sedang dilihat
        (function () {
            var links = document.querySelectorAll('[data-nav]');
            var mobileLinks = document.querySelectorAll('[data-nav-mobile]');
            var sections = Array.from(links).map(function (l) {
                return document.getElementById(l.dataset.nav);
            }).filter(Boolean);

            // Menggunakan rootMargin agar transisi nav link lebih mulus saat di-scroll
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    
                    var currentId = entry.target.id;
                    
                    // Update Desktop Nav
                    links.forEach(function (l) {
                        if(l.dataset.nav === currentId) {
                            l.classList.add('is-active');
                        } else {
                            l.classList.remove('is-active');
                        }
                    });
                    
                    // Update Mobile Nav
                    mobileLinks.forEach(function (l) {
                        if(l.dataset.navMobile === currentId) {
                            l.classList.add('text-accent', 'font-bold');
                            l.classList.remove('text-muted');
                        } else {
                            l.classList.remove('text-accent', 'font-bold');
                            l.classList.add('text-muted');
                        }
                    });
                });
            }, { rootMargin: '-20% 0px -75% 0px' });

            sections.forEach(function (s) { observer.observe(s); });
        })();
    </script>
</x-layout>