<x-layout>
    {{-- Memastikan Google Fonts termuat --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @php
        // Array Navigasi Utama
        $navLinks = [
            'home'         => 'Home', 
            'about'        => 'About', 
            'skills'       => 'Skills',
            'projects'     => 'Projects', 
            'certificates' => 'Certificates', 
            'services'     => 'Services', 
            'contact'      => 'Contact',
        ];

        // Variabel Data Diri untuk Footer (Fallback aman)
        $firstName = 'Sapar';
        $name = 'Sapar Hidayat. S';
        $title = 'Informatics Engineering Student | Web Developer';
    @endphp

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
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }
        .card-hover:hover { 
            border-color: var(--accent); 
            box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.1);
            transform: translateY(-4px); 
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

        /* ===== Tambahan Khusus Halaman Galeri ===== */
        .gallery-thumb {
            aspect-ratio: 1 / 1;
            width: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }
        .card-hover:hover .gallery-thumb {
            transform: scale(1.08);
        }
        .gallery-caption {
            padding: 1rem;
            border-top: 1px solid var(--line);
        }
    </style>

    <div class="font-body bg-page text-fg min-h-screen flex flex-col pt-20 transition-colors duration-300 selection:bg-blue-500/30">

        {{-- ================= NAVBAR ================= --}}
        <header class="fixed inset-x-0 top-0 z-50 border-b border-line backdrop-blur-md transition-all duration-300" style="background: color-mix(in srgb, var(--bg) 85%, transparent);">
            <nav class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6 lg:px-12" aria-label="Main navigation">
                
                <!-- Logo -->
                <a href="/#home" class="font-display text-2xl font-bold tracking-tight text-fg hover:text-accent transition-colors shrink-0">
                    My<span class="text-accent">profile</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-7 text-sm font-medium">
                    @foreach($navLinks as $id => $label)
                        <a href="/#{{ $id }}" data-nav="{{ $id }}" class="nav-link">
                            {{ $label }}
                        </a>
                    @endforeach
                    
                    <!-- Link Ekstra: Art Gallery -->
                    <div class="h-5 w-px bg-line mx-1"></div>
                    <a href="/gallery" class="nav-link is-active">
                        Gallery
                    </a>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3">
                    <button type="button" onclick="toggleTheme()" aria-label="Toggle theme" class="icon-btn">
                        <svg class="icon-sun h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <svg class="icon-moon h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    </button>

                    <!-- Hamburger Button (Mobile) -->
                    <div class="md:hidden">
                        <button type="button" id="menu-btn" aria-label="Open menu" aria-expanded="false" class="icon-btn">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>
                </div>
            </nav>

            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="hidden border-t border-line shadow-lg md:hidden" style="background: var(--surface);">
                <div class="mx-auto flex max-w-7xl flex-col px-6 py-2 text-sm font-medium">
                    @foreach($navLinks as $id => $label)
                        <a href="/#{{ $id }}" data-nav-mobile="{{ $id }}" class="mobile-link block py-3.5 text-muted border-b border-line hover:text-accent transition-colors">
                            {{ $label }}
                        </a>
                    @endforeach
                    <!-- Link Ekstra Mobile (Gallery Aktif) -->
                    <a href="/gallery" class="flex items-center justify-between py-3.5 text-accent font-bold transition-colors border-b border-line">
                        Art Gallery
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </a>
                </div>
            </div>
        </header>

        {{-- ================= KONTEN UTAMA ================= --}}
        <main class="flex-grow mx-auto max-w-7xl px-5 lg:px-12 py-12 w-full">
            <div class="mb-12 text-center">
                <h1 class="font-display text-3xl sm:text-4xl font-bold mb-4">Koleksi <span class="text-accent">Lukisan</span></h1>
                <p class="text-muted max-w-xl mx-auto text-sm sm:text-base leading-relaxed px-2">
                    Ruang bagi saya untuk berekspresi di luar baris kode. Berikut adalah beberapa karya lukisan yang saya buat di waktu luang.
                </p>
            </div>

            {{-- Grid Galeri (4 Kolom Desktop, 2 Kolom Mobile) --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @forelse($galleries as $item)
                    <div class="card card-hover group flex flex-col overflow-hidden bg-surface-2">
                        <div class="overflow-hidden bg-muted/10 relative">
                            <img src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->title }}"
                                 loading="lazy"
                                 class="gallery-thumb">
                        </div>

                        <div class="gallery-caption bg-surface flex-grow flex flex-col justify-between">
                            <h3 class="font-display font-bold text-base text-fg truncate" title="{{ $item->title }}">
                                {{ $item->title }}
                            </h3>
                            @if($item->description)
                                <p class="text-soft font-body text-xs mt-1.5 leading-relaxed line-clamp-2" title="{{ $item->description }}">
                                    {{ $item->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center card px-4 border-dashed border-2">
                        <div class="icon-circle mx-auto mb-4 bg-surface-2 border border-line text-muted">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-fg text-sm font-semibold">Belum ada lukisan.</p>
                        <p class="text-muted text-xs mt-1">Koleksi galeri masih kosong saat ini.</p>
                    </div>
                @endforelse
            </div>
        </main>

        {{-- ================= FOOTER ================= --}}
        <footer class="border-t border-line mt-auto bg-surface">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-6 py-10 md:flex-row lg:px-12">
                
                {{-- Bagian Kiri: Branding & Title --}}
                <div class="text-center md:text-left">
                    <p class="font-display text-2xl font-bold text-fg tracking-tight">
                        {{ $firstName ?? 'Sapar' }}<span class="text-accent"> Hidayat. S</span>
                    </p>
                    <p class="mt-1.5 text-sm text-muted max-w-sm">
                        {{ $title ?? 'Informatics Engineering Student | Web Developer' }}
                    </p>
                </div>

                {{-- Bagian Kanan: Social Links & Copyright --}}
                <div class="flex flex-col items-center md:items-end">
                    <div class="flex gap-5 mb-4">
                        {{-- Icon GitHub --}}
                        <a href="https://github.com/Shdyt13" target="_blank" class="text-muted hover:text-accent transition-colors" aria-label="GitHub">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        {{-- Icon LinkedIn --}}
                        <a href="https://linkedin.com/in/shdyt13" target="_blank" class="text-muted hover:text-accent transition-colors" aria-label="LinkedIn">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <p class="text-sm text-muted">
                        &copy; {{ date('Y') }} {{ $name ?? 'Sapar Hidayat. S' }}. All rights reserved.
                    </p>
                </div>

            </div>
        </footer>

    </div> {{-- Penutup flex container utama --}}

    {{-- ================= SCRIPTS ================= --}}
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

        // Scroll Spy (Aman dari error karena filter(Boolean))
        (function () {
            var links = document.querySelectorAll('[data-nav]');
            var mobileLinks = document.querySelectorAll('[data-nav-mobile]');
            var sections = Array.from(links).map(function (l) {
                return document.getElementById(l.dataset.nav);
            }).filter(Boolean); 

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