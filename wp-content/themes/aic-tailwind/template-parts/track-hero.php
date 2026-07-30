<?php
/**
 * Track hero section
 * Expects: $track (color, name, code, slug)
 *          $hero_title (optional)
 *          $hero_subtitle (optional)
 */
$hero_title     = $hero_title ?? $track['name'];
$hero_subtitle  = $hero_subtitle ?? "Latest research and innovations in " . strtolower($track['name']) . ".";

$track_bg = [
    'se'  => 'https://images.pexels.com/photos/14373427/pexels-photo-14373427.jpeg?auto=compress&cs=tinysrgb&w=1600',
    'els' => 'https://images.pexels.com/photos/2336788/pexels-photo-2336788.jpeg?auto=compress&cs=tinysrgb&w=1600',
    'ss'  => 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1600',
];
// $track['code'] is like 'AIC-SE', extract the part after '-'
$track_slug = strtolower(substr($track['code'], strpos($track['code'], '-') + 1));
$hero_img_url   = $track_bg[$track_slug] ?? null;
?>
<section class="relative pt-28 pb-16 md:pt-36 md:pb-20 bg-primary overflow-hidden">
    <?php if ($hero_img_url): ?>
    <div class="absolute inset-0">
        <img src="<?php echo esc_url($hero_img_url); ?>" alt="" class="w-full h-full object-cover opacity-40" loading="lazy">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, <?php echo esc_attr($track['color']); ?>a6, <?php echo esc_attr($track['color']); ?>66 50%, <?php echo esc_attr($track['color']); ?>4d);"></div>
    </div>
    <?php else: ?>
    <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 70% 30%, #C7982C 1px, transparent 1px); background-size: 36px 36px;"></div>
    <?php endif; ?>
    <div class="container-custom relative z-10">
        <div class="flex items-center gap-3 mb-4 reveal">
            <span class="inline-block px-3 py-1 rounded-full text-caption font-semibold uppercase tracking-wider" style="background: rgba(255,255,255,0.2); color: #fff;"><?php echo esc_html($track['code']); ?></span>
        </div>
        <h1 class="text-display-lg text-white mb-4 text-balance reveal" style="transition-delay: 80ms;"><?php echo esc_html($hero_title); ?></h1>
        <p class="text-surface-400 text-body-lg max-w-2xl reveal" style="transition-delay: 160ms;"><?php echo esc_html($hero_subtitle); ?></p>
    </div>
</section>
