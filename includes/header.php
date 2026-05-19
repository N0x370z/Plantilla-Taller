<?php
require_once __DIR__ . '/functions.php';

// Cada página puede definir antes de incluir el header:
// $page_title       string  (opcional) — sale en <title>
// $page_description string  (opcional) — meta description
// $page_class       string  (opcional) — clase del <body>

$title       = isset($page_title) ? e($page_title) . ' — ' . e(cfg('brand.name')) : e(cfg('brand.name')) . ' — ' . e(cfg('brand.tagline'));
$description = isset($page_description) ? e($page_description) : e(cfg('brand.description'));
$body_class  = $page_class ?? '';

// URL canónica de la página actual
$canonical = rtrim(cfg('site.url'), '/') . strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>" />
    <meta name="keywords" content="<?= e(cfg('seo.meta_keywords')) ?>" />

    <!-- Open Graph -->
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="<?= e(cfg('brand.name')) ?>" />
    <meta property="og:title" content="<?= $title ?>" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:image" content="<?= e(cfg('site.url') . cfg('seo.og_image')) ?>" />
    <meta property="og:url" content="<?= e($canonical) ?>" />
    <meta property="og:locale" content="es_MX" />

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?= $title ?>" />
    <meta name="twitter:description" content="<?= $description ?>" />
    <meta name="twitter:image" content="<?= e(cfg('site.url') . cfg('seo.og_image')) ?>" />

    <!-- Canonical -->
    <link rel="canonical" href="<?= e($canonical) ?>" />

    <!-- Favicon (poner /images/ui/favicon.ico) -->
    <link rel="icon" type="image/x-icon" href="/images/ui/favicon.ico" />

    <!-- Tipografía -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Manrope:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" />

    <!-- Tailwind CSS por CDN (sin build) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              cream:      '#F4F1EB',
              'cream-2':  '#EAE3D5',
              charcoal:   '#1F1D1A',
              'charcoal-2': '#3A3631',
              warm:       '#5A574F',
              stone:      '#B8B0A5',
              border:     '#E5DFD4',
              sage:       '#5C6B5B',
              'sage-2':   '#7A8979',
              terracotta: '#B5705C',
            },
            fontFamily: {
              display: ['Fraunces', 'Georgia', 'serif'],
              body:    ['Manrope', 'sans-serif'],
              mono:    ['"JetBrains Mono"', 'monospace'],
            },
          }
        }
      }
    </script>

    <!-- CSS custom -->
    <link rel="stylesheet" href="/assets/css/custom.css?v=<?= e(cfg('site.assets_version', '1')) ?>" />

    <?php if (cfg('site.analytics_id')): ?>
    <!-- Google Analytics (GA4) - solo si analytics_id está configurado -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e(cfg('site.analytics_id')) ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?= e(cfg('site.analytics_id')) ?>');
    </script>
    <?php endif; ?>
</head>
<body class="font-body bg-cream text-charcoal antialiased <?= e($body_class) ?>">

<!-- Skip link para accesibilidad -->
<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:bg-charcoal focus:text-cream focus:px-4 focus:py-2 focus:rounded">
    Saltar al contenido
</a>

<?php include __DIR__ . '/nav.php'; ?>

<main id="main">
