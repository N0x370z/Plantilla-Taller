<?php
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$work = find_work($slug);

if (!$work) {
    http_response_code(404);
    $page_title = 'Obra no encontrada';
    include __DIR__ . '/includes/header.php';
    ?>
    <section class="max-w-3xl mx-auto px-6 py-32 text-center">
        <p class="eyebrow">404</p>
        <h1 class="font-display text-5xl lg:text-6xl font-medium text-charcoal mt-6">No encontramos esa obra.</h1>
        <p class="mt-6 text-warm">Es posible que el enlace haya cambiado o que la pieza ya no esté en el archivo.</p>
        <div class="mt-10">
            <a href="/trabajos.php" class="btn btn-primary">Ver todos los trabajos</a>
        </div>
    </section>
    <?php
    include __DIR__ . '/includes/footer.php';
    exit;
}

$page_title = $work['title'] . ' — Obra ' . work_number($work['number']);
$page_description = $work['description'] ?? cfg('brand.description');

// Mensaje WhatsApp pre-poblado con info de la pieza
$wa_msg = cfg('whatsapp_messages.about_piece') . ' '
        . work_number($work['number']) . ' "' . $work['title'] . '". '
        . 'Me gustaría más información o cotizar una similar.';

include __DIR__ . '/includes/header.php';
?>

<!-- Breadcrumb -->
<div class="max-w-6xl mx-auto px-6 lg:px-10 pt-10">
    <nav aria-label="Navegación de migas" class="font-mono text-[11px] uppercase tracking-[0.2em] text-warm flex items-center gap-2">
        <a href="/" class="hover:text-sage">Inicio</a>
        <span aria-hidden="true">/</span>
        <a href="/trabajos.php" class="hover:text-sage">Trabajos</a>
        <span aria-hidden="true">/</span>
        <span class="text-charcoal" aria-current="page"><?= e(work_number($work['number'])) ?></span>
    </nav>
</div>

<!-- Cabecera de la obra -->
<section class="max-w-6xl mx-auto px-6 lg:px-10 pt-10 pb-14">
    <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-end">
        <div class="lg:col-span-8">
            <p class="font-mono text-[10px] tracking-[0.25em] text-warm uppercase">Obra <?= e(work_number($work['number'])) ?> · <?= e(format_date($work['year'] ?? '')) ?></p>
            <h1 class="display font-display text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-medium text-charcoal leading-[1.02] mt-4 fade-up">
                <?= e($work['title']) ?>
            </h1>
        </div>
    </div>
</section>

