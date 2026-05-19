<?php
/**
 * Funciones utilitarias del sitio.
 * Todas las páginas hacen require de este archivo.
 */

// Cargar configuración una sola vez
if (!isset($GLOBALS['site_config'])) {
    $GLOBALS['site_config'] = require __DIR__ . '/../config.php';
}

/**
 * Obtener un valor de configuración con notación de punto.
 * Ej: cfg('brand.name') devuelve $config['brand']['name']
 */
function cfg(string $path, mixed $default = ''): mixed {
    $keys = explode('.', $path);
    $value = $GLOBALS['site_config'];
    foreach ($keys as $key) {
        if (!is_array($value) || !array_key_exists($key, $value)) {
            return $default;
        }
        $value = $value[$key];
    }
    return $value;
}

/**
 * Escapar HTML para evitar XSS.
 */
function e(?string $text): string {
    return htmlspecialchars($text ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Construir un link de WhatsApp con mensaje pre-poblado.
 */
function whatsapp_link(string $message = ''): string {
    $number = cfg('contact.whatsapp');
    $message = $message ?: cfg('whatsapp_messages.general');
    return 'https://wa.me/' . rawurlencode($number) . '?text=' . rawurlencode($message);
}

/**
 * Cargar las obras desde works.json.
 * Devuelve array vacío si no existe o está corrupto.
 */
function load_works(): array {
    $path = __DIR__ . '/../data/works.json';
    if (!file_exists($path)) return [];

    $json = file_get_contents($path);
    $data = json_decode($json, true);

    if (!is_array($data)) return [];

    // Ordenar por número descendente (más nuevos primero)
    usort($data, fn($a, $b) => ($b['number'] ?? 0) <=> ($a['number'] ?? 0));

    return $data;
}

/**
 * Buscar una obra por su slug.
 */
function find_work(string $slug): ?array {
    foreach (load_works() as $work) {
        if (($work['slug'] ?? '') === $slug) return $work;
    }
    return null;
}

/**
 * Formatear número de obra con padding (47 -> "#047").
 * Acepta int o string para evitar warnings con datos del JSON.
 */
function work_number(int|string $n): string {
    return '#' . str_pad((string)(int)$n, 3, '0', STR_PAD_LEFT);
}

/**
 * Formatear una fecha Y o Y-m-d a texto legible en español.
 * Ej: '2024' -> '2024'  |  '2024-03' -> 'Marzo 2024'
 */
function format_date(string $date): string {
    if (strlen($date) === 4 && ctype_digit($date)) {
        return $date; // Solo año, devolver tal cual
    }
    $ts = strtotime($date);
    if ($ts === false) return $date;
    $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
               'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    return $meses[(int)date('n', $ts) - 1] . ' ' . date('Y', $ts);
}

/**
 * Slug-ify un string (para URLs).
 */
function slugify(string $text): string {
    $text = mb_strtolower($text, 'UTF-8');
    $text = preg_replace('/[áàä]/u', 'a', $text);
    $text = preg_replace('/[éèë]/u', 'e', $text);
    $text = preg_replace('/[íìï]/u', 'i', $text);
    $text = preg_replace('/[óòö]/u', 'o', $text);
    $text = preg_replace('/[úùü]/u', 'u', $text);
    $text = preg_replace('/ñ/u', 'n', $text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

/**
 * Marca si la URL actual coincide con el path dado (para nav activo).
 */
function is_current(string $path): bool {
    $current = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    return rtrim($current, '/') === rtrim($path, '/');
}
