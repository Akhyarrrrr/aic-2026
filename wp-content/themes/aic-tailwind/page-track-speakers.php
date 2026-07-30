<?php
/**
 * Template Name: Track Speakers
 * Speakers grid for a specific track (keynote + invited)
 */
get_header();

$parent_id   = wp_get_post_parent_id(get_the_ID());
$slug        = $parent_id ? get_post_field('post_name', $parent_id) : get_post_field('post_name');
$track_config = [
    'se'  => ['color' => '#F79007', 'name' => 'Sciences & Engineering', 'code' => 'AIC-SE'],
    'els' => ['color' => '#137622', 'name' => 'Environmental & Life Sciences', 'code' => 'AIC-ELS'],
    'ss'  => ['color' => '#AA39AF', 'name' => 'Social Sciences', 'code' => 'AIC-SS'],
];
$track     = $track_config[$slug] ?? $track_config['se'];
$parent_id = $parent_id ?: get_the_ID();

$hero_title    = 'Speakers';
$hero_subtitle = "Keynote and invited speakers for " . $track['name'] . ".";

// Query speakers for this track
$speaker_q = new WP_Query([
    'post_type'      => 'speaker',
    'posts_per_page' => 20,
    'orderby'        => 'order_clause',
    'order'          => 'ASC',
    'meta_query'     => [
        'relation' => 'AND',
        'track_filter' => [
            'relation' => 'OR',
            ['key' => 'speaker_track', 'value' => $slug],
            ['key' => 'speaker_track', 'value' => 'all'],
        ],
        'order_clause' => ['key' => 'speaker_order', 'type' => 'NUMERIC'],
    ],
]);

$keynotes = [];
$invited  = [];

if ($speaker_q->have_posts()) {
    foreach ($speaker_q->posts as $sp) {
        $entry = [
            'id'    => $sp->ID,
            'name'  => $sp->post_title,
            'photo' => get_the_post_thumbnail_url($sp->ID, 'large'),
            'title' => get_field('speaker_title', $sp->ID) ?: '',
            'aff'   => get_field('speaker_affiliation', $sp->ID) ?: '',
            'url'   => get_permalink($sp->ID),
        ];
        if (get_field('speaker_is_keynote', $sp->ID)) {
            $keynotes[] = $entry;
        } else {
            $invited[] = $entry;
        }
    }
}
wp_reset_postdata();

include get_template_directory() . '/template-parts/track-hero.php';
?>

<section class="section bg-surface">
    <div class="container-custom">
        <div class="grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-8 space-y-16">

                <!-- Keynote -->
                <?php if (!empty($keynotes)): ?>
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                        <p class="text-body-sm font-semibold uppercase tracking-wider" style="color: <?php echo esc_attr($track['color']); ?>;">Keynote Speakers</p>
                    </div>
                    <h2 class="text-display-sm lg:text-display text-ink mb-8 text-balance">Voices that shape<br>this track</h2>
                    <div class="grid sm:grid-cols-2 gap-6 reveal-stagger">
                        <?php foreach ($keynotes as $kn): ?>
                        <a href="<?php echo esc_url($kn['url']); ?>" class="group block bg-white rounded-2xl border border-surface-300/60 overflow-hidden no-underline hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-surface-200 relative">
                                <?php if ($kn['photo']): ?>
                                    <img src="<?php echo esc_url($kn['photo']); ?>" alt="<?php echo esc_attr($kn['name']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-surface-100 to-surface-200">
                                        <svg class="w-20 h-20 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                    </div>
                                <?php endif; ?>
                                <span class="absolute top-3 left-3 inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-caption font-semibold text-white" style="background: <?php echo esc_attr($track['color']); ?>;">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    Keynote
                                </span>
                            </div>
                            <div class="p-5">
                                <h3 class="text-heading-sm text-ink font-semibold mb-1 transition-colors"><?php echo esc_html($kn['name']); ?></h3>
                                <?php if ($kn['title']): ?>
                                    <p class="text-body-sm font-medium truncate" style="color: <?php echo esc_attr($track['color']); ?>;"><?php echo esc_html($kn['title']); ?></p>
                                <?php endif; ?>
                                <?php if ($kn['aff']): ?>
                                    <p class="text-caption text-ink-subtle mt-1 truncate"><?php echo esc_html($kn['aff']); ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Invited -->
                <?php if (!empty($invited)): ?>
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                        <p class="text-body-sm font-semibold uppercase tracking-wider" style="color: <?php echo esc_attr($track['color']); ?>;">Invited Speakers</p>
                    </div>
                    <h2 class="text-display text-ink mb-8">Experts in focus</h2>
                    <div class="grid sm:grid-cols-2 gap-6 reveal-stagger">
                        <?php foreach ($invited as $sp): ?>
                        <a href="<?php echo esc_url($sp['url']); ?>" class="group block bg-white rounded-2xl border border-surface-200 overflow-hidden no-underline hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-300">
                            <div class="aspect-[3/4] overflow-hidden bg-surface-200">
                                <?php if ($sp['photo']): ?>
                                    <img src="<?php echo esc_url($sp['photo']); ?>" alt="<?php echo esc_attr($sp['name']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-surface-100 to-surface-200">
                                        <svg class="w-16 h-16 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="p-5">
                                <h3 class="text-heading-sm text-ink font-semibold mb-1 transition-colors"><?php echo esc_html($sp['name']); ?></h3>
                                <?php if ($sp['title']): ?>
                                    <p class="text-body-sm font-medium truncate" style="color: <?php echo esc_attr($track['color']); ?>;"><?php echo esc_html($sp['title']); ?></p>
                                <?php endif; ?>
                                <?php if ($sp['aff']): ?>
                                    <p class="text-caption text-ink-subtle mt-1 truncate"><?php echo esc_html($sp['aff']); ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Empty state -->
                <?php if (empty($keynotes) && empty($invited)): ?>
                <div class="bg-white rounded-2xl border border-surface-200 p-12 text-center reveal">
                    <div class="w-20 h-20 mx-auto mb-5 rounded-full flex items-center justify-center" style="background: <?php echo esc_attr($track['color']); ?>10;">
                        <svg class="w-10 h-10" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    </div>
                    <h3 class="text-heading text-ink mb-2">Speakers To Be Announced</h3>
                    <p class="text-body text-ink-muted max-w-md mx-auto">Speakers for <?php echo esc_html($track['name']); ?> will be announced soon. Please check back later for updates.</p>
                </div>
                <?php endif; ?>

            </div>

            <?php include get_template_directory() . '/template-parts/track-sidebar.php'; ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