<!-- Galería de imágenes -->
<section>
    <div class="max-w-6xl mx-auto px-6 lg:px-10">
        <?php
        $images = $work['images'] ?? [];
        if (empty($images)) {
            $images = ['/images/works/placeholder.jpg'];
        }
        ?>

        <!-- Imagen principal grande -->
        <div class="aspect-[16/10] bg-cream-2 mb-3 overflow-hidden">
            <?php if (!empty($images[0])): ?>
                <img id="main-img" src="<?= e($images[0]) ?>"
                     alt="<?= e($work['title']) ?>"
                     class="w-full h-full object-cover" />
            <?php else: ?>
                <div class="w-full h-full flex items-center justify-center text-stone font-mono text-xs">[imagen pendiente]</div>
            <?php endif; ?>
        </div>

        <!-- Thumbnails (si hay más de 1 imagen) -->
        <?php if (count($images) > 1): ?>
        <div class="grid grid-cols-4 md:grid-cols-6 gap-3 mt-3" role="list" aria-label="Imágenes de la obra">
            <?php foreach ($images as $i => $img): ?>
            <button role="listitem"
                    onclick="setMainImg(this, '<?= e($img) ?>');"
                    class="thumb-btn aspect-square bg-cream-2 overflow-hidden hover:opacity-80 transition-opacity ring-1 ring-transparent <?= $i === 0 ? 'ring-sage ring-offset-1' : '' ?>">
                <img src="<?= e($img) ?>" alt="Imagen <?= $i + 1 ?> de la obra" class="w-full h-full object-cover" loading="lazy" />
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Detalles + CTA -->
<section class="max-w-6xl mx-auto px-6 lg:px-10 py-20 lg:py-28">
    <div class="grid lg:grid-cols-12 gap-10 lg:gap-16">

        <!-- Descripción -->
        <div class="lg:col-span-7">
            <p class="eyebrow">Sobre la obra</p>
            <?php if (!empty($work['description'])): ?>
                <div class="mt-6 font-display text-2xl lg:text-3xl leading-[1.35] text-charcoal">
                    <?= nl2br(e($work['description'])) ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Ficha técnica + CTA -->
        <div class="lg:col-span-5 lg:border-l lg:border-border lg:pl-10">
            <p class="eyebrow mb-6">Ficha técnica</p>

            <dl class="space-y-5 text-sm">
                <?php if (!empty($work['materials'])): ?>
                <div class="grid grid-cols-3 gap-4 pb-4 border-b border-border">
                    <dt class="font-mono text-[10px] uppercase tracking-widest text-stone pt-1">Madera</dt>
                    <dd class="col-span-2 text-charcoal-2"><?= e($work['materials']) ?></dd>
                </div>
                <?php endif; ?>

                <?php if (!empty($work['dimensions'])): ?>
                <div class="grid grid-cols-3 gap-4 pb-4 border-b border-border">
                    <dt class="font-mono text-[10px] uppercase tracking-widest text-stone pt-1">Medidas</dt>
                    <dd class="col-span-2 text-charcoal-2"><?= e($work['dimensions']) ?></dd>
                </div>
                <?php endif; ?>

                <?php if (!empty($work['finish'])): ?>
                <div class="grid grid-cols-3 gap-4 pb-4 border-b border-border">
                    <dt class="font-mono text-[10px] uppercase tracking-widest text-stone pt-1">Acabado</dt>
                    <dd class="col-span-2 text-charcoal-2"><?= e($work['finish']) ?></dd>
                </div>
                <?php endif; ?>

                <?php if (!empty($work['year'])): ?>
                <div class="grid grid-cols-3 gap-4 pb-4 border-b border-border">
                    <dt class="font-mono text-[10px] uppercase tracking-widest text-stone pt-1">Año</dt>
                    <dd class="col-span-2 text-charcoal-2"><?= e(format_date($work['year'])) ?></dd>
                </div>
                <?php endif; ?>

                <?php if (!empty($work['client'])): ?>
                <div class="grid grid-cols-3 gap-4 pb-4 border-b border-border">
                    <dt class="font-mono text-[10px] uppercase tracking-widest text-stone pt-1">Encargo</dt>
                    <dd class="col-span-2 text-charcoal-2"><?= e($work['client']) ?></dd>
                </div>
                <?php endif; ?>
            </dl>

            <!-- CTA WhatsApp -->
            <div class="mt-10 p-6 bg-cream-2/60 border-l-2 border-sage">
                <p class="font-display text-xl text-charcoal leading-snug">
                    ¿Quieres una pieza similar?
                </p>
                <p class="text-warm text-sm mt-2 leading-relaxed">
                    Las piezas se hacen por encargo. Escríbeme y la adaptamos a tu espacio.
                </p>
                <a href="<?= e(whatsapp_link($wa_msg)) ?>" target="_blank" rel="noopener"
                   class="btn btn-primary mt-6 w-full">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413"/></svg>
                    Pedir similar por WhatsApp
                </a>
                <a href="/contacto.php" class="block text-center mt-3 text-sm text-warm hover:text-charcoal link-underline">
                    o enviar formulario de contacto
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Volver a trabajos -->
<section class="border-t border-border">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-12 flex justify-between items-center">
        <a href="/trabajos.php" class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-[0.2em] text-warm hover:text-charcoal transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            Ver todos los trabajos
        </a>
    </div>
</section>

<script>
function setMainImg(btn, src) {
    document.getElementById('main-img').src = src;
    document.querySelectorAll('.thumb-btn').forEach(b => {
        b.classList.remove('ring-sage', 'ring-offset-1');
        b.classList.add('ring-transparent');
    });
    btn.classList.remove('ring-transparent');
    btn.classList.add('ring-sage', 'ring-offset-1');
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
