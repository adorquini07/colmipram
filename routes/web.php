<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas del Sitio Web
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', [PageController::class, 'home'])->name('home');

// Noticias
Route::get('/noticias', [PageController::class, 'notices'])->name('notices');
Route::get('/noticias/{notice}', [PageController::class, 'noticeShow'])->name('notices.show');

// Profesores
Route::get('/profesores', [PageController::class, 'teachers'])->name('teachers');

// Contacto
Route::get('/contacto', [PageController::class, 'contact'])->name('contact');
Route::post('/contacto', [PageController::class, 'contactSubmit'])->name('contact.submit');
