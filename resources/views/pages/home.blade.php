@extends('layouts.public')

@section('title', 'Inicio')

@section('content')
    <!-- Hero Section with Carousel -->
    <section class="relative h-[85vh] min-h-[600px] overflow-hidden">
        <!-- Carousel Container -->
        <div class="carousel-container absolute inset-0">
            <div id="carousel-track" class="carousel-track h-full">
                <!-- Slide 1 -->
                <div class="carousel-slide relative h-full">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 via-primary-800/70 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1920&q=80" 
                         alt="Estudiantes en clase" 
                         class="w-full h-full object-cover">
                </div>
                <!-- Slide 2 -->
                <div class="carousel-slide relative h-full">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 via-primary-800/70 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=1920&q=80" 
                         alt="Biblioteca escolar" 
                         class="w-full h-full object-cover">
                </div>
                <!-- Slide 3 -->
                <div class="carousel-slide relative h-full">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 via-primary-800/70 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1920&q=80" 
                         alt="Actividades escolares" 
                         class="w-full h-full object-cover">
                </div>
                <!-- Slide 4 -->
                <div class="carousel-slide relative h-full">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 via-primary-800/70 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?w=1920&q=80" 
                         alt="Estudiantes aprendiendo" 
                         class="w-full h-full object-cover">
                </div>
                <!-- Slide 5 -->
                <div class="carousel-slide relative h-full">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 via-primary-800/70 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=1920&q=80" 
                         alt="Instalaciones del colegio" 
                         class="w-full h-full object-cover">
                </div>
            </div>
        </div>
        
        <!-- Hero Content -->
        <div class="relative z-20 h-full flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <span class="inline-block px-4 py-2 bg-secondary-500/20 text-secondary-300 rounded-full text-sm font-medium mb-6 backdrop-blur-sm border border-secondary-500/30">
                        🎓 Bosconia, Cesar - Educación de Calidad
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white mb-6 leading-tight">
                        Colegio <span class="text-secondary-400">Mis Primeros Amiguitos</span>
                    </h1>
                    <p class="text-2xl text-secondary-300 mb-4 italic font-medium">
                        "Educar al Niño para no Castigar al Hombre"
                    </p>
                    <p class="text-xl text-gray-200 mb-8 leading-relaxed">
                        Formamos estudiantes íntegros con valores, amor y excelencia académica 
                        desde párvulo hasta quinto grado.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('contact') }}" class="px-8 py-4 bg-secondary-500 hover:bg-secondary-600 text-white font-semibold rounded-xl transition-all shadow-lg hover:shadow-xl text-center">
                            Contáctanos
                        </a>
                        <a href="{{ route('notices') }}" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl transition-all backdrop-blur-sm border border-white/20 text-center">
                            Ver Noticias
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Carousel Indicators -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex space-x-3">
            @for ($i = 0; $i < 5; $i++)
                <button class="carousel-indicator w-3 h-3 rounded-full transition-all {{ $i === 0 ? 'bg-white w-8' : 'bg-white/50' }}" data-slide="{{ $i }}"></button>
            @endfor
        </div>
    </section>
    
    <!-- Stats Section -->
    <section class="py-12 bg-white -mt-20 relative z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">6</div>
                        <div class="text-gray-600 font-medium">Grados</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">+500</div>
                        <div class="text-gray-600 font-medium">Estudiantes</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">+20</div>
                        <div class="text-gray-600 font-medium">Profesores</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold gradient-text mb-2">+15</div>
                        <div class="text-gray-600 font-medium">Años de Experiencia</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- About Section - Quiénes Somos -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Conócenos</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mt-2">Quiénes Somos</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-secondary-500 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-72 h-72 bg-primary-200 rounded-full opacity-50 blur-3xl"></div>
                    <div class="absolute -bottom-4 -right-4 w-72 h-72 bg-secondary-200 rounded-full opacity-50 blur-3xl"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl p-8 flex flex-col items-center justify-center h-[400px]">
                        <img src="{{ asset('images/imagen_colmipram.png') }}" 
                             alt="Logo Colegio Mis Primeros Amiguitos" 
                             class="w-64 h-64 object-contain mb-4">
                        <p class="text-center text-gray-600 font-medium">Bosconia - Cesar</p>
                    </div>
                </div>
                
                <div class="space-y-8">
                    <!-- Misión -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 card-hover">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Nuestra Misión</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Educar al niño para formar ciudadanos responsables, con sólidos valores éticos y morales, 
                            capaces de contribuir positivamente a la sociedad. Brindamos educación de calidad que 
                            desarrolla el pensamiento crítico, la creatividad y las habilidades sociales.
                        </p>
                    </div>
                    
                    <!-- Visión -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 card-hover">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-secondary-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Nuestra Visión</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Ser reconocidos en Bosconia y el Cesar como una institución educativa líder, comprometida 
                            con la excelencia académica y la formación integral. Aspiramos a ser el colegio preferido 
                            por las familias donde cada estudiante alcance su máximo potencial.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Directors Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Nuestro Equipo</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mt-2">Directores de Grupo</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-secondary-500 mx-auto mt-4 rounded-full"></div>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    Conoce a algunos de nuestros dedicados directores de grupo que guían a nuestros estudiantes cada día.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                @forelse ($directors as $director)
                    <div class="bg-gray-50 rounded-3xl p-8 text-center card-hover border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-secondary-400 rounded-full animate-pulse"></div>
                            <div class="absolute inset-1 bg-white rounded-full flex items-center justify-center">
                                <span class="text-4xl font-bold gradient-text">
                                    {{ strtoupper(substr($director->name, 0, 1)) }}{{ strtoupper(substr($director->last_name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-1">
                            {{ $director->name }} {{ $director->last_name }}
                        </h3>
                        <p class="text-primary-600 font-medium mb-3">{{ $director->position ?? 'Director de Grupo' }}</p>
                        @if($director->courses->count() > 0)
                            <div class="flex flex-wrap justify-center gap-2">
                                @foreach($director->courses as $course)
                                    <span class="px-3 py-1 bg-primary-100 text-primary-700 text-sm rounded-full font-medium">
                                        {{ $course->name }} - {{ $course->grade }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <!-- Placeholder cards when no directors -->
                    @for ($i = 0; $i < 3; $i++)
                        <div class="bg-gray-50 rounded-3xl p-8 text-center card-hover border border-gray-100">
                            <div class="relative w-32 h-32 mx-auto mb-6">
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-secondary-400 rounded-full"></div>
                                <div class="absolute inset-1 bg-white rounded-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-400 mb-1">Próximamente</h3>
                            <p class="text-gray-400">Director de Grupo</p>
                        </div>
                    @endfor
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('teachers') }}" class="inline-flex items-center px-6 py-3 bg-primary-50 text-primary-700 font-semibold rounded-xl hover:bg-primary-100 transition-colors">
                    Ver todos los profesores
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Latest News Section -->
    @if($latestNotices->count() > 0)
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Mantente Informado</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mt-2">Últimas Noticias</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-secondary-500 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($latestNotices as $notice)
                    <article class="bg-white rounded-3xl overflow-hidden shadow-lg card-hover border border-gray-100">
                        <div class="aspect-video overflow-hidden">
                            @if($notice->image)
                                <img src="{{ asset('storage/' . $notice->image) }}" 
                                     alt="{{ $notice->title }}" 
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary-400 to-secondary-400 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $notice->publication_date->format('d M, Y') }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $notice->title }}</h3>
                            <p class="text-gray-600 line-clamp-3 mb-4">{!! Str::limit(strip_tags($notice->content), 120) !!}</p>
                            <a href="{{ route('notices.show', $notice) }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700">
                                Leer más
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('notices') }}" class="inline-flex items-center px-8 py-4 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-lg hover:shadow-xl">
                    Ver todas las noticias
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif
    
    <!-- Contact CTA Section -->
    <section class="py-20 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)"/>
            </svg>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-white mb-6">
                    ¿Listo para formar parte de nuestra familia?
                </h2>
                <p class="text-xl text-primary-100 mb-8">
                    Contáctanos hoy y descubre por qué el Colegio Mis Primeros Amiguitos es la mejor opción para la educación de tus hijos.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('contact') }}" class="px-8 py-4 bg-white text-primary-700 font-semibold rounded-xl hover:bg-gray-100 transition-colors shadow-lg">
                        Contáctanos Ahora
                    </a>
                    <a href="tel:+573001234567" class="px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-400 transition-colors border border-primary-400">
                        📞 +57 300 123 4567
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Carousel functionality
    const track = document.getElementById('carousel-track');
    const indicators = document.querySelectorAll('.carousel-indicator');
    let currentSlide = 0;
    const totalSlides = 5;
    
    function goToSlide(index) {
        currentSlide = index;
        track.style.transform = `translateX(-${index * 100}%)`;
        
        indicators.forEach((indicator, i) => {
            if (i === index) {
                indicator.classList.add('bg-white', 'w-8');
                indicator.classList.remove('bg-white/50');
            } else {
                indicator.classList.remove('bg-white', 'w-8');
                indicator.classList.add('bg-white/50');
            }
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        goToSlide(currentSlide);
    }
    
    // Auto-play carousel
    setInterval(nextSlide, 5000);
    
    // Click on indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => goToSlide(index));
    });
</script>
@endpush

