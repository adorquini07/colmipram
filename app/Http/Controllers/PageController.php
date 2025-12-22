<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Página de inicio
     */
    public function home()
    {
        // Obtener 3 profesores directores de grupo al azar
        $directors = Teacher::where('is_group_director', true)
            ->with('courses')
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Obtener las últimas 3 noticias activas
        $latestNotices = Notice::where('is_active', true)
            ->orderBy('publication_date', 'desc')
            ->take(3)
            ->get();

        return view('pages.home', compact('directors', 'latestNotices'));
    }

    /**
     * Página de noticias
     */
    public function notices()
    {
        $notices = Notice::where('is_active', true)
            ->orderBy('publication_date', 'desc')
            ->paginate(9);

        return view('pages.notices', compact('notices'));
    }

    /**
     * Detalle de una noticia
     */
    public function noticeShow(Notice $notice)
    {
        if (!$notice->is_active) {
            abort(404);
        }

        $relatedNotices = Notice::where('is_active', true)
            ->where('id', '!=', $notice->id)
            ->orderBy('publication_date', 'desc')
            ->take(3)
            ->get();

        return view('pages.notice-show', compact('notice', 'relatedNotices'));
    }

    /**
     * Página de profesores
     */
    public function teachers()
    {
        $directors = Teacher::where('is_group_director', true)
            ->with('courses')
            ->orderBy('last_name')
            ->get();

        $teachers = Teacher::where('is_group_director', false)
            ->orderBy('last_name')
            ->get();

        return view('pages.teachers', compact('directors', 'teachers'));
    }

    /**
     * Página de contacto
     */
    public function contact()
    {
        return view('pages.contact');
    }
}
