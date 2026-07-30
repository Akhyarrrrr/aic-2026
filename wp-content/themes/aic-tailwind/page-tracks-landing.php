<?php
/**
 * Template Name: Tracks Landing
 * Parent landing page for /tracks/ showing all 3 tracks
 */
get_header();

$title    = 'Conference Tracks';
$subtitle = 'Three disciplines, one mission.';
?>
<?php get_template_part('template-parts/hero-inner'); ?>

<section class="section bg-surface">
    <div class="container-custom">

        <?php
        $tracks = [
            [
                'slug' => 'se',
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
                'desc' => 'Civil, Mechanical, Electrical, Chemical Engineering, Computer Science, and related fields advancing technological innovation.',
            ],
            [
                'slug' => 'els',
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>',
                'desc' => 'Ecology, Conservation, Agriculture, Biology, Biotechnology, Marine Sciences, and green technology for a sustainable planet.',
            ],
            [
                'slug' => 'ss',
                'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                'desc' => 'Sociology, Economics, Education, Psychology, Political Science, Law, and Humanities exploring human society and behavior.',
            ],
        ];
        ?>

        <div class="grid md:grid-cols-3 gap-6 lg:gap-8 reveal-stagger">
            <?php foreach ($tracks as $track):
                $color = aic_track_color($track['slug']);
                $name  = aic_track_name($track['slug']);
                $code  = aic_track_code($track['slug']);
                $url   = home_url("/{$track['slug']}/");
            ?>
            <a href="<?php echo esc_url($url); ?>" class="group relative bg-white rounded-2xl overflow-hidden no-underline transition-all duration-300 hover:-translate-y-1 border border-surface-300/60"
               style="--track-hover: <?php echo esc_attr($color); ?>;">
                <div class="h-1 w-full" style="background: <?php echo esc_attr($color); ?>;"></div>
                <div class="p-7">
                    <div class="mb-4" style="color: <?php echo esc_attr($color); ?>;"><?php echo $track['icon']; ?></div>
                    <span class="inline-block px-3 py-1 rounded-full text-caption font-semibold uppercase tracking-wider mb-3" style="background: <?php echo esc_attr($color); ?>15; color: <?php echo esc_attr($color); ?>;"><?php echo esc_html($code); ?></span>
                    <h3 class="text-heading text-ink mb-3 group-hover:opacity-80 transition-opacity track-title"><?php echo esc_html($name); ?></h3>
                    <p class="text-body-sm text-ink-muted leading-relaxed mb-6"><?php echo esc_html($track['desc']); ?></p>
                    <span class="inline-flex items-center gap-1.5 text-body-sm font-medium transition-colors no-underline" style="color: <?php echo esc_attr($color); ?>">
                        Explore track
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>
