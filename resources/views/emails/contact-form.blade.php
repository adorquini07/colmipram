<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" style="width: 600px; max-width: 100%; border-collapse: collapse; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); padding: 30px 40px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: bold;">
                                📬 Nuevo Mensaje de Contacto
                            </h1>
                            <p style="margin: 10px 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">
                                Colegio Mis Primeros Amiguitos - Bosconia, Cesar
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <!-- Info Cards -->
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 15px; background-color: #f0fdf4; border-radius: 12px; border-left: 4px solid #16a34a;">
                                        <p style="margin: 0 0 5px; color: #166534; font-size: 12px; text-transform: uppercase; font-weight: bold;">Nombre</p>
                                        <p style="margin: 0; color: #15803d; font-size: 16px; font-weight: 600;">{{ $contactData['name'] }}</p>
                                    </td>
                                </tr>
                            </table>
                            
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                <tr>
                                    <td style="width: 50%; padding: 15px; background-color: #fef3c7; border-radius: 12px; border-left: 4px solid #f59e0b;">
                                        <p style="margin: 0 0 5px; color: #92400e; font-size: 12px; text-transform: uppercase; font-weight: bold;">Correo</p>
                                        <p style="margin: 0; color: #b45309; font-size: 14px;">{{ $contactData['email'] }}</p>
                                    </td>
                                    <td style="width: 10px;"></td>
                                    <td style="width: 50%; padding: 15px; background-color: #e0e7ff; border-radius: 12px; border-left: 4px solid #6366f1;">
                                        <p style="margin: 0 0 5px; color: #3730a3; font-size: 12px; text-transform: uppercase; font-weight: bold;">Teléfono</p>
                                        <p style="margin: 0; color: #4338ca; font-size: 14px;">{{ $contactData['phone'] ?? 'No proporcionado' }}</p>
                                    </td>
                                </tr>
                            </table>
                            
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                <tr>
                                    <td style="padding: 15px; background-color: #fce7f3; border-radius: 12px; border-left: 4px solid #ec4899;">
                                        <p style="margin: 0 0 5px; color: #9d174d; font-size: 12px; text-transform: uppercase; font-weight: bold;">Asunto</p>
                                        <p style="margin: 0; color: #be185d; font-size: 16px; font-weight: 600;">
                                            @switch($contactData['subject'])
                                                @case('admisiones')
                                                    Información de Admisiones
                                                    @break
                                                @case('academico')
                                                    Consulta Académica
                                                    @break
                                                @case('empleo')
                                                    Oportunidades de Empleo
                                                    @break
                                                @default
                                                    Otro
                                            @endswitch
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Message -->
                            <div style="background-color: #f9fafb; border-radius: 12px; padding: 25px; border: 1px solid #e5e7eb;">
                                <p style="margin: 0 0 10px; color: #374151; font-size: 12px; text-transform: uppercase; font-weight: bold;">Mensaje</p>
                                <p style="margin: 0; color: #1f2937; font-size: 15px; line-height: 1.6; white-space: pre-wrap;">{{ $contactData['message'] }}</p>
                            </div>
                            
                            <!-- Reply Button -->
                            <table role="presentation" style="width: 100%; border-collapse: collapse; margin-top: 30px;">
                                <tr>
                                    <td align="center">
                                        <a href="mailto:{{ $contactData['email'] }}" 
                                           style="display: inline-block; padding: 14px 28px; background-color: #16a34a; color: #ffffff; text-decoration: none; border-radius: 10px; font-weight: bold; font-size: 14px;">
                                            📧 Responder a {{ $contactData['name'] }}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 20px 40px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0 0 5px; color: #6b7280; font-size: 13px;">
                                Este mensaje fue enviado desde el formulario de contacto de
                            </p>
                            <p style="margin: 0; color: #16a34a; font-size: 14px; font-weight: bold;">
                                Colegio Mis Primeros Amiguitos
                            </p>
                            <p style="margin: 15px 0 0; color: #9ca3af; font-size: 12px;">
                                {{ now()->format('d/m/Y H:i') }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

