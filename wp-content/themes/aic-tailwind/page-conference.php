<?php
/**
 * Template Name: Conference Hub
 * For the /conference/ landing page with child page cards
 */
get_header();

$parent_id = get_the_ID();
$child_pages_q = new WP_Query([
    'post_type'      => 'page',
    'post_parent'    => $parent_id,
    'posts_per_page' => 10,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
]);
$page_title = get_the_title();

// Collect child pages into array for custom ordering
$child_pages = [];
if ($child_pages_q->have_posts()) {
    foreach ($child_pages_q->posts as $cp) {
        $slug = $cp->post_name;
        $excerpt = !empty($cp->post_excerpt) ? $cp->post_excerpt : wp_trim_words(wp_strip_all_tags($cp->post_content), 18);
        $child_pages[$slug] = [
            'title'   => $cp->post_title,
            'url'     => get_permalink($cp->ID),
            'excerpt' => $excerpt,
            'slug'    => $slug,
        ];
    }
}
wp_reset_postdata();

// Custom display order
$display_order = ['registration-fee', 'paper-submission-publication', 'template'];

$icon_map = [
    'registration-fee'          => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07 1.757 4.242 0 .515-.769.697-1.676.697-2.591V6.75c0-.414-.336-.75-.75-.75H10.5a.75.75 0 00-.75.75v6.432z"/></svg>',
    'template'                  => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>',
    'paper-submission-publication' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>',
];
?>

<?php
$title    = $page_title;
$subtitle = 'Information about registration, templates, submission, and publication for AIC 2026.';
get_template_part('template-parts/hero-inner');
?>

<!-- Child pages -->
<section class="section bg-surface">
    <div class="container-custom">
        <?php if (!empty($child_pages)): ?>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 reveal-stagger">
            <?php $loop_i = 0; foreach ($display_order as $slug):
                if (empty($child_pages[$slug])) continue;
                $cp = $child_pages[$slug];
                $num = str_pad($loop_i + 1, 2, '0', STR_PAD_LEFT);
                $loop_i++;
                $icon = $icon_map[$slug] ?? '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>';
            ?>
            <a href="<?php echo esc_url($cp['url']); ?>" class="group block bg-white rounded-2xl border border-surface-300/60 overflow-hidden no-underline hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-300">
                <div class="p-8 lg:p-10">
                    <!-- Number + Icon -->
                    <div class="flex items-start justify-between mb-6">
                        <span class="text-display-sm font-bold text-surface-300"><?php echo $num; ?></span>
                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center group-hover:bg-primary/15 transition-colors">
                            <?php echo $icon; ?>
                        </div>
                    </div>
                    <!-- Title -->
                    <h3 class="text-heading text-ink font-semibold mb-3 group-hover:text-primary transition-colors"><?php echo esc_html($cp['title']); ?></h3>
                    <!-- Description -->
                    <?php if ($cp['excerpt']): ?>
                        <p class="text-body-sm text-ink-muted leading-relaxed mb-6"><?php echo esc_html($cp['excerpt']); ?></p>
                    <?php endif; ?>
                    <!-- Link -->
                    <span class="inline-flex items-center gap-1.5 text-body-sm font-medium text-primary">
                        Learn more
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="max-w-3xl mx-auto text-center py-16 reveal">
            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-surface-200 flex items-center justify-center">
                <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h2 class="text-heading text-ink mb-3">Coming soon</h2>
            <p class="text-ink-muted">Conference information is being prepared. Check back soon.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
