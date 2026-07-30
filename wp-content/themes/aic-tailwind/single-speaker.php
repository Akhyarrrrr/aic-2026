<?php
/**
 * Single Speaker detail page
 */
get_header();

$speaker_id  = get_the_ID();
$name        = get_the_title();
$photo       = get_the_post_thumbnail_url($speaker_id, 'large');
$bio         = get_the_content();
$speaker_title = get_field('speaker_title');
$affiliation   = get_field('speaker_affiliation');
$track_slug    = get_field('speaker_track');
$is_keynote    = get_field('speaker_is_keynote');

$track_color = aic_track_color($track_slug);
$track_name  = aic_track_name($track_slug);
$track_code  = aic_track_code($track_slug);
?>

<!-- Hero -->
<section class="relative pt-28 pb-12 md:pt-36 md:pb-20 overflow-hidden" style="background: <?php echo esc_attr($track_color ?: '#0D5F3A'); ?>;">
    <?php if ($track_color): ?>
    <div class="absolute inset-0 opacity-[0.05]" style="background-image: radial-gradient(circle at 70% 30%, #ffffff 1px, transparent 1px); background-size: 36px 36px;"></div>
    <?php endif; ?>
    <div class="container-custom relative z-10 reveal">
        <a href="<?php echo esc_url(home_url('/speaker/')); ?>" class="inline-flex items-center gap-1.5 text-white/60 hover:text-white text-body-sm no-underline transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            All Speakers
        </a>
        <?php if ($track_slug): ?>
        <span class="inline-block px-3 py-1 rounded-full text-caption font-semibold uppercase tracking-wider mb-4" style="background: rgba(255,255,255,0.15); color: #fff;">
            <?php echo esc_html($track_code); ?>
        </span>
        <?php endif; ?>
        <h1 class="text-display-lg text-white mb-3 text-balance"><?php echo esc_html($name); ?></h1>
        <?php if ($affiliation): ?>
        <p class="text-white/70 text-body-lg max-w-2xl"><?php echo esc_html($affiliation); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- Content -->
<section class="section bg-surface">
    <div class="container-custom">

        <!-- Photo + Info -->
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 mb-16 reveal">
            <div class="lg:col-span-5">
                <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-surface-200 shadow-card">
                    <?php if ($photo): ?>
                        <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($name); ?>" class="w-full h-full object-cover" loading="lazy">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="lg:col-span-7 flex flex-col justify-center">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <?php if ($track_slug): ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-caption font-semibold" style="background: <?php echo esc_attr($track_color); ?>15; color: <?php echo esc_attr($track_color); ?>;">
                        <?php echo esc_html($track_code); ?>
                    </span>
                    <?php endif; ?>
                    <?php if ($is_keynote): ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-caption font-semibold bg-accent/10 text-accent">
                        Keynote Speaker
                    </span>
                    <?php endif; ?>
                </div>

                <h2 class="text-display-sm text-ink mb-2"><?php echo esc_html($name); ?></h2>
                <?php if ($speaker_title): ?>
                <p class="text-body-lg font-medium mb-2" style="color: <?php echo esc_attr($track_color ?: '#0D5F3A'); ?>;"><?php echo esc_html($speaker_title); ?></p>
                <?php endif; ?>
                <?php if ($affiliation): ?>
                <p class="text-body text-ink-muted mb-6"><?php echo esc_html($affiliation); ?></p>
                <?php endif; ?>

                <?php if (!empty(trim($bio))): ?>
                <div class="border-t border-surface-300 pt-6">
                    <?php echo wp_kses_post(aic_clean_colibri($bio)); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Related speakers -->
        <?php
        $related = new WP_Query([
            'post_type'      => 'speaker',
            'posts_per_page' => 5,
            'post__not_in'   => [$speaker_id],
            'orderby'        => 'order_clause',
            'order'          => 'ASC',
            'meta_query'     => [
                'track_clause' => ['key' => 'speaker_track', 'value' => $track_slug],
                'order_clause' => ['key' => 'speaker_order', 'type' => 'NUMERIC'],
            ],
        ]);

        if ($related->have_posts()):
        ?>
        <div class="reveal">
            <div class="flex items-center gap-3 mb-8">
                <span class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track_color ?: '#0D5F3A'); ?>;"></span>
                <h3 class="text-heading-lg text-ink">More in <?php echo esc_html($track_name ?: 'this track'); ?></h3>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 lg:gap-6 reveal-stagger">
                <?php while ($related->have_posts()): $related->the_post();
                    $rel_id       = get_the_ID();
                    $rel_photo    = get_the_post_thumbnail_url($rel_id, 'medium_large');
                    $rel_title    = get_field('speaker_title');
                    $rel_aff      = get_field('speaker_affiliation');
                    $rel_keynote  = get_field('speaker_is_keynote');
                ?>
                <a href="<?php the_permalink(); ?>" class="group no-underline bg-white rounded-xl border border-surface-300/60 overflow-hidden transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5">
                    <div class="aspect-[3/4] overflow-hidden bg-surface-200">
                        <?php if ($rel_photo): ?>
                            <img src="<?php echo esc_url($rel_photo); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-surface-100 to-surface-200">
                                <svg class="w-12 h-12 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                            </div>
                        <?php endif; ?>
                        <?php if ($rel_keynote): ?>
                            <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-accent text-white">Keynote</span>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <h4 class="text-body-sm font-semibold text-ink mb-1 group-hover:text-primary transition-colors truncate"><?php the_title(); ?></h4>
                        <?php if ($rel_title): ?>
                            <p class="text-caption font-medium truncate" style="color: <?php echo esc_attr($track_color ?: '#0D5F3A'); ?>;"><?php echo esc_html($rel_title); ?></p>
                        <?php endif; ?>
                        <?php if ($rel_aff): ?>
                            <p class="text-caption text-ink-subtle truncate"><?php echo esc_html($rel_aff); ?></p>
                        <?php endif; ?>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
