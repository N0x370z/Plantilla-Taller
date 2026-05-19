</main>

<?php include __DIR__ . '/whatsapp-float.php'; ?>

<footer class="border-t border-border bg-cream-2 text-charcoal mt-20">
    <div class="max-w-6xl mx-auto px-6 lg:px-10 py-16">
        <div class="grid md:grid-cols-12 gap-10">

            <!-- Brand -->
            <div class="md:col-span-5">
                <h3 class="font-display text-3xl font-medium tracking-tight"><?= e(cfg('brand.name')) ?></h3>
                <p class="font-mono text-[10px] tracking-[0.2em] text-warm uppercase mt-1">Est. <?= e(cfg('brand.founded')) ?> · <?= e(cfg('contact.address.city')) ?></p>
                <p class="mt-6 text-warm leading-relaxed max-w-md text-sm"><?= e(cfg('brand.description')) ?></p>
            </div>

            <!-- Navegación -->
            <div class="md:col-span-3">
                <h4 class="font-mono text-[10px] tracking-[0.2em] text-warm uppercase mb-4">Navegación</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="/" class="hover:text-sage transition-colors">Inicio</a></li>
                    <li><a href="/trabajos.php" class="hover:text-sage transition-colors">Trabajos</a></li>
                    <li><a href="/nosotros.php" class="hover:text-sage transition-colors">Sobre el oficio</a></li>
                    <li><a href="/contacto.php" class="hover:text-sage transition-colors">Contacto</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div class="md:col-span-4">
                <h4 class="font-mono text-[10px] tracking-[0.2em] text-warm uppercase mb-4">Contacto</h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="tel:<?= e(cfg('contact.phone_link')) ?>" class="hover:text-sage transition-colors">
                            <?= e(cfg('contact.phone')) ?>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?= e(cfg('contact.email')) ?>" class="hover:text-sage transition-colors break-all">
                            <?= e(cfg('contact.email')) ?>
                        </a>
                    </li>
                    <li class="text-warm">
                        <?= e(cfg('contact.address.street')) ?>, <?= e(cfg('contact.address.colony')) ?><br />
                        <?= e(cfg('contact.address.city')) ?>, <?= e(cfg('contact.address.state')) ?>
                    </li>
                </ul>

                <!-- Redes sociales -->
                <?php
                $socials = array_filter([
                    'Instagram' => cfg('social.instagram'),
                    'Facebook'  => cfg('social.facebook'),
                    'TikTok'    => cfg('social.tiktok'),
                    'Pinterest' => cfg('social.pinterest'),
                ]);
                ?>
                <?php if (!empty($socials)): ?>
                <div class="flex gap-4 mt-6">
                    <?php foreach ($socials as $name => $url): ?>
                        <a href="<?= e($url) ?>" target="_blank" rel="noopener noreferrer"
                           aria-label="<?= e(cfg('brand.name')) ?> en <?= e($name) ?>"
                           class="text-warm hover:text-sage transition-colors text-xs uppercase tracking-widest font-mono">
                            <?= e($name) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-border flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <p class="font-mono text-[11px] text-warm">
                © <?= date('Y') ?> <?= e(cfg('brand.name')) ?>. Todos los derechos reservados.
            </p>
            <p class="font-mono text-[11px] text-stone">
                Hecho a mano · <?= e(cfg('contact.address.city')) ?>
            </p>
        </div>
    </div>
</footer>

</body>
</html>
