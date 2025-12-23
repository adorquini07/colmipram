<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Colegio Mis Primeros Amiguitos - Educar al Niño para no Castigar al Hombre - Bosconia, Cesar">
    <title>@yield('title', 'Inicio') - Colegio Mis Primeros Amiguitos</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/imagen_colmipram.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/imagen_colmipram.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        secondary: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    },
                    fontFamily: {
                        'sans': ['Outfit', 'sans-serif'],
                        'display': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Animaciones del carrusel */
        .carousel-container {
            overflow: hidden;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-slide {
            min-width: 100%;
            flex-shrink: 0;
        }

        /* Animación de fade in */
        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Navbar scroll effect */
        .navbar-scrolled {
            background-color: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        /* Hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #15803d 0%, #22c55e 50%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/90 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/imagen_colmipram.png') }}" alt="Logo Colegio Mis Primeros Amiguitos" class="w-14 h-14 rounded-full shadow-lg">
                    <div class="hidden sm:block">
                        <span class="text-lg font-bold text-gray-800 leading-tight block">Mis Primeros</span>
                        <span class="text-lg font-bold text-primary-600 leading-tight">Amiguitos</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:text-primary-600 font-medium transition-colors rounded-lg hover:bg-primary-50 {{ request()->routeIs('home') ? 'text-primary-600 bg-primary-50' : '' }}">
                        Inicio
                    </a>
                    <a href="{{ route('notices') }}" class="px-4 py-2 text-gray-700 hover:text-primary-600 font-medium transition-colors rounded-lg hover:bg-primary-50 {{ request()->routeIs('notices*') ? 'text-primary-600 bg-primary-50' : '' }}">
                        Noticias
                    </a>
                    <a href="{{ route('teachers') }}" class="px-4 py-2 text-gray-700 hover:text-primary-600 font-medium transition-colors rounded-lg hover:bg-primary-50 {{ request()->routeIs('teachers') ? 'text-primary-600 bg-primary-50' : '' }}">
                        Profesores
                    </a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 text-gray-700 hover:text-primary-600 font-medium transition-colors rounded-lg hover:bg-primary-50 {{ request()->routeIs('contact') ? 'text-primary-600 bg-primary-50' : '' }}">
                        Contacto
                    </a>
                    <a href="/admin" class="ml-4 px-6 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-medium rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all shadow-md hover:shadow-lg">
                        Ingresar
                    </a>
                </div>

                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg font-medium">Inicio</a>
                <a href="{{ route('notices') }}" class="block px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg font-medium">Noticias</a>
                <a href="{{ route('teachers') }}" class="block px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg font-medium">Profesores</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg font-medium">Contacto</a>
                <a href="/admin" class="block px-4 py-3 bg-primary-600 text-white rounded-lg font-medium text-center mt-4">Ingresar</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <!-- Main Footer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- About -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="{{ asset('images/imagen_colmipram.png') }}" alt="Logo" class="w-14 h-14 rounded-full bg-white p-1">
                        <div>
                            <span class="text-xl font-bold block">Mis Primeros Amiguitos</span>
                            <span class="text-sm text-gray-400">Bosconia - Cesar</span>
                        </div>
                    </div>
                    <p class="text-gray-400 leading-relaxed mb-6 italic">
                        "Educar al Niño para no Castigar al Hombre"
                    </p>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Formando estudiantes íntegros con valores, conocimiento y habilidades para enfrentar los retos del futuro.
                        Educación de calidad desde párvulo hasta quinto grado.
                    </p>
                    <!-- Social Links -->
                    <div class="flex space-x-4">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/jacqueline.pechecodevega" target="_blank" class="w-10 h-10 bg-gray-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/colegiomisprimerosamiguitos/" target="_blank" class="w-10 h-10 bg-gray-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                            </svg>
                        </a>
                        <!-- TikTok -->
                        <a href="https://www.tiktok.com/@colmipram.cesar" target="_blank" class="w-10 h-10 bg-gray-800 hover:bg-black rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Enlaces Rápidos</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-primary-400 transition-colors">Inicio</a></li>
                        <li><a href="{{ route('notices') }}" class="text-gray-400 hover:text-primary-400 transition-colors">Noticias</a></li>
                        <li><a href="{{ route('teachers') }}" class="text-gray-400 hover:text-primary-400 transition-colors">Profesores</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-primary-400 transition-colors">Contacto</a></li>
                        <li><a href="/admin" class="text-gray-400 hover:text-primary-400 transition-colors">Portal Admin</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Contacto</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-gray-400">Cra 21 # 15 -54, Barrio San Juan Bosco, Bosconia - Cesar</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-gray-400">+57 300 123 4567</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-400">colegiomisprimerosamiguitos@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>