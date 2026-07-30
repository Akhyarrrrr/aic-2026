<?php
/**
 * CTA Banner — full-width call-to-action with green gradient background.
 *
 * Usage:
 *   $title          = 'Ready to Submit?';      // required
 *   $description    = 'Join researchers…';      // required
 *   $primary_label  = 'Submit Abstract';        // required
 *   $primary_url    = '/call-for-paper/';       // required
 *   $secondary_label = 'Learn More';            // optional — shows secondary button
 *   $secondary_url   = '/about/';               // optional — secondary button link
 *   include get_template_directory() . '/template-parts/cta-banner.php';
 */
if (!defined('ABSPATH')) exit;
if (!isset($title) || !isset($description) || !isset($primary_label) || !isset($primary_url)) return;

$secondary_label = $secondary_label ?? '';
$secondary_url   = $secondary_url   ?? '';
?>
<section class="section">
    <div class="container-custom reveal">
        <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-primary via-primary-light to-primary-dark p-10 md:p-16 text-center">
            <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 70% 30%, #C7982C 1px, transparent 1px); background-size: 36px 36px;"></div>

            <div class="relative z-10">
                <h2 class="text-display-sm md:text-display text-white mb-3 text-balance"><?php echo esc_html($title); ?></h2>
                <p class="text-surface-400 text-body-lg max-w-xl mx-auto mb-8"><?php echo esc_html($description); ?></p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="<?php echo esc_url($primary_url); ?>" class="btn-accent btn-lg no-underline">
                        <?php echo esc_html($primary_label); ?>
                    </a>

                    <?php if ($secondary_label && $secondary_url): ?>
                        <a href="<?php echo esc_url($secondary_url); ?>" class="btn border-2 border-white/60 text-white px-8 py-4 text-body hover:bg-white/10 active:scale-[0.98] no-underline">
                            <?php echo esc_html($secondary_label); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
