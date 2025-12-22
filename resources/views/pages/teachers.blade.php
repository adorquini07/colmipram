@extends('layouts.public')

@section('title', 'Profesores')

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
                <h1 class="text-4xl md:text-5xl font-display font-bold text-white mb-4">Nuestros Profesores</h1>
                <p class="text-xl text-primary-100 max-w-2xl mx-auto">
                    Conoce a los profesionales dedicados que forman parte de nuestra familia educativa.
                </p>
            </div>
        </div>
    </section>
    
    <!-- Directors Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Líderes Académicos</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mt-2">Directores de Grupo</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-secondary-500 mx-auto mt-4 rounded-full"></div>
            </div>
            
            @if($directors->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($directors as $director)
                        <div class="bg-gray-50 rounded-3xl p-6 text-center card-hover border border-gray-100">
                            <div class="relative w-28 h-28 mx-auto mb-5">
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-400 to-secondary-400 rounded-full"></div>
                                <div class="absolute inset-1 bg-white rounded-full flex items-center justify-center">
                                    <span class="text-3xl font-bold gradient-text">
                                        {{ strtoupper(substr($director->name, 0, 1)) }}{{ strtoupper(substr($director->last_name, 0, 1)) }}
                                    </span>
                                </div>
                                <!-- Director badge -->
                                <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-secondary-500 rounded-full flex items-center justify-center border-2 border-white">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">
                                {{ $director->name }} {{ $director->last_name }}
                            </h3>
                            <p class="text-primary-600 font-medium text-sm mb-3">{{ $director->position ?? 'Director de Grupo' }}</p>
                            @if($director->courses->count() > 0)
                                <div class="flex flex-wrap justify-center gap-1.5">
                                    @foreach($director->courses as $course)
                                        <span class="px-2.5 py-1 bg-primary-100 text-primary-700 text-xs rounded-full font-medium">
                                            {{ $course->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                            @if($director->email)
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <a href="mailto:{{ $director->email }}" class="text-sm text-gray-500 hover:text-primary-600 transition-colors flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $director->email }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600">No hay directores de grupo registrados aún.</p>
                </div>
            @endif
        </div>
    </section>
    
    <!-- Other Teachers Section -->
    @if($teachers->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Equipo Docente</span>
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 mt-2">Otros Profesores</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-secondary-500 mx-auto mt-4 rounded-full"></div>
            </div>
            
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach ($teachers as $teacher)
                    <div class="bg-white rounded-2xl p-5 text-center card-hover border border-gray-100">
                        <div class="relative w-20 h-20 mx-auto mb-4">
                            <div class="absolute inset-0 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full"></div>
                            <div class="absolute inset-1 bg-white rounded-full flex items-center justify-center">
                                <span class="text-xl font-bold text-gray-600">
                                    {{ strtoupper(substr($teacher->name, 0, 1)) }}{{ strtoupper(substr($teacher->last_name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 mb-1">
                            {{ $teacher->name }} {{ $teacher->last_name }}
                        </h3>
                        <p class="text-gray-500 text-sm">{{ $teacher->position ?? 'Profesor' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    
    <!-- Join Our Team CTA -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-gradient-to-br from-primary-50 to-secondary-50 rounded-3xl p-12 border border-primary-100">
                <h2 class="text-2xl md:text-3xl font-display font-bold text-gray-900 mb-4">
                    ¿Quieres formar parte de nuestro equipo?
                </h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                    Buscamos profesionales apasionados por la educación. Si te interesa ser parte de COLMIPRAM, 
                    contáctanos y cuéntanos sobre ti.
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-lg hover:shadow-xl">
                    Contáctanos
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection

