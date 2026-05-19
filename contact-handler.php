<?php
require_once __DIR__ . '/includes/functions.php';

// ── Solo aceptar POST ─────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /contacto.php');
    exit;
}

// ── Anti-spam: honeypot ───────────────────────────────────────
if (!empty($_POST['website'])) {
    // Bot detectado. Fingimos éxito para no darle señal.
    header('Location: /contacto.php?sent=1');
    exit;
}

// ── Rate limiting básico por sesión ───────────────────────────
session_start();
$now = time();
if (isset($_SESSION['last_contact']) && ($now - $_SESSION['last_contact']) < 30) {
    header('Location: /contacto.php?error=rate');
    exit;
}

// ── Recoger y limpiar campos ──────────────────────────────────
$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$phone   = trim($_POST['phone']   ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Recortar a tamaños razonables
$name    = mb_substr($name,    0, 100);
$email   = mb_substr($email,   0, 120);
$phone   = mb_substr($phone,   0, 30);
$subject = mb_substr($subject, 0, 150);
$message = mb_substr($message, 0, 2000);

// ── Validaciones ──────────────────────────────────────────────
if ($name === '' || $email === '' || $message === '' || mb_strlen($message) < 10) {
    header('Location: /contacto.php?error=missing');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: /contacto.php?error=email');
    exit;
}

// ── Construir el correo ───────────────────────────────────────
$to      = cfg('contact.email_to');
$brand   = cfg('brand.name');
$subject_line = '[' . $brand . '] ' . ($subject !== '' ? $subject : 'Mensaje desde el sitio web');

$body = "Has recibido un nuevo mensaje desde el sitio web de {$brand}.\n";
$body .= str_repeat('─', 60) . "\n\n";
$body .= "Nombre:   {$name}\n";
$body .= "Correo:   {$email}\n";
if ($phone !== '') $body .= "Teléfono: {$phone}\n";
if ($subject !== '') $body .= "Asunto:   {$subject}\n";
$body .= "\nMensaje:\n";
$body .= str_repeat('─', 60) . "\n";
$body .= $message . "\n";
$body .= str_repeat('─', 60) . "\n\n";
$body .= "Enviado: " . date('Y-m-d H:i:s') . "\n";
$body .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'desconocida') . "\n";

// Headers del correo (importante: From debe ser un dominio propio para evitar SPF/spam)
$from_address = cfg('contact.email'); // El dominio del sitio
$headers = "From: {$brand} <{$from_address}>\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

// ── Enviar con mail() ─────────────────────────────────────────
// NOTA: mail() funciona en la mayoría de hosting compartido.
// Si la entrega es mala (spam), considera SMTP con PHPMailer.
$sent = @mail($to, $subject_line, $body, $headers);

if (!$sent) {
    // Log local opcional (asegúrate que la carpeta /logs sea escribible)
    @file_put_contents(
        __DIR__ . '/logs/contact-failed.log',
        date('Y-m-d H:i:s') . " | {$email} | {$message}\n",
        FILE_APPEND
    );
    header('Location: /contacto.php?error=sendfail');
    exit;
}

// ── Éxito ─────────────────────────────────────────────────────
$_SESSION['last_contact'] = $now;
header('Location: /contacto.php?sent=1');
exit;
