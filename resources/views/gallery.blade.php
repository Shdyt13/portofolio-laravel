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

        /* ============================================================
           LAPISAN INTERAKTIF TAMBAHAN
           (Tidak mengubah token warna / struktur komponen di atas,
           hanya menambah transisi, animasi, dan micro-interaction)
           ============================================================ */

        /* --- Scroll progress bar --- */
        #scroll-progress {
            position: fixed; top: 0; left: 0; height: 3px; width: 0%;
            background: var(--accent); z-index: 60;
            transition: width .12s ease-out;
        }

        /* --- Reveal-on-scroll (dipasang lewat JS, tidak mengubah markup) --- */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .55s ease, transform .55s ease;
            will-change: opacity, transform;
        }
        .reveal.is-visible { opacity: 1; transform: translateY(0); }

        /* --- Tilt halus pada kartu galeri saat mouse bergerak --- */
        .card-hover { transition: border-color .3s ease, box-shadow .3s ease, transform .18s ease-out; }

        /* --- Kursor "lihat" saat hover thumbnail galeri --- */
        .gallery-thumb-wrap { position: relative; cursor: zoom-in; }
        .gallery-thumb-wrap::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,.35), transparent 55%);
            opacity: 0; transition: opacity .3s ease;
            pointer-events: none;
        }
        .card-hover:hover .gallery-thumb-wrap::after { opacity: 1; }

        /* --- Underline hover pada nav link (tidak mengganggu state aktif) --- */
        .nav-link::after {
            content: ''; position: absolute; left: 0; right: 0; bottom: -2px;
            height: 2px; border-radius: 9999px; background: var(--accent);
            transform: scaleX(0); transform-origin: left; transition: transform .25s ease;
        }
        .nav-link:hover::after { transform: scaleX(1); }

        /* --- Efek magnetik ringan pada icon button --- */
        .icon-btn { transform: translate(var(--mx, 0px), var(--my, 0px)); }

        /* --- Transisi buka/tutup menu mobile yang lebih halus --- */
        @keyframes fadeSlideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        #mobile-menu.menu-enter { animation: fadeSlideDown .25s ease forwards; }

        /* --- Tombol kembali ke atas --- */
        #back-to-top {
            position: fixed; right: 1.5rem; bottom: 1.5rem; z-index: 50;
            width: 3rem; height: 3rem; border-radius: 9999px;
            display: grid; place-items: center;
            background: var(--surface); border: 1px solid var(--line); color: var(--accent);
            box-shadow: 0 10px 30px -10px rgba(0,0,0,.2);
            opacity: 0; transform: translateY(14px) scale(.9); pointer-events: none;
            transition: opacity .3s ease, transform .3s ease, border-color .2s ease;
        }
        #back-to-top.is-visible { opacity: 1; transform: translateY(0) scale(1); pointer-events: auto; }
        #back-to-top:hover { border-color: var(--accent); transform: translateY(-3px) scale(1.05); }

        /* --- Loading fade-in halaman --- */
        body { opacity: 0; transition: opacity .4s ease; }
        body.is-loaded { opacity: 1; }

        @media (prefers-reduced-motion: reduce) {
            .reveal { opacity: 1 !important; transform: none !important; }
        }
    </style>

    <div class="font-body bg-page text-fg min-h-screen flex flex-col pt-20 transition-colors duration-300 selection:bg-blue-500/30">

        <div id="scroll-progress" aria-hidden="true"></div>

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
                <h1 class="font-display text-3xl sm:text-4xl font-bold mb-4">My <span class="text-accent">Gallery</span></h1>
                <p class="text-muted max-w-xl mx-auto text-sm sm:text-base leading-relaxed px-2">
                    A space for self-expression beyond lines of code. Here, I share various works, explorations, moments, and things I enjoy or find meaningful.
                </p>
            </div>

            {{-- Grid Galeri (4 Kolom Desktop, 2 Kolom Mobile) --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @forelse($galleries as $item)
                    <div class="card card-hover group flex flex-col overflow-hidden bg-surface-2">
                        <div class="overflow-hidden bg-muted/10 relative cursor-pointer js-lightbox-trigger" data-image="{{ asset('storage/' . $item->image) }}">
                            <img src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->title }}"
                                loading="lazy"
                                class="gallery-thumb">
                            
                            {{-- Ikon perbesaran opsional di tengah saat dihover --}}
                            <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-300 flex items-center justify-center card-hover:hover:opacity-100 pointer-events-none z-10">
                                <svg class="text-white w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            </div>
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
                        <a href="https://www.linkedin.com/in/sapar-hidayat-s-200684301/" target="_blank" class="text-muted hover:text-accent transition-colors" aria-label="LinkedIn">
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

        <button type="button" id="back-to-top" aria-label="Kembali ke atas">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
        </button>

        {{-- ================= MODAL LIGHTBOX ================= --}}
        <div id="lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/90 p-4 sm:p-8 backdrop-blur-sm transition-opacity duration-300 opacity-0">
            <button type="button" id="lightbox-close" class="absolute top-4 right-4 sm:top-8 sm:right-8 text-white/70 hover:text-white bg-black/50 hover:bg-black/80 rounded-full p-2 transition-all duration-200" aria-label="Tutup">
                <svg class="h-6 w-6 sm:h-8 sm:w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            <img id="lightbox-img"
                src=""
                alt="Perbesaran Gambar Galeri"
                class="max-h-[90vh] max-w-full rounded-md shadow-2xl scale-95 transition-transform duration-300 object-contain m-auto mx-auto">
        </div>
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

                if (isHidden) {
                    menu.classList.remove('hidden');
                    menu.classList.add('menu-enter');
                    btn.setAttribute('aria-expanded', 'true');
                } else {
                    menu.classList.add('hidden');
                    menu.classList.remove('menu-enter');
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

        // Scroll Spy
        (function () {
            var links = document.querySelectorAll('[data-nav]');
            var mobileLinks = document.querySelectorAll('[data-nav-mobile]');

            var sections = Array.from(links)
                .map(function (l) {
                    return document.getElementById(l.dataset.nav);
                })
                .filter(Boolean);

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;

                    var currentId = entry.target.id;

                    // Update Desktop Nav
                    links.forEach(function (l) {
                        if (l.dataset.nav === currentId) {
                            l.classList.add('is-active');
                        } else {
                            l.classList.remove('is-active');
                        }
                    });

                    // Update Mobile Nav
                    mobileLinks.forEach(function (l) {
                        if (l.dataset.navMobile === currentId) {
                            l.classList.add('text-accent', 'font-bold');
                            l.classList.remove('text-muted');
                        } else {
                            l.classList.remove('text-accent', 'font-bold');
                            l.classList.add('text-muted');
                        }
                    });
                });
            }, {
                rootMargin: '-20% 0px -75% 0px'
            });

            sections.forEach(function (s) {
                observer.observe(s);
            });
        })();

        // LAPISAN INTERAKTIF TAMBAHAN
        (function () {
            var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            // --- Fade-in halaman saat load ---
            window.addEventListener('load', function () {
                document.body.classList.add('is-loaded');
            });

            // --- Scroll progress bar ---
            var progressBar = document.getElementById('scroll-progress');

            function updateProgress() {
                if (!progressBar) return;

                var h = document.documentElement;
                var scrolled = h.scrollTop;
                var max = h.scrollHeight - h.clientHeight;
                var pct = max > 0 ? (scrolled / max) * 100 : 0;

                progressBar.style.width = pct + '%';
            }

            document.addEventListener('scroll', updateProgress, {
                passive: true
            });

            updateProgress();

            // --- Tombol back-to-top ---
            var backToTop = document.getElementById('back-to-top');

            if (backToTop) {
                document.addEventListener('scroll', function () {
                    backToTop.classList.toggle(
                        'is-visible',
                        window.scrollY > 480
                    );
                }, {
                    passive: true
                });

                backToTop.addEventListener('click', function () {
                    window.scrollTo({
                        top: 0,
                        behavior: reduceMotion ? 'auto' : 'smooth'
                    });
                });
            }

            // --- Tandai wrapper thumbnail galeri ---
            document.querySelectorAll('.card-hover').forEach(function (card) {
                var thumbWrap = card.querySelector(':scope > div:first-child');

                if (thumbWrap) {
                    thumbWrap.classList.add('gallery-thumb-wrap');
                }
            });

            // --- Reveal on scroll ---
            if (!reduceMotion) {
                var revealTargets = document.querySelectorAll(
                    'main > div, .card'
                );

                var revealObserver = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });

                revealTargets.forEach(function (el, i) {
                    el.classList.add('reveal');
                    el.style.transitionDelay = ((i % 8) * 50) + 'ms';
                    revealObserver.observe(el);
                });
            }

            // --- Tilt halus pada kartu galeri ---
            if (
                !reduceMotion &&
                window.matchMedia('(hover: hover) and (pointer: fine)').matches
            ) {
                document.querySelectorAll('.card-hover').forEach(function (el) {

                    el.addEventListener('mousemove', function (e) {
                        var r = el.getBoundingClientRect();

                        var px = (e.clientX - r.left) / r.width - 0.5;
                        var py = (e.clientY - r.top) / r.height - 0.5;

                        el.style.transform =
                            'translateY(-4px) rotateX(' +
                            (py * -3) +
                            'deg) rotateY(' +
                            (px * 3) +
                            'deg)';
                    });

                    el.addEventListener('mouseleave', function () {
                        el.style.transform = '';
                    });
                });

                // --- Efek magnetik ringan pada icon button ---
                document.querySelectorAll('.icon-btn').forEach(function (el) {

                    el.addEventListener('mousemove', function (e) {
                        var r = el.getBoundingClientRect();

                        var mx =
                            (e.clientX - r.left - r.width / 2) * 0.25;

                        var my =
                            (e.clientY - r.top - r.height / 2) * 0.25;

                        el.style.setProperty('--mx', mx + 'px');
                        el.style.setProperty('--my', my + 'px');
                    });

                    el.addEventListener('mouseleave', function () {
                        el.style.setProperty('--mx', '0px');
                        el.style.setProperty('--my', '0px');
                    });
                });
            }
        })();

        // --- Modal Lightbox Galeri ---
        (function () {
            var lightbox = document.getElementById('lightbox');
            var lightboxImg = document.getElementById('lightbox-img');
            var closeBtn = document.getElementById('lightbox-close');
            var triggers = document.querySelectorAll('.js-lightbox-trigger');

            if (!lightbox || !lightboxImg) return;

            function openLightbox(url) {
                lightboxImg.src = url;

                // Tampilkan lightbox
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');

                // Mencegah scroll pada halaman latar belakang
                document.body.style.overflow = 'hidden';

                // Beri jeda sangat kecil agar transisi Tailwind berjalan
                requestAnimationFrame(function () {
                    lightbox.classList.remove('opacity-0');
                    lightboxImg.classList.remove('scale-95');
                    lightboxImg.classList.add('scale-100');
                });
            }

            function closeLightbox() {
                lightbox.classList.add('opacity-0');

                lightboxImg.classList.remove('scale-100');
                lightboxImg.classList.add('scale-95');

                // Kembalikan scroll halaman
                document.body.style.overflow = '';

                // Sembunyikan elemen setelah transisi selesai (300ms)
                setTimeout(function () {
                    lightbox.classList.add('hidden');
                    lightbox.classList.remove('flex');

                    // Kosongkan src agar tidak berkedip saat dibuka lagi
                    lightboxImg.src = '';
                }, 300);
            }

            // Pasang event klik pada semua gambar galeri
            triggers.forEach(function (trigger) {
                trigger.addEventListener('click', function () {
                    var imageUrl = this.getAttribute('data-image');

                    if (imageUrl) {
                        openLightbox(imageUrl);
                    }
                });
            });

            // Event penutup lightbox
            if (closeBtn) {
                closeBtn.addEventListener('click', closeLightbox);
            }

            // Tutup saat mengklik area hitam (luar gambar)
            lightbox.addEventListener('click', function (e) {
                if (e.target === lightbox) {
                    closeLightbox();
                }
            });

            // Tutup menggunakan tombol Escape
            document.addEventListener('keydown', function (e) {
                if (
                    e.key === 'Escape' &&
                    !lightbox.classList.contains('hidden')
                ) {
                    closeLightbox();
                }
            });
        })();
    </script>
</x-layout>