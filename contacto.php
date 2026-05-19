<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Contacto';
$page_description = 'Contacta a ' . cfg('brand.name') . ' para cotizar tu mueble personalizado.';

// Detectar éxito/error en submit
$sent  = isset($_GET['sent']) && $_GET['sent'] === '1';
$error = $_GET['error'] ?? null;

include __DIR__ . '/includes/header.php';
?>

<!-- Cabecera -->
<section class="max-w-6xl mx-auto px-6 lg:px-10 pt-16 lg:pt-24 pb-16">
    <div class="grid lg:grid-cols-12 gap-10 items-end">
        <div class="lg:col-span-8">
            <p class="eyebrow fade-up"><?= e(cfg('texts.contact_eyebrow')) ?></p>
            <h1 class="display font-display text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-medium text-charcoal mt-6 leading-[1.05] fade-up-2">
                <?= e(cfg('texts.contact_title')) ?>
            </h1>
        </div>
        <div class="lg:col-span-4 fade-up-3">
            <p class="text-warm leading-relaxed">
                <?= e(cfg('texts.contact_intro')) ?>
            </p>
        </div>
    </div>
</section>

<section class="border-t border-border">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-16 lg:py-24">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-20">

            <!-- Información de contacto -->
            <aside class="lg:col-span-4 space-y-10">

                <!-- WhatsApp destacado -->
                <div class="border-l-2 border-sage pl-6">
                    <p class="eyebrow text-sage">Lo más rápido</p>
                    <h2 class="font-display text-2xl text-charcoal mt-3 leading-snug">Por WhatsApp respondo el mismo día.</h2>
                    <a href="<?= e(whatsapp_link(cfg('whatsapp_messages.quote'))) ?>" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 mt-5 text-sage font-medium text-sm">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413"/></svg>
                        Abrir conversación
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>

                <!-- Teléfono -->
                <div>
                    <p class="eyebrow">Teléfono</p>
                    <a href="tel:<?= e(cfg('contact.phone_link')) ?>"
                       class="block mt-3 font-display text-xl text-charcoal hover:text-sage transition-colors">
                        <?= e(cfg('contact.phone')) ?>
                    </a>
                </div>

                <!-- Email -->
                <div>
                    <p class="eyebrow">Correo</p>
                    <a href="mailto:<?= e(cfg('contact.email')) ?>"
                       class="block mt-3 font-display text-xl text-charcoal hover:text-sage transition-colors break-words">
                        <?= e(cfg('contact.email')) ?>
                    </a>
                </div>

                <!-- Taller -->
                <div>
                    <p class="eyebrow">Taller</p>
                    <p class="mt-3 text-charcoal leading-relaxed">
                        <?= e(cfg('contact.address.street')) ?><br />
                        <?= e(cfg('contact.address.colony')) ?>, <?= e(cfg('contact.address.zip')) ?><br />
                        <?= e(cfg('contact.address.city')) ?>, <?= e(cfg('contact.address.state')) ?>
                    </p>
                </div>

                <!-- Horarios -->
                <div>
                    <p class="eyebrow">Horario</p>
                    <ul class="mt-3 space-y-1 text-charcoal text-[15px]">
                        <li><?= e(cfg('contact.hours.weekdays')) ?></li>
                        <li><?= e(cfg('contact.hours.saturday')) ?></li>
                        <li class="text-stone"><?= e(cfg('contact.hours.sunday')) ?></li>
                    </ul>
                </div>
            </aside>

            <!-- Formulario -->
            <div class="lg:col-span-8 lg:border-l lg:border-border lg:pl-20">

                <?php if ($sent): ?>
                    <div class="bg-sage/10 border border-sage/30 p-8">
                        <p class="font-mono text-[10px] tracking-[0.25em] text-sage uppercase">Mensaje enviado</p>
                        <h2 class="font-display text-3xl text-charcoal mt-4">Gracias por escribir.</h2>
                        <p class="mt-4 text-warm leading-relaxed">
                            Tu mensaje llegó. Te respondo normalmente el mismo día o, a más tardar, al día siguiente hábil.
                        </p>
                        <p class="mt-6 text-sm text-warm">
                            Si lo tuyo es urgente, puedes seguir la conversación por
                            <a href="<?= e(whatsapp_link(cfg('whatsapp_messages.general'))) ?>" target="_blank" rel="noopener" class="text-sage link-underline">WhatsApp directo</a>.
                        </p>
                    </div>
                <?php else: ?>

                    <?php if ($error): ?>
                        <div class="bg-terracotta/10 border border-terracotta/30 p-4 mb-6 text-sm text-terracotta">
                            <?php
                            echo match($error) {
                                'missing'  => 'Por favor llena todos los campos obligatorios.',
                                'email'    => 'El correo electrónico no parece válido.',
                                'rate'     => 'Enviaste un mensaje hace menos de 30 segundos. Espera un momento.',
                                'sendfail' => 'Hubo un problema al enviar. Intenta de nuevo o escríbeme por WhatsApp.',
                                default    => 'Ocurrió un error. Intenta de nuevo.',
                            };
                            ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/contact-handler.php" class="space-y-8">
                        <!-- Honeypot anti-spam -->
                        <input type="text" name="website" tabindex="-1" autocomplete="off"
                               style="position:absolute;left:-9999px;opacity:0;" />

                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <label class="eyebrow block mb-3" for="name">Nombre *</label>
                                <input id="name" name="name" type="text" required maxlength="100"
                                       class="form-input" placeholder="Tu nombre completo"
                                       value="<?= e($_GET['name'] ?? '') ?>" />
                            </div>
                            <div>
                                <label class="eyebrow block mb-3" for="phone">Teléfono</label>
                                <input id="phone" name="phone" type="tel" maxlength="30"
                                       class="form-input" placeholder="+52 55 0000 0000" />
                            </div>
                        </div>

                        <div>
                            <label class="eyebrow block mb-3" for="email">Correo electrónico *</label>
                            <input id="email" name="email" type="email" required maxlength="120"
                                   class="form-input" placeholder="tu@correo.com" />
                        </div>

                        <div>
                            <label class="eyebrow block mb-3" for="subject">Asunto</label>
                            <input id="subject" name="subject" type="text" maxlength="150"
                                   class="form-input" placeholder="Ej. Mesa de comedor para 6 personas" />
                        </div>

                        <div>
                            <label class="eyebrow block mb-3" for="message">Mensaje *</label>
                            <textarea id="message" name="message" required minlength="10" maxlength="2000"
                                      class="form-input"
                                      placeholder="Cuéntame qué tienes en mente. Si tienes una foto de referencia o medidas del espacio, también puedes describirlas aquí."></textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 pt-2">
                            <button type="submit" class="btn btn-primary">
                                Enviar mensaje
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </button>
                            <p class="text-xs text-stone">* Campos obligatorios</p>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Mapa (opcional, solo si hay URL configurada) -->
<?php if (!empty(cfg('contact.maps_embed_url')) && strpos(cfg('contact.maps_embed_url'), 'google.com/maps/embed') !== false): ?>
<section class="border-t border-border">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-16">
        <p class="eyebrow mb-6">Ubicación del taller</p>
        <div class="aspect-[16/7] bg-cream-2 overflow-hidden">
            <iframe src="<?= e(cfg('contact.maps_embed_url')) ?>"
                    class="w-full h-full"
                    style="border:0;"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Ubicación del taller"></iframe>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
