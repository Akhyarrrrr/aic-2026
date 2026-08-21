<?php
/**
 * Speaker Card — reusable component
 * Usage: include template-parts/speaker-card.php with $speaker_id set
 */
if (!isset($speaker_id)) return;

$name       = get_the_title($speaker_id);
$photo      = get_the_post_thumbnail_url($speaker_id, 'medium_large');
$bio        = get_the_excerpt($speaker_id) ?: wp_trim_words(wp_strip_all_tags(get_post_field('post_content', $speaker_id)), 30);
$title      = get_field('speaker_title', $speaker_id);
$affiliation= get_field('speaker_affiliation', $speaker_id);
$track      = get_field('speaker_track', $speaker_id);
$is_keynote = get_field('speaker_is_keynote', $speaker_id);
$permalink  = get_permalink($speaker_id);

$track_colors = [
    'se'  => '#F79007',
    'els' => '#137622',
    'ss'  => '#AA39AF',
];
$track_color = $track_colors[$track] ?? '#0D5F3A';
?>
<div class="card-interactive rounded-2xl overflow-hidden group reveal">
    <div class="relative overflow-hidden aspect-[3/4] bg-surface-200">
        <?php if ($photo): ?>
            <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($name); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-20 h-20 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
            </div>
        <?php endif; ?>
        <?php if ($is_keynote): ?>
            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-caption font-semibold bg-accent text-white">Keynote</span>
        <?php endif; ?>
    </div>
    <div class="p-5">
        <h3 class="text-heading-sm text-ink font-semibold mb-1 group-hover:text-primary transition-colors">
            <a href="<?php echo esc_url($permalink); ?>" class="no-underline text-inherit"><?php echo esc_html($name); ?></a>
        </h3>
        <?php if ($title): ?>
            <p class="text-body-sm text-ink-muted font-medium"><?php echo esc_html($title); ?></p>
        <?php endif; ?>
        <?php if ($affiliation): ?>
            <p class="text-caption text-ink-subtle mt-1"><?php echo esc_html($affiliation); ?></p>
        <?php endif; ?>
        <?php if ($bio): ?>
            <p class="text-caption text-ink-muted mt-3 line-clamp-2"><?php echo esc_html($bio); ?></p>
        <?php endif; ?>
    </div>
</div>
