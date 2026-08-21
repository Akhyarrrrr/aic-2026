</main><!-- #main-content -->

<!-- Back to Top -->
<button id="back-to-top" aria-label="Back to top">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
</button>

<footer class="bg-ink text-surface-300 pt-12 md:pt-16 pb-6 md:pb-8" role="contentinfo">
    <div class="container-custom">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-8 mb-10 md:mb-12">

            <!-- Brand -->
            <div class="md:col-span-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block mb-4 no-underline">
                    <span class="text-xl font-bold text-white tracking-tight">
                        AIC<span class="text-accent"> 2026</span>
                    </span>
                </a>
                <p class="text-surface-400 text-body-sm leading-relaxed max-w-sm">
                    The Annual International Conference, advancing research and innovation for a resilient, green, and inclusive future.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="md:col-span-4">
                <h4 class="text-white text-body-sm font-semibold mb-4 md:mb-4 uppercase tracking-wide">Conference</h4>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => 'space-y-3 md:space-y-2.5',
                    'fallback_cb'    => 'aic_fallback_footer_links',
                    'depth'          => 1,
                ]);
                ?>
            </div>

            <!-- Contact -->
            <div class="md:col-span-4">
                <h4 class="text-white text-body-sm font-semibold mb-4 md:mb-4 uppercase tracking-wide">Contact</h4>
                <ul class="space-y-4 md:space-y-3 text-body-sm text-surface-400">
                    <li class="flex items-start gap-3 md:gap-2.5">
                        <svg class="w-5 h-5 md:w-4 md:h-4 mt-0.5 shrink-0 text-surface-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Jl. Syech Abdurrauf, Kopelma Darussalam,<br>Banda Aceh, Indonesia</span>
                    </li>
                    <li class="flex items-center gap-3 md:gap-2.5">
                        <svg class="w-5 h-5 md:w-4 md:h-4 shrink-0 text-surface-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:aic@usk.ac.id" class="text-surface-300 hover:text-accent transition-colors no-underline">
                            aic@usk.ac.id
                        </a>
                    </li>
                    <li class="flex items-center gap-3 md:gap-2.5">
                        <svg class="w-5 h-5 md:w-4 md:h-4 shrink-0 text-surface-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:+6281360237363" class="text-surface-300 hover:text-accent transition-colors no-underline">
                            +62 813-6023-7363
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-surface-400/15 pt-6 md:pt-6 text-caption text-surface-500 text-center">
            <p>&copy; <?php echo date('Y'); ?> AIC, Universitas Syiah Kuala. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
