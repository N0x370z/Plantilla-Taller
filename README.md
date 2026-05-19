# Plantilla Taller — Sitio web para artesanos / muebleros pequeños

Plantilla en PHP plano + Tailwind (vía CDN) diseñada para mostrar el trabajo de un artesano, carpintero o mueblero independiente. Lista para personalizar editando un solo archivo de configuración.

---

## ¿Qué incluye?

- **5 páginas** prediseñadas: Inicio, Trabajos (galería), Detalle de obra, Sobre el oficio, Contacto.
- **Botón flotante de WhatsApp** en todas las páginas.
- **Formulario de contacto** funcional con validación, anti-spam (honeypot) y envío por `mail()` de PHP.
- **Configuración centralizada** en `config.php` — cambias datos del negocio sin tocar HTML.
- **Catálogo de obras** editable en `data/works.json` — agregar/quitar piezas es editar este archivo.
- **Diseño responsive**, optimizado para móvil.
- **SEO completo**: meta tags, Open Graph, Twitter Card, canonical, robots.txt, sitemap dinámico.
- **Accesibilidad**: skip link, aria-expanded, aria-label, aria-current, prefers-reduced-motion.
- **Google Analytics GA4** opcional — actívalo con un solo campo en `config.php`.
- **Cache-busting** de assets vía `assets_version` en config.
- **Sin dependencias de Node.js, npm, ni build process** — subes archivos por FTP y funciona.

---

## Requisitos del hosting

- PHP 8.0 o superior (cualquier hosting compartido moderno lo tiene)
- Función `mail()` habilitada (estándar en Hostinger, GoDaddy, etc.)
- Apache con `mod_rewrite` (estándar)
- ~50 MB de espacio libre

Hostings que funcionan bien: Hostinger México, GoDaddy MX, SiteGround, Banahosting. Cualquier plan básico de $50-150 MXN/mes.

---

## Instalación rápida

1. Sube todos los archivos por FTP al directorio público del hosting (normalmente `public_html/`).
2. Abre `config.php` y edita los valores (ver siguiente sección).
3. Reemplaza las imágenes en `images/works/` y `images/ui/` con las del cliente.
4. Edita `data/works.json` con las piezas reales.
5. Crea la carpeta `logs/` con permisos 755 (`mkdir logs && chmod 755 logs`).
6. Apunta el dominio al hosting si aún no lo está.
7. Listo.

---

## Personalización (lo único que tocas)

### 1. `config.php` — datos del negocio

Edita cada valor:

```php
'brand' => [
    'name'        => 'Nombre del Taller',
    'tagline'     => 'Frase corta de propuesta',
    'description' => 'Descripción más larga para SEO',
    'founded'     => '2015',
    'maker_name'  => 'Nombre del Artesano',
],

'contact' => [
    'phone'    => '+52 55 1234 5678',     // Visible al usuario
    'whatsapp' => '525512345678',          // Sin + ni espacios para wa.me
    'email'    => 'contacto@dominio.mx',
    'email_to' => 'donde@llegan-formularios.mx',
    // ... etc
],

'site' => [
    'url'            => 'https://tudominio.mx',
    'assets_version' => '1.0.0',   // Sube el número para forzar recarga de CSS en navegadores
    'analytics_id'   => '',        // Pega aquí tu ID de GA4 (ej: G-XXXXXXXXXX) o deja vacío
],
```

Todo lo que cambies aquí se actualiza en TODAS las páginas automáticamente.

### 2. `data/works.json` — las obras

Cada obra es un objeto con esta forma:

```json
{
    "number": 47,
    "slug": "url-amigable-de-la-pieza",
    "title": "Mesa de comedor en roble",
    "category": "mesas",
    "year": "2024",
    "materials": "Roble macizo",
    "dimensions": "240 × 100 × 76 cm",
    "finish": "Aceite duro natural",
    "client": "Encargo particular",
    "description": "Descripción larga de la pieza...",
    "images": [
        "/images/works/47-foto-01.jpg",
        "/images/works/47-foto-02.jpg"
    ]
}
```

**Reglas importantes**:
- `number` debe ser único.
- `slug` debe ser único, en minúsculas, sin acentos ni espacios (usa guiones).
- `category` es opcional pero útil para filtrado futuro (ej: `"mesas"`, `"sillas"`, `"almacenamiento"`).
- `images` es un array — primera imagen es la principal.
- Las imágenes van en `/images/works/` con el nombre que pongas aquí.

### 3. Imágenes

- **Obras**: súbelas a `/images/works/`. Recomendado: JPG, 1600×1200 px, optimizadas a menos de 300 KB cada una.
- **Retrato del artesano**: súbela como `/images/ui/about-portrait.jpg`. Si no existe, sale un placeholder elegante.
- **Favicon**: `/images/ui/favicon.ico` (32×32 px).
- **Open Graph** (para previews al compartir en redes): `/images/ui/og-default.jpg`, 1200×630 px.

**Tip**: optimiza imágenes en https://squoosh.app antes de subirlas. Bajan a la mitad del peso sin perder calidad visible.

### 4. Textos editoriales

Los textos largos (intro del home, manifiestos, etc.) están en `config.php` bajo `'texts'`. Edítalos ahí si quieres cambiar la voz del sitio.

Los textos de la página "Sobre el oficio" están dentro de `nosotros.php` porque son párrafos largos que conviene editar en contexto. Búscalos directamente en ese archivo.

---

## Colores y estilo

La paleta está definida en dos lugares:

1. `includes/header.php` (config de Tailwind dentro del `<script>`)
2. `assets/css/custom.css` (algunos colores hardcoded en clases como `.btn-primary`)

