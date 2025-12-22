<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Notice;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    /**
     * Número de WhatsApp para recibir mensajes (con código de país)
     */
    protected string $whatsappNumber = '573126087457';

    /**
     * Correo para recibir mensajes de contacto
     */
    protected string $contactEmail = 'adorquini2017@gmail.com';
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

    /**
     * Procesar formulario de contacto
     * Envía correo electrónico y redirige a WhatsApp
     */
    public function contactSubmit(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|in:admisiones,academico,empleo,otro',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'subject.required' => 'Selecciona un asunto.',
            'message.required' => 'El mensaje es obligatorio.',
        ]);

        // Traducir el asunto para el mensaje
        $subjectLabels = [
            'admisiones' => 'Información de Admisiones',
            'academico' => 'Consulta Académica',
            'empleo' => 'Oportunidades de Empleo',
            'otro' => 'Otro',
        ];

        try {
            // Enviar correo electrónico
            Mail::to($this->contactEmail)->send(new ContactFormMail($validated));
            
            $emailSent = true;
        } catch (\Exception $e) {
            // Si falla el correo, continuamos con WhatsApp
            $emailSent = false;
            \Log::error('Error enviando correo de contacto: ' . $e->getMessage());
        }

        // Construir mensaje para WhatsApp
        $whatsappMessage = "🏫 *Colegio Mis Primeros Amiguitos*\n📍 Bosconia - Cesar\n\n";
        $whatsappMessage .= "👤 *Nombre:* {$validated['name']}\n";
        $whatsappMessage .= "📧 *Correo:* {$validated['email']}\n";
        
        if (!empty($validated['phone'])) {
            $whatsappMessage .= "📱 *Teléfono:* {$validated['phone']}\n";
        }
        
        $whatsappMessage .= "📋 *Asunto:* {$subjectLabels[$validated['subject']]}\n\n";
        $whatsappMessage .= "💬 *Mensaje:*\n{$validated['message']}";

        // Codificar el mensaje para URL
        $encodedMessage = urlencode($whatsappMessage);
        
        // Construir URL de WhatsApp
        $whatsappUrl = "https://wa.me/{$this->whatsappNumber}?text={$encodedMessage}";

        // Guardar mensaje de éxito en sesión
        if ($emailSent) {
            session()->flash('success', '¡Mensaje enviado correctamente! También puedes enviarnos un WhatsApp.');
        } else {
            session()->flash('warning', 'No pudimos enviar el correo, pero puedes contactarnos por WhatsApp.');
        }

        // Redirigir a WhatsApp
        return redirect()->away($whatsappUrl);
    }
}
