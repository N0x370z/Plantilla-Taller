<?php require_once __DIR__ . '/functions.php'; ?>

<nav class="border-b border-border bg-cream/95 backdrop-blur-sm sticky top-0 z-30">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 flex items-center justify-between h-20">

        <!-- Logo / Marca -->
        <a href="/" class="flex flex-col leading-none">
            <span class="font-display text-2xl font-medium tracking-tight text-charcoal"><?= e(cfg('brand.name')) ?></span>
            <span class="font-mono text-[10px] tracking-[0.2em] text-warm uppercase mt-0.5">Est. <?= e(cfg('brand.founded')) ?></span>
        </a>

        <!-- Nav links -->
        <ul class="hidden md:flex items-center gap-9 font-body text-sm">
            <?php
            $links = [
                '/' => 'Inicio',
                '/trabajos.php' => 'Trabajos',
                '/nosotros.php' => 'Sobre el oficio',
                '/contacto.php' => 'Contacto',
            ];
            foreach ($links as $href => $label):
                $active = is_current($href);
            ?>
            <li>
                <a href="<?= e($href) ?>"
                   class="<?= $active ? 'text-charcoal font-medium' : 'text-warm hover:text-charcoal' ?> transition-colors duration-200">
                    <?= e($label) ?>
                    <?php if ($active): ?>
                        <span class="block h-px bg-sage mt-1 w-full"></span>
                    <?php endif; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>

        <!-- WhatsApp CTA desktop -->
        <a href="<?= e(whatsapp_link(cfg('whatsapp_messages.general'))) ?>"
           target="_blank" rel="noopener"
           class="hidden md:inline-flex items-center gap-2 text-sm font-medium text-charcoal hover:text-sage transition-colors">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413"/>
            </svg>
            <span>WhatsApp</span>
        </a>

        <!-- Botón menú móvil -->
        <button id="mobile-menu-btn" class="md:hidden p-2 text-charcoal" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu">
            <svg id="icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Menú móvil (oculto por defecto) -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-border bg-cream">
        <ul class="px-6 py-4 flex flex-col gap-1">
            <?php foreach ($links as $href => $label):
                $active = is_current($href);
            ?>
            <li>
                <a href="<?= e($href) ?>"
                   class="block py-3 font-body text-base <?= $active ? 'text-charcoal font-medium' : 'text-warm' ?>">
                    <?= e($label) ?>
                </a>
            </li>
            <?php endforeach; ?>
            <li class="pt-3 mt-3 border-t border-border">
                <a href="<?= e(whatsapp_link(cfg('whatsapp_messages.general'))) ?>"
                   target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 text-sage font-medium">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413"/></svg>
                    Hablar por WhatsApp
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
  // Toggle menú móvil con gestión de aria-expanded
  (function () {
    const btn  = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const iconOpen  = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');
    if (!btn || !menu) return;
    btn.addEventListener('click', () => {
      const expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!expanded));
      btn.setAttribute('aria-label', expanded ? 'Abrir menú' : 'Cerrar menú');
      menu.classList.toggle('hidden');
      iconOpen.classList.toggle('hidden');
      iconClose.classList.toggle('hidden');
    });
  })();
</script>
