<?php
require_once __DIR__ . '/includes/functions.php';
$works = load_works();
$page_title = 'Trabajos';
$page_description = 'Galería completa de muebles a la medida hechos en ' . cfg('brand.name') . '.';
include __DIR__ . '/includes/header.php';
?>

<!-- Header de la página -->
<section class="max-w-6xl mx-auto px-6 lg:px-10 pt-16 lg:pt-24 pb-16 lg:pb-20">
    <div class="grid lg:grid-cols-12 gap-10 items-end">
        <div class="lg:col-span-8">
            <p class="eyebrow fade-up">Archivo del taller</p>
            <h1 class="display font-display text-5xl sm:text-6xl lg:text-7xl font-medium text-charcoal mt-6 fade-up-2">
                Trabajos
            </h1>
        </div>
        <div class="lg:col-span-4 fade-up-3">
            <p class="text-warm leading-relaxed text-sm lg:text-base">
                Cada obra es un encargo único. Aquí están las piezas más recientes que han salido del taller, ordenadas de la más nueva a la más antigua.
            </p>
            <p class="font-mono text-xs text-stone uppercase tracking-[0.2em] mt-4">
                <?= count($works) ?> <?= count($works) === 1 ? 'obra' : 'obras' ?> registradas
            </p>
        </div>
    </div>
</section>

<!-- Lista de obras: feed vertical editorial -->
<section class="border-t border-border">
    <div class="max-w-6xl mx-auto px-6 lg:px-10">
        <?php if (empty($works)): ?>
            <div class="py-32 text-center">
                <p class="text-warm">Aún no hay obras publicadas en el archivo.</p>
            </div>
        <?php else: ?>
            <ul class="divide-y divide-border">
                <?php foreach ($works as $i => $work):
                    $is_even = $i % 2 === 0;
                ?>
                <li class="py-14 lg:py-20 reveal">
                    <a href="/trabajo.php?slug=<?= e($work['slug']) ?>" class="work-card block group">
                        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                            <!-- Imagen — alterna lado izquierdo/derecho -->
                            <div class="lg:col-span-7 <?= $is_even ? '' : 'lg:order-2' ?>">
                                <div class="aspect-work work-image">
                                    <?php if (!empty($work['images'][0])): ?>
                                        <img src="<?= e($work['images'][0]) ?>"
                                             alt="<?= e($work['title']) ?>"
                                             class="w-full h-full object-cover"
                                             loading="lazy" />
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-stone font-mono text-xs">
                                            [imagen pendiente]
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Texto -->
                            <div class="lg:col-span-5 <?= $is_even ? '' : 'lg:order-1' ?>">
                                <div class="flex items-baseline justify-between mb-4">
                                    <p class="font-mono text-[10px] tracking-[0.25em] text-warm uppercase">
                                        Obra <?= e(work_number($work['number'])) ?>
                                    </p>
                                    <span class="font-mono text-xs text-stone"><?= e($work['year'] ?? '') ?></span>
                                </div>
                                <h2 class="font-display text-3xl lg:text-4xl font-medium text-charcoal leading-tight group-hover:text-sage transition-colors">
                                    <?= e($work['title']) ?>
                                </h2>
                                <?php if (!empty($work['description'])): ?>
                                    <p class="mt-5 text-warm leading-relaxed line-clamp-4">
                                        <?= e($work['description']) ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($work['materials']) || !empty($work['dimensions'])): ?>
                                <dl class="mt-6 space-y-1 text-sm">
                                    <?php if (!empty($work['materials'])): ?>
                                    <div class="flex gap-3">
                                        <dt class="font-mono text-[10px] uppercase tracking-widest text-stone w-20 shrink-0 pt-0.5">Madera</dt>
                                        <dd class="text-charcoal-2"><?= e($work['materials']) ?></dd>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($work['dimensions'])): ?>
                                    <div class="flex gap-3">
                                        <dt class="font-mono text-[10px] uppercase tracking-widest text-stone w-20 shrink-0 pt-0.5">Medidas</dt>
                                        <dd class="text-charcoal-2"><?= e($work['dimensions']) ?></dd>
                                    </div>
                                    <?php endif; ?>
                                </dl>
                                <?php endif; ?>

                                <span class="inline-flex items-center gap-2 mt-8 font-mono text-xs uppercase tracking-[0.2em] text-charcoal group-hover:text-sage transition-colors">
                                    Ver detalle
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>

<!-- CTA al final -->
<section class="border-t border-border bg-cream-2/40">
    <div class="max-w-4xl mx-auto px-6 lg:px-10 py-24 text-center">
        <p class="eyebrow">¿Te interesa algo similar?</p>
        <h2 class="font-display text-3xl lg:text-5xl font-medium text-charcoal mt-6">
            Cada pieza empieza con una conversación.
        </h2>
        <div class="mt-10 flex flex-wrap gap-3 justify-center">
            <a href="<?= e(whatsapp_link(cfg('whatsapp_messages.quote'))) ?>" target="_blank" rel="noopener" class="btn btn-primary">
                Hablar por WhatsApp
            </a>
            <a href="/contacto.php" class="btn btn-outline">Enviar mensaje</a>
        </div>
    </div>
</section>

<script>
(function() {
    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
        return;
    }
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
})();
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
