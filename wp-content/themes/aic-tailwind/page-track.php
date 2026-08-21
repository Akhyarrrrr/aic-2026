<?php
/**
 * Template Name: Track Page
 * Track home page — overview with quick links to child pages (no speaker/committee duplication)
 */
get_header();

$slug = get_post_field('post_name');
$track_config = [
    'se'  => ['color' => '#F79007', 'name' => 'Sciences & Engineering', 'code' => 'AIC-SE'],
    'els' => ['color' => '#137622', 'name' => 'Environmental & Life Sciences', 'code' => 'AIC-ELS'],
    'ss'  => ['color' => '#AA39AF', 'name' => 'Social Sciences', 'code' => 'AIC-SS'],
];
$track = $track_config[$slug] ?? $track_config['se'];
$parent_id = get_the_ID();

$children_q = new WP_Query([
    'post_type'      => 'page',
    'post_parent'    => $parent_id,
    'posts_per_page' => 10,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
]);

$has_content = !empty(trim(wp_strip_all_tags(get_the_content())));

// Build quick links from child pages
$quick_links = [];
if ($children_q->have_posts()) {
    foreach ($children_q->posts as $cp) {
        $quick_links[] = [
            'title' => $cp->post_title,
            'url'   => get_permalink($cp->ID),
            'slug'  => $cp->post_name,
        ];
    }
}
wp_reset_postdata();

include get_template_directory() . '/template-parts/track-hero.php';
?>

<section class="section bg-surface">
    <div class="container-custom">
        <div class="grid lg:grid-cols-12 gap-12">

            <!-- Main -->
            <div class="lg:col-span-8 space-y-12">

                <!-- About / WP Content -->
                <?php if ($has_content): ?>
                <div class="prose-custom bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-12 reveal">
                    <?php while (have_posts()): the_post(); echo wp_kses_post(aic_clean_colibri(get_the_content())); endwhile; ?>
                </div>
                <?php endif; ?>

                <!-- Quick Links -->
                <?php if (!empty($quick_links)): ?>
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                        <h2 class="text-heading-lg text-ink">Explore <?php echo esc_html($track['code']); ?></h2>
                    </div>
                    <div class="grid sm:grid-cols-3 gap-5 reveal-stagger">
                        <?php foreach ($quick_links as $i => $ql):
                            $icons = [
                                'speaker' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
                                'committee' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>',
                                'book' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>',
                            ];
                            $icon = $icons['book'];
                            foreach ($icons as $k => $v) {
                                if (str_contains($ql['slug'], $k)) { $icon = $v; break; }
                            }
                        ?>
                        <a href="<?php echo esc_url($ql['url']); ?>" class="group relative bg-white rounded-2xl border border-surface-300/60 p-6 no-underline hover:-translate-y-1 hover:shadow-card-hover transition-all duration-300 overflow-hidden" style="--track-hover: <?php echo esc_attr($track['color']); ?>;">
                            <div class="absolute top-0 left-0 w-1 h-full transition-all duration-300 group-hover:w-1" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                            <div class="card-icon-bg w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background: <?php echo esc_attr($track['color']); ?>10;">
                                <svg class="card-svg w-6 h-6" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><?php echo $icon; ?></svg>
                            </div>
                            <h3 class="text-heading-sm text-ink font-semibold mb-1 transition-colors"><?php echo esc_html($ql['title']); ?></h3>
                            <p class="text-body-sm text-ink-muted"><?php echo esc_html($ql['title'] === 'Speaker' ? 'Meet our keynote and invited speakers' : ($ql['title'] === 'Committees' ? 'Our dedicated committee members' : 'Conference schedule and program')); ?></p>
                            <span class="inline-flex items-center gap-1 text-caption font-medium mt-4 transition-colors" style="color: <?php echo esc_attr($track['color']); ?>;">
                                Explore <?php echo esc_html($ql['title']); ?>
                                <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <?php include get_template_directory() . '/template-parts/track-sidebar.php'; ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
