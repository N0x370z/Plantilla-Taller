<?php
require_once __DIR__ . '/includes/functions.php';
$works = array_slice(load_works(), 0, 4);  // 4 obras más recientes para el home
include __DIR__ . '/includes/header.php';
?>

<!-- ──────────────────────────────────────────────────────
     HERO — Tipografía protagonista, no banner típico
     ────────────────────────────────────────────────────── -->
<section class="max-w-6xl mx-auto px-6 lg:px-10 pt-16 lg:pt-24 pb-20">
    <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-end">

        <!-- Texto -->
        <div class="lg:col-span-7">
            <p class="eyebrow fade-up"><?= e(cfg('texts.home_hero_eyebrow')) ?></p>

            <h1 class="display font-display text-6xl sm:text-7xl lg:text-8xl xl:text-[8.5rem] font-medium text-charcoal mt-6 fade-up-2">
                <?= e(cfg('brand.name')) ?>
            </h1>

            <p class="mt-8 max-w-lg text-lg text-warm leading-relaxed fade-up-3">
                <?= e(cfg('brand.tagline')) ?>.
            </p>

            <div class="mt-10 flex flex-wrap gap-3 fade-up-4">
                <a href="/trabajos.php" class="btn btn-primary">
                    Ver trabajos
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="<?= e(whatsapp_link(cfg('whatsapp_messages.quote'))) ?>" target="_blank" rel="noopener" class="btn btn-outline">
                    Hablar por WhatsApp
                </a>
            </div>
        </div>

        <!-- Imagen featured (primera obra) -->
        <?php $featured = $works[0] ?? null; ?>
        <?php if ($featured): ?>
        <div class="lg:col-span-5 fade-up-3">
            <a href="/trabajo.php?slug=<?= e($featured['slug']) ?>" class="work-card block group">
                <div class="aspect-work work-image">
                    <?php if (!empty($featured['images'][0])): ?>
                        <img src="<?= e($featured['images'][0]) ?>"
                             alt="<?= e($featured['title']) ?>"
                             class="w-full h-full object-cover" />
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-stone font-mono text-xs">
                            [imagen pendiente]
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mt-4 flex items-baseline justify-between gap-4">
                    <div>
                        <p class="font-mono text-[10px] tracking-[0.2em] text-warm uppercase">Obra <?= e(work_number($featured['number'])) ?></p>
                        <h3 class="font-display text-xl text-charcoal mt-1 group-hover:text-sage transition-colors"><?= e($featured['title']) ?></h3>
                    </div>
                    <span class="font-mono text-xs text-stone"><?= e($featured['year'] ?? '') ?></span>
                </div>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- ──────────────────────────────────────────────────────
     INTRO — Manifiesto breve
     ────────────────────────────────────────────────────── -->
<section class="border-t border-border">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-20 lg:py-28">
        <div class="grid lg:grid-cols-12 gap-10">
            <div class="lg:col-span-3">
                <p class="eyebrow reveal">El taller</p>
            </div>
            <div class="lg:col-span-8 lg:col-start-5">
                <p class="font-display text-3xl lg:text-4xl xl:text-5xl leading-[1.15] text-charcoal reveal">
                    <?= e(cfg('texts.home_intro')) ?>
                </p>
                <a href="/nosotros.php" class="inline-flex items-center gap-2 mt-10 text-sm text-charcoal link-underline reveal">
                    Conoce más sobre el oficio
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ──────────────────────────────────────────────────────
     OBRAS RECIENTES — Layout editorial asimétrico
     ────────────────────────────────────────────────────── -->
<?php if (count($works) > 1): ?>
<section class="border-t border-border bg-cream-2/40 paper-texture">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-20 lg:py-28 relative">
        <div class="flex items-end justify-between mb-16 reveal">
            <div>
                <p class="eyebrow"><?= e(cfg('texts.home_works_eyebrow')) ?></p>
                <h2 class="font-display text-4xl lg:text-5xl font-medium text-charcoal mt-4 max-w-xl">
                    <?= e(cfg('texts.home_works_title')) ?>
                </h2>
            </div>
            <a href="/trabajos.php" class="hidden sm:inline-block font-mono text-xs uppercase tracking-[0.2em] text-warm hover:text-sage transition-colors">
                Ver todos →
            </a>
        </div>

        <!-- Grid editorial: alterna tamaños -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12">
            <?php foreach (array_slice($works, 1, 3) as $i => $work): ?>
                <?php
                // Variar el tamaño/columna para romper la cuadrícula
                $col_class = match($i) {
                    0 => 'md:col-span-7',
                    1 => 'md:col-span-5 md:mt-20',
                    2 => 'md:col-span-6 md:col-start-4',
                    default => 'md:col-span-6',
                };
                ?>
                <div class="<?= $col_class ?> reveal">
                    <a href="/trabajo.php?slug=<?= e($work['slug']) ?>" class="work-card block group">
                        <div class="aspect-work work-image">
                            <?php if (!empty($work['images'][0])): ?>
                                <img src="<?= e($work['images'][0]) ?>"
                                     alt="<?= e($work['title']) ?>"
                                     class="w-full h-full object-cover" />
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-stone font-mono text-xs">
                                    [imagen pendiente]
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mt-4 flex items-baseline justify-between gap-4">
                            <div>
                                <p class="font-mono text-[10px] tracking-[0.2em] text-warm uppercase">Obra <?= e(work_number($work['number'])) ?></p>
                                <h3 class="font-display text-xl text-charcoal mt-1 group-hover:text-sage transition-colors"><?= e($work['title']) ?></h3>
                                <?php if (!empty($work['materials'])): ?>
                                    <p class="text-sm text-warm mt-1"><?= e($work['materials']) ?></p>
                                <?php endif; ?>
                            </div>
                            <span class="font-mono text-xs text-stone whitespace-nowrap"><?= e($work['year'] ?? '') ?></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-12 text-center sm:hidden">
            <a href="/trabajos.php" class="font-mono text-xs uppercase tracking-[0.2em] text-warm">Ver todos los trabajos →</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ──────────────────────────────────────────────────────
     CTA Final
     ────────────────────────────────────────────────────── -->
<section class="border-t border-border">
    <div class="max-w-4xl mx-auto px-6 lg:px-10 py-24 lg:py-32 text-center reveal">
        <p class="eyebrow"><?= e(cfg('texts.contact_eyebrow')) ?></p>
        <h2 class="font-display text-4xl lg:text-6xl font-medium text-charcoal mt-6 leading-[1.05]">
            <?= e(cfg('texts.contact_title')) ?>
        </h2>
        <p class="mt-6 text-warm max-w-xl mx-auto leading-relaxed">
            <?= e(cfg('texts.contact_intro')) ?>
        </p>
        <div class="mt-10 flex flex-wrap gap-3 justify-center">
            <a href="/contacto.php" class="btn btn-primary">Enviar mensaje</a>
            <a href="<?= e(whatsapp_link(cfg('whatsapp_messages.quote'))) ?>" target="_blank" rel="noopener" class="btn btn-outline">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413"/></svg>
                WhatsApp directo
            </a>
        </div>
    </div>
</section>

<!-- Script para revelar elementos al hacer scroll -->
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
