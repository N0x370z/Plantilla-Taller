<?php
require_once __DIR__ . '/includes/functions.php';
header('Content-Type: application/xml; charset=utf-8');

$base = rtrim(cfg('site.url'), '/');
$today = date('Y-m-d');

$static_urls = [
    '/'             => ['priority' => '1.0', 'freq' => 'weekly'],
    '/trabajos.php' => ['priority' => '0.9', 'freq' => 'weekly'],
    '/nosotros.php' => ['priority' => '0.7', 'freq' => 'monthly'],
    '/contacto.php' => ['priority' => '0.7', 'freq' => 'monthly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($static_urls as $path => $meta) {
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($base . $path) . "</loc>\n";
    echo "    <lastmod>{$today}</lastmod>\n";
    echo "    <changefreq>{$meta['freq']}</changefreq>\n";
    echo "    <priority>{$meta['priority']}</priority>\n";
    echo "  </url>\n";
}

// Cada obra es una URL
foreach (load_works() as $work) {
    $slug = $work['slug'] ?? '';
    if ($slug === '') continue;
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($base . '/trabajo.php?slug=' . $slug) . "</loc>\n";
    echo "    <lastmod>{$today}</lastmod>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.6</priority>\n";
    echo "  </url>\n";
}

echo '</urlset>' . "\n";
