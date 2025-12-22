@extends('layouts.public')

@section('title', 'Noticias')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 py-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="dots" width="5" height="5" patternUnits="userSpaceOnUse">
                        <circle cx="2.5" cy="2.5" r="1" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#dots)"/>
            </svg>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-display font-bold text-white mb-4">Noticias</h1>
                <p class="text-xl text-primary-100 max-w-2xl mx-auto">
                    Mantente al día con las últimas novedades, eventos y actividades de nuestro colegio.
                </p>
            </div>
        </div>
    </section>
    
    <!-- Notices Grid -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($notices->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($notices as $notice)
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
                                <p class="text-gray-600 line-clamp-3 mb-4">{!! Str::limit(strip_tags($notice->content), 150) !!}</p>
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
                
                <!-- Pagination -->
                <div class="mt-12">
                    {{ $notices->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay noticias disponibles</h3>
                    <p class="text-gray-600">Pronto publicaremos nuevas noticias. ¡Vuelve pronto!</p>
                </div>
            @endif
        </div>
    </section>
@endsection