Si quieres cambiar la paleta para otro cliente (ej. barbería con colores más oscuros, salón con tonos pastel), edita los dos archivos. Variables a cambiar:

```js
cream:      '#F4F1EB',  // fondo principal
charcoal:   '#1F1D1A',  // texto principal
sage:       '#5C6B5B',  // color de acento
terracotta: '#B5705C',  // acento secundario (raro)
```

---

## Formulario de contacto

- Envía a la dirección configurada en `config.contact.email_to`.
- Usa `mail()` de PHP. Es suficiente para volumen bajo (1-20 mensajes al día).
- Si la entrega cae en spam con frecuencia: cambia a SMTP con PHPMailer. (Pide al hosting que te configure una cuenta SMTP del propio dominio.)
- Incluye honeypot anti-bot básico y rate-limit por sesión (30 segundos entre envíos).
- Errores manejados: `missing`, `email`, `rate` (demasiado rápido), `sendfail`.
- Crea la carpeta `logs/` con permisos 755 para que los fallos se registren en `logs/contact-failed.log`.

---

## Google Analytics (GA4)

Activar es tan fácil como:

```php
'analytics_id' => 'G-XXXXXXXXXX',  // en config.php → site
```

Deja vacío (`''`) para no cargar ningún script de analítica.

---

## Estructura de archivos

```
taller-template/
├── config.php              ← TÚ EDITAS ESTO
├── index.php               ← Home
├── trabajos.php            ← Galería completa
├── trabajo.php             ← Detalle de pieza (?slug=...)
├── nosotros.php            ← Sobre el oficio
├── contacto.php            ← Página de contacto
├── contact-handler.php     ← Procesa el formulario
├── sitemap.php             ← Sitemap XML dinámico
├── robots.txt
├── data/
│   └── works.json          ← TÚ EDITAS ESTO (catálogo de obras)
├── images/
│   ├── works/              ← Fotos de obras
│   └── ui/                 ← Logo, retrato, favicon, OG
├── includes/
│   ├── functions.php       ← Helpers (no tocar)
│   ├── header.php          ← HTML head + nav
│   ├── nav.php             ← Navegación
│   ├── footer.php          ← Footer
│   └── whatsapp-float.php  ← Botón flotante
├── assets/
│   └── css/
│       └── custom.css      ← Estilos custom
└── logs/                   ← Logs de errores (crear con permisos 755)
```

---

## Cómo agregar una nueva obra (paso a paso)

1. Sube las fotos a `/images/works/`. Nómbralas con el número de obra al inicio (ej. `48-silla-encino-01.jpg`).
2. Abre `data/works.json` con un editor de texto (Notepad++, VS Code, lo que sea).
3. Agrega un nuevo objeto al inicio del array, con `number` mayor al actual.
4. Llena los campos. Guarda.
5. Refresca el sitio. Ya aparece.

Si la sintaxis JSON falla (una coma de más, comillas mal cerradas), el sitio no rompe pero la galería sale vacía. Valida en https://jsonlint.com antes de subir.

---

## Despliegue paso a paso (primera vez)

### Opción A: Hosting compartido tradicional (Hostinger, GoDaddy, etc.)

1. Compra hosting + dominio (~$1,200 MXN/año).
2. Accede al panel (cPanel o equivalente).
3. Sube los archivos por File Manager o FTP (FileZilla) a `public_html/`.
4. Edita `config.php` desde el File Manager si es más rápido que volver a subir.
5. Configura cuenta de correo del dominio (ej. `contacto@dominio.mx`) desde el panel.
6. Crea la carpeta `logs/` desde el File Manager con permisos 755.
7. Verifica que el formulario funcione: llena uno y revisa que llegue al correo.
8. Activa SSL gratis (Let's Encrypt) — en Hostinger es un clic.
9. Actualiza `robots.txt` para que el sitemap apunte a tu dominio real.

### Opción B: Servidor propio (homelab)

Solo si sabes lo que haces. Necesitas Apache o Nginx con PHP, reverse proxy con Cloudflare Tunnel o similar para no exponer el puerto directo, y backups. **No recomendado para sitios de clientes.**

---

## Mantenimiento

- **Agregar/editar obras**: edita `data/works.json`. Sin necesidad de tocar código.
- **Cambiar precios/info**: edita `config.php`.
- **Actualizar fotos**: reemplaza archivos en `/images/works/`.
- **Backup**: descarga todo el directorio una vez al mes. Como no hay base de datos, basta con eso.
- **Forzar recarga de CSS** en todos los visitantes: sube el número de `assets_version` en `config.php`.

---

## Personalización para revender la plantilla

Esta plantilla está diseñada para reutilizarse con clientes distintos (barberías, salones, otros muebleros). Para personalizar:

1. **Colores**: edita los hex de la sección de colores en `includes/header.php` y `assets/css/custom.css`.
2. **Tipografía**: cambia las fuentes en `<link href="https://fonts.googleapis.com/css2?family=...">` y en el tailwind config.
3. **Textos**: todos en `config.php` y `nosotros.php`.
4. **Estructura de obras → servicios**: si vendes a un barbero, renombra mentalmente "obras" como "cortes" y ajusta los labels en `trabajos.php`, `trabajo.php` y `config.texts`.

Plan recomendado de personalización: 2-4 horas por cliente nuevo una vez que dominas la plantilla.

---

## Soporte

Esta plantilla es código entregado. Para soporte continuo o cambios significativos, contrata mantenimiento o paga modificaciones por separado.

---

## Licencia

Uso comercial permitido por el dueño de este archivo. No revender la plantilla cruda a terceros (sí está bien usarla para construir sitios para clientes finales y cobrarles por el servicio).
