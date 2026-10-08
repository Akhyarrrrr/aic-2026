<?php
/**
 * Inner Page Hero — reusable hero banner for all inner pages.
 *
 * Usage:
 *   get_template_part('template-parts/hero-inner', null, [
 *       'title' => 'Call for Paper',
 *       'subtitle' => 'Submit your research...',
 *   ]);
 * Optional arguments: track_slug, track_color, hero_img_id, hero_img_url.
 */
if (!defined('ABSPATH')) exit;
$title         = $args['title'] ?? (!empty($title) ? $title : get_the_title());
$subtitle      = $args['subtitle'] ?? ($subtitle ?? '');
$track_slug    = $args['track_slug'] ?? ($track_slug ?? '');
$track_color   = $args['track_color'] ?? ($track_color ?? '');
$hero_img_id   = $args['hero_img_id'] ?? ($hero_img_id ?? 5578);
$hero_img_url  = $args['hero_img_url'] ?? ($hero_img_url ?? '');

$default_bg = content_url('uploads/2026/07/conference-hero.jpg');

if ($track_slug && !$track_color) {
    $track_color = aic_track_color($track_slug);
}

$hero_bg = $hero_img_url ?: (wp_get_attachment_image_url($hero_img_id, 'full') ?: $default_bg);
?>
<section class="relative pt-28 pb-16 md:pt-36 md:pb-24 bg-primary overflow-hidden">
    <!-- Background photo with overlay -->
    <?php if ($hero_bg): ?>
    <div class="absolute inset-0">
        <img src="<?php echo esc_url($hero_bg); ?>" alt="" class="w-full h-full object-cover opacity-35" loading="eager">
    </div>
    <?php endif; ?>
    <!-- Gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/50 to-primary/70"></div>
    <!-- Dot pattern -->
    <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 70% 30%, #C7982C 1px, transparent 1px); background-size: 36px 36px;"></div>

    <div class="container-custom relative z-10 reveal">
        <?php if ($track_slug): ?>
            <span class="inline-block px-3 py-1 rounded-lg text-caption font-semibold mb-4" style="background: <?php echo esc_attr($track_color); ?>; color: <?php echo esc_attr(aic_track_foreground($track_slug)); ?>;">
                <?php echo esc_html(aic_track_code($track_slug)); ?>
            </span>
        <?php endif; ?>

        <h1 class="text-display-lg text-white mb-3 text-balance"><?php echo esc_html($title); ?></h1>

        <?php if ($subtitle): ?>
            <p class="text-surface-400 text-body-lg max-w-2xl"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>
    </div>
</section>
