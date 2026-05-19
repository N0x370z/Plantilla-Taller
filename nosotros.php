<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Sobre el oficio';
$page_description = 'Conoce al artesano y la filosofía detrás de ' . cfg('brand.name');
include __DIR__ . '/includes/header.php';
?>

<!-- Cabecera -->
<section class="max-w-6xl mx-auto px-6 lg:px-10 pt-16 lg:pt-24 pb-16">
    <div class="grid lg:grid-cols-12 gap-10">
        <div class="lg:col-span-8 lg:col-start-3 text-center lg:text-left">
            <p class="eyebrow fade-up"><?= e(cfg('texts.about_eyebrow')) ?></p>
            <h1 class="display font-display text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-medium text-charcoal mt-6 leading-[1.05] fade-up-2">
                <?= e(cfg('texts.about_title_1')) ?> <span class="italic text-sage"><?= e(cfg('texts.about_title_2')) ?></span>
            </h1>
        </div>
    </div>
</section>

<!-- Sección 1: Foto + texto introductorio -->
<section class="border-t border-border">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-20 lg:py-28">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-16 items-center">

            <!-- Foto del artesano -->
            <div class="lg:col-span-5 reveal">
                <div class="aspect-[4/5] bg-cream-2 overflow-hidden">
                    <img src="/images/ui/about-portrait.jpg"
                         alt="<?= e(cfg('brand.maker_name')) ?> en su taller"
                         onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-stone font-mono text-xs\'>[retrato del artesano]</div>';"
                         class="w-full h-full object-cover" />
                </div>
                <p class="font-mono text-[10px] tracking-[0.2em] text-warm uppercase mt-4">
                    <?= e(cfg('brand.maker_name')) ?> · Taller propio en <?= e(cfg('contact.address.city')) ?>
                </p>
            </div>

            <!-- Texto -->
            <div class="lg:col-span-7 reveal">
                <p class="eyebrow">El maestro</p>
                <h2 class="font-display text-3xl lg:text-4xl text-charcoal mt-6 leading-tight">
                    Llevo más de <?= date('Y') - (int)cfg('brand.founded') ?> años haciendo muebles para gente que los va a vivir.
                </h2>
                <div class="mt-8 space-y-5 text-warm leading-relaxed text-[15px]">
                    <p>
                        Empecé en este oficio porque me molestaba la idea de que un mueble fuera desechable. Hoy en día puedes comprar una sala que se desarma en dos años, una mesa que se hincha al primer derrame de agua, una silla que se cae a pedazos. Eso no es mobiliario. Eso es decoración temporal.
                    </p>
                    <p>
                        Cada pieza que sale del taller la diseño con quien la va a usar. Hablamos del espacio, del estilo de vida, de cómo lo van a usar de verdad — no del Instagram. Después selecciono la madera, hago el plano, y empiezo a construir. Sin prisa. Sin atajos.
                    </p>
                    <p>
                        Si está bien hecho, un mueble dura tres generaciones. Esa es la única medida que me importa.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección 2: Valores / proceso en grid -->
<section class="border-t border-border bg-cream-2/40 paper-texture">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-20 lg:py-28 relative">
        <div class="text-center mb-16 reveal">
            <p class="eyebrow">Cómo trabajo</p>
            <h2 class="font-display text-4xl lg:text-5xl font-medium text-charcoal mt-6 max-w-2xl mx-auto leading-tight">
                Tres principios que no se negocian.
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-10 lg:gap-16">
            <!-- Principio 1 -->
            <div class="reveal">
                <p class="font-mono text-[10px] tracking-[0.25em] text-sage uppercase mb-3">01</p>
                <h3 class="font-display text-2xl text-charcoal leading-snug">Madera, no aglomerado.</h3>
                <p class="mt-4 text-warm leading-relaxed text-[15px]">
                    Trabajo con maderas macizas seleccionadas: pino, encino, cedro, parota, nogal. Cada una pide un tratamiento distinto. Ninguna se reemplaza por MDF o melamina para abaratar costos.
                </p>
            </div>

            <!-- Principio 2 -->
            <div class="reveal">
                <p class="font-mono text-[10px] tracking-[0.25em] text-sage uppercase mb-3">02</p>
                <h3 class="font-display text-2xl text-charcoal leading-snug">Ensambles de carpintería.</h3>
                <p class="mt-4 text-warm leading-relaxed text-[15px]">
                    Cola de milano, espiga, caja y espiga. Lo que se usaba antes de que los clavos y la cola industrial decidieran todo. Toma más tiempo. Aguanta décadas más.
                </p>
            </div>

            <!-- Principio 3 -->
            <div class="reveal">
                <p class="font-mono text-[10px] tracking-[0.25em] text-sage uppercase mb-3">03</p>
                <h3 class="font-display text-2xl text-charcoal leading-snug">A la medida real.</h3>
                <p class="mt-4 text-warm leading-relaxed text-[15px]">
                    Voy al espacio donde va a vivir el mueble antes de empezar a construir. Reviso medidas, luz, paso. El mueble se diseña para ese lugar, no se adapta al lugar después.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Sección 3: Proceso paso a paso -->
