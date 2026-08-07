<?php
/**
 * Template Name: All Speakers
 * Keynote (4) + Invited (6) — all shown on one page
 */
get_header();
?>

<?php
$title    = 'Speakers';
$subtitle = 'Keynote and invited speakers across all three conference tracks.';
get_template_part('template-parts/hero-inner');
?>

<?php
$track_info = [
    'se'  => ['name' => 'Sciences & Engineering', 'color' => '#F79007', 'code' => 'AIC-SE'],
    'els' => ['name' => 'Environmental & Life Sciences', 'color' => '#137622', 'code' => 'AIC-ELS'],
    'ss'  => ['name' => 'Social Sciences', 'color' => '#AA39AF', 'code' => 'AIC-SS'],
];

$all_query = new WP_Query([
    'post_type'      => 'speaker',
    'posts_per_page' => 50,
    'orderby'        => 'order_clause',
    'order'          => 'ASC',
    'meta_query'     => [
        'order_clause' => ['key' => 'speaker_order', 'type' => 'NUMERIC'],
    ],
]);

$keynotes = [];
$invited  = [];

if ($all_query->have_posts()):
    foreach ($all_query->posts as $sp):
        $entry = [
            'id'    => $sp->ID,
            'name'  => $sp->post_title,
            'photo' => get_the_post_thumbnail_url($sp->ID, 'large'),
            'title' => get_field('speaker_title', $sp->ID) ?: '',
            'aff'   => get_field('speaker_affiliation', $sp->ID) ?: '',
            'track' => get_field('speaker_track', $sp->ID),
            'url'   => get_permalink($sp->ID),
        ];
        if (get_field('speaker_is_keynote', $sp->ID)) {
            $keynotes[] = $entry;
        } else {
            $invited[] = $entry;
        }
    endforeach;
endif;
wp_reset_postdata();
?>

<!-- ============================================
     KEYNOTE SPEAKERS
     ============================================ -->
<?php if (!empty($keynotes)): ?>
<section class="section bg-white">
    <div class="container-custom">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 reveal">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-1.5 h-6 rounded-full bg-accent"></span>
                    <p class="text-accent text-body-sm font-semibold uppercase tracking-wider">Keynote Speakers</p>
                </div>
                <h2 class="text-display text-ink">Voices that shape<br>the conversation</h2>
            </div>
            <p class="text-ink-muted max-w-md">Opening insights and perspectives from distinguished leaders across disciplines.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 reveal-stagger">
            <?php foreach ($keynotes as $kn):
                $ti = $track_info[$kn['track']] ?? null;
                $tc = $ti['color'] ?? '#666';
                $lbl = $ti ? $ti['code'] : 'All Tracks';
            ?>
            <a href="<?php echo esc_url($kn['url']); ?>" class="group block bg-white rounded-2xl border border-surface-300/60 overflow-hidden no-underline hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-300">
                <!-- Photo -->
                <div class="aspect-[3/4] overflow-hidden bg-surface-200 relative">
                    <?php if ($kn['photo']): ?>
                        <img src="<?php echo esc_url($kn['photo']); ?>" alt="<?php echo esc_attr($kn['name']); ?>" class="w-full h-full object-cover" loading="lazy">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-surface-100 to-surface-200">
                            <svg class="w-20 h-20 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                    <?php endif; ?>
                    <!-- Keynote badge -->
                    <span class="absolute top-3 left-3 inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-caption font-semibold bg-accent text-white">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        Keynote
                    </span>
                </div>
                <!-- Info -->
                <div class="p-5">
                    <h3 class="text-heading-sm text-ink font-semibold mb-1 group-hover:text-primary transition-colors"><?php echo esc_html($kn['name']); ?></h3>
                    <?php if ($kn['title']): ?>
                        <p class="text-body-sm text-primary font-medium truncate"><?php echo esc_html($kn['title']); ?></p>
                    <?php endif; ?>
                    <?php if ($kn['aff']): ?>
                        <p class="text-caption text-ink-subtle mt-1 truncate"><?php echo esc_html($kn['aff']); ?></p>
                    <?php endif; ?>
                    <span class="inline-block mt-3 px-2.5 py-0.5 rounded-full text-caption font-semibold" style="background: <?php echo esc_attr($tc); ?>15; color: <?php echo esc_attr($tc); ?>;"><?php echo esc_html($lbl); ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============================================
     INVITED SPEAKERS
     ============================================ -->
<?php if (!empty($invited)): ?>
<section class="section bg-surface">
    <div class="container-custom">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 reveal">
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="w-1.5 h-6 rounded-full bg-primary"></span>
                    <p class="text-primary text-body-sm font-semibold uppercase tracking-wider">Invited Speakers</p>
                </div>
                <h2 class="text-display text-ink">Experts across<br>every track</h2>
            </div>
            <p class="text-ink-muted max-w-md">Specialized presentations from researchers and practitioners in their respective fields.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 reveal-stagger">
            <?php foreach ($invited as $sp):
                $ti = $track_info[$sp['track']] ?? null;
                $tc = $ti['color'] ?? '#666';
                $lbl = $ti['code'] ?? strtoupper($sp['track']);
            ?>
            <a href="<?php echo esc_url($sp['url']); ?>" class="group block bg-white rounded-2xl border border-surface-200 overflow-hidden no-underline hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-300">
                <!-- Photo -->
                <div class="aspect-[3/4] overflow-hidden bg-surface-200">
                    <?php if ($sp['photo']): ?>
                        <img src="<?php echo esc_url($sp['photo']); ?>" alt="<?php echo esc_attr($sp['name']); ?>" class="w-full h-full object-cover" loading="lazy">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-surface-100 to-surface-200">
                            <svg class="w-16 h-16 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Info -->
                <div class="p-4">
                    <h3 class="text-body font-semibold text-ink mb-0.5 group-hover:text-primary transition-colors"><?php echo esc_html($sp['name']); ?></h3>
                    <?php if ($sp['title']): ?>
                        <p class="text-caption text-primary font-medium truncate"><?php echo esc_html($sp['title']); ?></p>
                    <?php endif; ?>
                    <?php if ($sp['aff']): ?>
                        <p class="text-caption text-ink-subtle truncate"><?php echo esc_html($sp['aff']); ?></p>
                    <?php endif; ?>
                    <span class="inline-block mt-2 px-2 py-0.5 rounded-full text-[0.65rem] font-semibold" style="background: <?php echo esc_attr($tc); ?>15; color: <?php echo esc_attr($tc); ?>;"><?php echo esc_html($lbl); ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
