<?php
/**
 * Generic inner page template — clean & themed
 */
get_header();

$parent_id = wp_get_post_parent_id(get_the_ID());
$has_content = !empty(trim(wp_strip_all_tags(get_the_content())));
?>

<?php
$parent_title = $parent_id ? get_the_title($parent_id) : '';
$title = get_the_title();
$subtitle = $parent_id ? "Part of {$parent_title}" : '';
get_template_part('template-parts/hero-inner');
?>

<!-- Content -->
<section class="section bg-surface">
    <div class="container-custom">
        <?php while (have_posts()): the_post(); ?>
            <?php if ($has_content): ?>
                <div class="max-w-5xl mx-auto prose-custom bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-12 reveal">
                    <?php echo wp_kses_post(aic_clean_colibri(get_the_content())); ?>
                </div>
            <?php else: ?>
                <div class="max-w-3xl mx-auto bg-white rounded-2xl border border-surface-300/60 p-12 lg:p-16 text-center reveal">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-surface-200 flex items-center justify-center">
                        <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2 class="text-heading text-ink mb-3">Coming soon</h2>
                    <p class="text-ink-muted max-w-sm mx-auto">This section is being prepared by the AIC 2026 organizing committee. Check back soon for updates.</p>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