<section class="border-t border-border">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-20 lg:py-28">
        <div class="grid lg:grid-cols-12 gap-10">
            <div class="lg:col-span-4">
                <p class="eyebrow reveal">El proceso</p>
                <h2 class="font-display text-4xl lg:text-5xl text-charcoal mt-6 leading-tight reveal">
                    De la idea al taller.
                </h2>
                <p class="mt-6 text-warm reveal">
                    Así se ve trabajar conmigo, desde la primera conversación hasta la entrega.
                </p>
            </div>

            <div class="lg:col-span-7 lg:col-start-6">
                <ol class="space-y-10">
                    <li class="grid grid-cols-12 gap-4 reveal">
                        <div class="col-span-2"><span class="font-display text-4xl text-sage">01</span></div>
                        <div class="col-span-10">
                            <h3 class="font-display text-xl text-charcoal">Conversamos</h3>
                            <p class="mt-2 text-warm text-[15px] leading-relaxed">Por WhatsApp, llamada o visita. Me cuentas qué necesitas, para qué, dónde va. Sin compromiso. Sin cotizar a ciegas.</p>
                        </div>
                    </li>
                    <li class="grid grid-cols-12 gap-4 reveal">
                        <div class="col-span-2"><span class="font-display text-4xl text-sage">02</span></div>
                        <div class="col-span-10">
                            <h3 class="font-display text-xl text-charcoal">Diseño y cotizo</h3>
                            <p class="mt-2 text-warm text-[15px] leading-relaxed">Te paso un boceto, una propuesta de madera y acabado, y un costo cerrado. No hay sorpresas a medio camino.</p>
                        </div>
                    </li>
                    <li class="grid grid-cols-12 gap-4 reveal">
                        <div class="col-span-2"><span class="font-display text-4xl text-sage">03</span></div>
                        <div class="col-span-10">
                            <h3 class="font-display text-xl text-charcoal">Construyo</h3>
                            <p class="mt-2 text-warm text-[15px] leading-relaxed">Empiezo con un anticipo del 50%. Tiempo de fabricación: entre 3 y 8 semanas según pieza. Te mando fotos del avance.</p>
                        </div>
                    </li>
                    <li class="grid grid-cols-12 gap-4 reveal">
                        <div class="col-span-2"><span class="font-display text-4xl text-sage">04</span></div>
                        <div class="col-span-10">
                            <h3 class="font-display text-xl text-charcoal">Entrego e instalo</h3>
                            <p class="mt-2 text-warm text-[15px] leading-relaxed">Llevo el mueble a tu casa y lo armo en sitio. Si algo no encaja perfecto, se queda hasta que sí.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="border-t border-border bg-charcoal text-cream">
    <div class="max-w-4xl mx-auto px-6 lg:px-10 py-24 lg:py-32 text-center reveal">
        <p class="font-mono text-[10px] tracking-[0.25em] uppercase text-sage-2">¿Empezamos?</p>
        <h2 class="font-display text-4xl lg:text-6xl font-medium mt-6 leading-[1.05]">
            Cuéntame qué tienes en mente.
        </h2>
        <p class="mt-6 text-cream/70 max-w-xl mx-auto leading-relaxed">
            Sin compromiso. Una conversación de 10 minutos por WhatsApp suele bastar para saber si lo que buscas tiene sentido.
        </p>
        <div class="mt-10 flex flex-wrap gap-3 justify-center">
            <a href="<?= e(whatsapp_link(cfg('whatsapp_messages.quote'))) ?>" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 bg-sage text-cream px-7 py-3.5 font-medium text-sm hover:bg-cream hover:text-charcoal transition-colors">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413"/></svg>
                Hablar por WhatsApp
            </a>
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
