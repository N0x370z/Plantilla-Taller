<?php
/**
 * ─────────────────────────────────────────────────────────────────
 *  CONFIGURACIÓN DEL SITIO
 * ─────────────────────────────────────────────────────────────────
 *  Este es el ÚNICO archivo que editas para personalizar el sitio.
 *  Cambia los valores de abajo y todo el sitio se actualiza.
 * ─────────────────────────────────────────────────────────────────
 */

return [

    // ── Identidad del taller ────────────────────────────────────
    'brand' => [
        'name'        => 'Taller Mendoza',                    // Aparece en header, footer, título
        'tagline'     => 'Muebles a la medida hechos a mano',  // Subtítulo en home
        'description' => 'Taller artesanal especializado en mobiliario personalizado para el hogar. Cada pieza es única, hecha con maderas nobles y técnica tradicional.',
        'founded'     => '2015',                              // Año de fundación
        'maker_name'  => 'Roberto Mendoza',                    // Nombre del artesano (aparece en /nosotros)
    ],

    // ── Contacto ────────────────────────────────────────────────
    'contact' => [
        'phone'         => '+52 55 1234 5678',                // Visible al usuario
        'phone_link'    => '+525512345678',                   // Para link tel:
        'whatsapp'      => '525512345678',                    // SIN +, SIN espacios. Para link wa.me
        'email'         => 'contacto@tallermendoza.mx',
        'email_to'      => 'roberto@tallermendoza.mx',        // Email que RECIBE los formularios
        'address'       => [
            'street'  => 'Calle Hidalgo 145',
            'colony'  => 'Centro',
            'city'    => 'Toluca',
            'state'   => 'Estado de México',
            'zip'     => '50000',
        ],
        'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3766.123!2d-99.65', // URL completa de Google Maps embed
        'hours'         => [
            'weekdays' => 'Lunes a Viernes, 9:00 - 18:00',
            'saturday' => 'Sábados, 10:00 - 14:00',
            'sunday'   => 'Domingos cerrado',
        ],
    ],

    // ── Redes sociales (deja vacío lo que no aplique) ──────────
    'social' => [
        'instagram' => 'https://instagram.com/tallermendoza',
        'facebook'  => 'https://facebook.com/tallermendoza',
        'tiktok'    => '',
        'pinterest' => '',
    ],

    // ── Mensajes pre-poblados para WhatsApp ────────────────────
    'whatsapp_messages' => [
        'general'      => '¡Hola! Vi su sitio web y me gustaría más información.',
        'quote'        => '¡Hola! Me interesa cotizar un mueble personalizado.',
        'piece'        => '¡Hola! Me interesa una pieza similar a:', // Se le concatena el nombre
        'about_piece'  => '¡Hola! Vi en su sitio la pieza',          // Se le concatena ID y se completa
    ],

    // ── Configuración técnica ───────────────────────────────────
    'site' => [
        'url'            => 'https://tallermendoza.mx',  // Sin slash al final
        'timezone'       => 'America/Mexico_City',
        'locale'         => 'es_MX',
        'assets_version' => '1.0.0',                     // Cambia para forzar recarga de CSS/JS en clientes
        'analytics_id'   => '',                          // GA4 Measurement ID (ej: G-XXXXXXXXXX). Deja vacío para desactivar.
    ],

    // ── SEO ─────────────────────────────────────────────────────
    'seo' => [
        'meta_keywords' => 'muebles a medida, carpintería, muebles personalizados, taller, Toluca, mobiliario artesanal',
        'og_image'      => '/images/ui/og-default.jpg',  // 1200x630px recomendado
    ],

    // ── Textos del sitio (puedes editarlos sin tocar HTML) ─────
    'texts' => [
        'home_hero_eyebrow'  => 'Estudio · Taller · Oficio',
        'home_intro'         => 'Diseño y construyo cada mueble en mi taller, pieza por pieza, con maderas seleccionadas a mano. No hay producción en serie: cada encargo es una conversación con quien lo va a habitar.',
        'home_works_eyebrow' => 'Obras recientes',
        'home_works_title'   => 'Lo que ha salido del taller',
        'about_eyebrow'      => 'Sobre el oficio',
        'about_title_1'      => 'Una mesa puede durar tres generaciones',
        'about_title_2'      => 'si la haces con tiempo.',
        'contact_eyebrow'    => 'Hablemos',
        'contact_title'      => '¿Tienes una pieza en mente?',
        'contact_intro'      => 'Cuéntame qué necesitas. Respondo personalmente, normalmente el mismo día.',
    ],

];
