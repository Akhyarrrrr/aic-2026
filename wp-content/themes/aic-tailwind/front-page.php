<?php
get_header();

$edition    = get_option('aic_edition_number', '16th');
$conf_date  = get_option('aic_conference_date', 'November 4-5, 2026');
$conf_loc   = get_option('aic_conference_location', 'Banda Aceh, Indonesia');
$tagline    = get_option('aic_hero_tagline', 'Advancing research and innovation for a resilient, green, and inclusive future.');
$stat_c     = get_option('aic_stat_countries', '30+');
$stat_p     = get_option('aic_stat_papers', '150+');
$hero_bg    = content_url('uploads/2026/07/conference-hero.jpg');
?>

<section class="relative min-h-[100dvh] flex items-center justify-center overflow-hidden bg-primary">
    <?php if ($hero_bg): ?>
    <div class="absolute inset-0">
        <img src="<?php echo esc_url($hero_bg); ?>" alt="" class="w-full h-full object-cover opacity-20" loading="eager">
    </div>
    <?php endif; ?>
    <div class="absolute inset-0 bg-gradient-to-b from-primary/80 via-primary/70 to-primary-900/90"></div>
    <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle, #C7982C 1px, transparent 1px); background-size: 36px 36px;"></div>

    <div class="container-custom relative z-10 py-20 lg:py-0 text-center">
        <div class="reveal mb-8">
            <span class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 rounded-full bg-white/10 text-caption sm:text-body-sm text-accent font-medium backdrop-blur-sm border border-white/10">
                <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-accent shrink-0"></span>
                <?php echo esc_html($conf_date); ?> &middot; <?php echo esc_html($conf_loc); ?>
            </span>
        </div>

        <h1 class="reveal text-white text-display-sm md:text-display-lg lg:text-[3.75rem] lg:leading-[1.08] font-bold mb-6 max-w-4xl mx-auto text-balance">
            The <?php echo esc_html($edition); ?><sup class="text-accent"><?php echo preg_replace('/[0-9]+/', '', $edition); ?></sup> Annual International<br class="hidden sm:block"> Conference
        </h1>
        <p class="reveal text-surface-400 text-body lg:text-body-lg lg:text-xl leading-relaxed max-w-2xl mx-auto mb-10">
            <?php echo esc_html($tagline); ?>
        </p>

        <?php
        $countdown_date     = get_option('aic_countdown_date', '2026-11-04');
        $countdown_end_date = get_option('aic_countdown_end_date', '2026-11-06');
        ?>
        <div class="reveal flex justify-center gap-2 sm:gap-4 lg:gap-6 mb-12" data-countdown="<?php echo esc_attr($countdown_date); ?>" data-countdown-end="<?php echo esc_attr($countdown_end_date); ?>">
            <?php $now = time(); $event = strtotime($countdown_date); $diff = max(0, $event - $now); ?>
            <div class="countdown-box"><span class="countdown-number"><?php echo floor($diff/86400); ?></span><span class="countdown-label">Days</span></div>
            <div class="countdown-box"><span class="countdown-number"><?php echo floor(($diff%86400)/3600); ?></span><span class="countdown-label">Hours</span></div>
            <div class="countdown-box"><span class="countdown-number"><?php echo floor(($diff%3600)/60); ?></span><span class="countdown-label">Minutes</span></div>
            <div class="countdown-box"><span class="countdown-number"><?php echo $diff%60; ?></span><span class="countdown-label">Seconds</span></div>
        </div>

        <div class="reveal flex flex-wrap justify-center gap-4">
            <a href="https://conference.usk.ac.id/" target="_blank" rel="noopener" class="btn-accent btn-lg">
                Submit Your Abstract
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="#tracks" class="btn-lg border-2 border-white/20 text-white hover:bg-white/10 transition-all duration-200 rounded-lg px-8 py-4 font-medium text-body inline-flex items-center gap-2 no-underline">
                Explore Tracks
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </a>
        </div>

    </div>

    <!-- Scroll-down indicator -->
    <a href="#about" class="absolute bottom-6 lg:bottom-8 left-1/2 -translate-x-1/2 text-white/50 hover:text-white transition-colors duration-300 animate-bounce no-underline">
        <svg class="w-6 h-6 lg:w-7 lg:h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </a>
</section>

<!-- ============================================
     ABOUT
     ============================================ -->
<section class="section bg-surface" id="about">
    <div class="container-custom">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20">
            <!-- Left | Title -->
            <div class="lg:col-span-5 reveal">
                <p class="text-accent text-body-sm font-semibold uppercase tracking-wider mb-4">About the conference</p>
                <h2 class="text-display-sm lg:text-display text-ink mb-6 text-balance">
                    A premier<br> multidisciplinary<br class="hidden lg:block"> platform since 2011
                </h2>
                <div class="w-16 h-1 bg-accent rounded-full"></div>
            </div>

            <!-- Right | Content -->
            <div class="lg:col-span-7 reveal space-y-8">
                <div class="space-y-5">
                    <p class="text-body-lg leading-relaxed">
                        The <?php echo esc_html($edition); ?> Annual International Conference (AIC) <?php echo intval($edition); ?> is a distinguished multidisciplinary scientific event hosted by <strong class="text-ink">Universitas Syiah Kuala (USK)</strong> under the auspices of <strong class="text-ink">LPPM-USK</strong>.
                    </p>
                    <p>
                        With the theme <strong class="text-ink">&ldquo;<?php echo esc_html($tagline); ?>,&rdquo;</strong> AIC <?php echo intval($edition); ?> brings together researchers to advance knowledge and forge collaborations addressing pressing global challenges.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>

<?php
$chair_name      = get_option('aic_chair_name', '');
$chair_title     = get_option('aic_chair_title', '');
$chair_message   = get_option('aic_chair_message', '');
$chair_photo_id  = get_option('aic_chair_photo', 0);
$chair_photo_url = $chair_photo_id ? wp_get_attachment_image_url($chair_photo_id, 'thumbnail') : '';
?>
<?php if ($chair_name): ?>
<section class="section bg-surface-200" id="chair">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <div class="reveal relative bg-white rounded-3xl p-8 lg:p-12 shadow-card border border-surface-300/60">
                <div class="absolute top-0 left-8 right-8 h-1 bg-gradient-to-r from-primary via-primary-400 to-accent rounded-full"></div>
                <div class="text-5xl lg:text-6xl font-serif text-primary/10 leading-none mb-2 select-none" aria-hidden="true">&ldquo;</div>
                <?php if (!empty($chair_message)): ?>
                <div class="space-y-4 text-body-lg text-ink-muted leading-relaxed -mt-4 prose-custom">
                    <?php echo wp_kses_post($chair_message); ?>
                </div>
                <?php endif; ?>
                <div class="mt-8 pt-6 border-t border-surface-300 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <?php if (!empty($chair_photo_url)): ?>
                        <img src="<?php echo esc_url($chair_photo_url); ?>"
                             alt="<?php echo esc_attr($chair_name); ?>"
                             class="w-14 h-14 rounded-full object-cover">
                        <?php endif; ?>
                        <div>
                            <?php if ($chair_name): ?>
                            <p class="text-body font-semibold text-ink"><?php echo esc_html($chair_name); ?></p>
                            <?php endif; ?>
                            <?php if ($chair_title): ?>
                            <p class="text-body-sm text-ink-muted mt-0.5"><?php echo esc_html($chair_title); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-right text-body-sm text-ink-muted">
                        <p>Regards,</p>
                        <div class="mt-1 font-serif text-xl text-ink/30 italic select-none"><?php echo $chair_name ? esc_html(explode(',', $chair_name)[0]) : 'Chairperson'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============================================
     TRACKS SELECTOR
     ============================================ -->
<section class="section bg-surface-200" id="tracks">
    <div class="container-custom">
        <div class="text-center max-w-2xl mx-auto mb-16 reveal">
            <h2 class="text-display-sm lg:text-display text-ink mb-4 text-balance">Three disciplines,<br>one mission</h2>
            <p class="text-body-lg text-ink-muted">Each track addresses specific global challenges through focused research and collaboration.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 lg:gap-8 reveal-stagger">
            <?php
            $tracks = [
                [
                    'slug' => 'se',
                    'title' => 'Sciences & Engineering',
                    'subtitle' => 'AIC-SE',
                    'color' => '#F79007',
                    'desc' => 'Civil, Mechanical, Electrical, Chemical Engineering, Computer Science, and related fields advancing technological innovation.',
                ],
                [
                    'slug' => 'els',
                    'title' => 'Environmental & Life Sciences',
                    'subtitle' => 'AIC-ELS',
                    'color' => '#137622',
                    'desc' => 'Ecology, Conservation, Agriculture, Biology, Biotechnology, Marine Sciences, and green technology for a sustainable planet.',
                ],
                [
                    'slug' => 'ss',
                    'title' => 'Social Sciences',
                    'subtitle' => 'AIC-SS',
                    'color' => '#AA39AF',
                    'desc' => 'Sociology, Economics, Education, Psychology, Political Science, Law, and Humanities exploring human society and behavior.',
                ],
            ];

            foreach ($tracks as $track):
                $track_url = home_url("/{$track['slug']}/");
            ?>
            <a href="<?php echo esc_url($track_url); ?>"
               class="group relative block bg-white/50 rounded-2xl p-1.5 no-underline transition-all duration-500 hover:-translate-y-1 hover:shadow-card-hover"
               style="--track-hover: <?php echo esc_attr($track['color']); ?>">
                <div class="relative bg-white rounded-[calc(1rem-0.375rem)] p-8 lg:p-10 border border-surface-200/80 transition-all duration-500 group-hover:border-transparent"
                     style="box-shadow: inset 0 1px 1px rgba(255,255,255,0.15);">
                    <!-- Color accent dot + label -->
                    <div class="flex items-center gap-2.5 mb-5">
                        <span class="w-2.5 h-2.5 rounded-full transition-all duration-500 group-hover:scale-125" style="background: <?php echo esc_attr($track['color']); ?>"></span>
                        <span class="text-caption font-semibold uppercase tracking-widest" style="color: <?php echo esc_attr($track['color']); ?>"><?php echo esc_html($track['subtitle']); ?></span>
                    </div>

                    <h3 class="text-heading text-ink mb-3 leading-tight"><?php echo esc_html($track['title']); ?></h3>
                    <p class="text-body-sm text-ink-muted leading-relaxed mb-8"><?php echo esc_html($track['desc']); ?></p>

                    <span class="inline-flex items-center gap-2 text-body-sm font-medium transition-all duration-300 group-hover:gap-3 no-underline" style="color: <?php echo esc_attr($track['color']); ?>">
                        Explore track
                        <span class="w-6 h-6 rounded-full flex items-center justify-center transition-all duration-300" style="background: <?php echo esc_attr($track['color']); ?>15;">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     KEYNOTE SPEAKERS — auto-rotating carousel
     ============================================ -->
<section class="section bg-white" id="speakers">
    <div class="container-custom">

        <?php
        $all_query = new WP_Query([
            'post_type'      => 'speaker',
            'posts_per_page' => 50,
            'orderby'        => 'meta_value_num',
            'meta_key'       => 'speaker_order',
            'order'          => 'ASC',
        ]);
        $has_speakers = $all_query->have_posts();

        $track_labels = ['SE' => 'AIC-SE', 'ELS' => 'AIC-ELS', 'SS' => 'AIC-SS'];
        $track_accent = ['SE' => '#F79007', 'ELS' => '#137622', 'SS' => '#AA39AF'];

        $keynotes = [];
        $invited  = [];
        if ($has_speakers):
            foreach ($all_query->posts as $sp):
                $is_keynote = get_field('speaker_is_keynote', $sp->ID);
                $tk = strtoupper(get_field('speaker_track', $sp->ID));
                $entry = [
                    'name'        => $sp->post_title,
                    'affiliation' => get_field('speaker_affiliation', $sp->ID) ?: '',
                    'title'       => get_field('speaker_title', $sp->ID) ?: '',
                    'track'       => $tk,
                    'is_keynote'  => $is_keynote,
                    'cpt_id'      => $sp->ID,
                    'order'       => get_field('speaker_order', $sp->ID),
                ];
                if ($is_keynote) {
                    $keynotes[] = $entry;
                } else {
                    $invited[] = $entry;
                }
            endforeach;
        endif;
        ?>

        <?php if (!empty($keynotes)): ?>
        <!-- Keynote header -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10 reveal">
            <div>
                <h2 class="text-display-sm lg:text-display text-ink">Voices that shape<br>the conversation</h2>
                <p class="text-body-lg text-ink-muted mt-2">Distinguished keynote speakers from across the globe.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/speaker/')); ?>" class="btn-ghost no-underline shrink-0">
                View all speakers
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <!-- Keynote auto-rotating carousel -->
        <div class="relative mb-20 reveal" id="keynote-carousel" data-interval="6000">
            <div class="relative px-4 sm:px-8 lg:px-24">
                <?php foreach ($keynotes as $idx => $kn):
                    $tk = $kn['track'];
                    $tc = $track_accent[$tk] ?? '#666';
                    $lbl = $track_labels[$tk] ?? $tk;
                ?>
                <div class="keynote-slide <?php echo $idx > 0 ? 'hidden' : ''; ?>" data-index="<?php echo $idx; ?>">
                    <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        <!-- Photo -->
                        <div class="lg:col-span-5">
                            <div class="aspect-[3/4] rounded-2xl overflow-hidden bg-surface-200 shadow-lg">
                                <?php if (has_post_thumbnail($kn['cpt_id'])): ?>
                                    <?php echo get_the_post_thumbnail($kn['cpt_id'], 'large', ['class' => 'w-full h-full object-cover', 'loading' => 'lazy']); ?>
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-surface-100 to-surface-200">
                                        <svg class="w-24 h-24 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Info -->
                        <div class="lg:col-span-7">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-caption font-semibold bg-accent/10 text-accent">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    Keynote Speaker
                                </span>
                                <span class="px-2.5 py-0.5 rounded-full text-caption font-semibold" style="background: <?php echo esc_attr($tc); ?>15; color: <?php echo esc_attr($tc); ?>;"><?php echo esc_html($lbl); ?></span>
                            </div>
                            <h3 class="text-display-sm text-ink mb-2"><?php echo esc_html($kn['name']); ?></h3>
                            <?php if ($kn['title']): ?>
                                <p class="text-body-lg text-primary font-medium mb-1"><?php echo esc_html($kn['title']); ?></p>
                            <?php endif; ?>
                            <?php if ($kn['affiliation']): ?>
                                <p class="text-body text-ink-muted"><?php echo esc_html($kn['affiliation']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Prev / Next arrows (outside content area) -->
            <?php if (count($keynotes) > 1): ?>
            <button class="keynote-prev absolute left-2 sm:left-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-14 sm:h-14 lg:w-16 lg:h-16 rounded-full bg-white/90 backdrop-blur-sm shadow-lg text-ink-muted hover:bg-accent hover:text-white flex items-center justify-center transition-all duration-300" aria-label="Previous keynote">
                <svg class="w-5 h-5 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button class="keynote-next absolute right-2 sm:right-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-14 sm:h-14 lg:w-16 lg:h-16 rounded-full bg-white/90 backdrop-blur-sm shadow-lg text-ink-muted hover:bg-accent hover:text-white flex items-center justify-center transition-all duration-300" aria-label="Next keynote">
                <svg class="w-5 h-5 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
            <?php endif; ?>

            <!-- Carousel dots -->
            <?php if (count($keynotes) > 1): ?>
            <div class="flex justify-center gap-2.5 mt-8">
                <?php foreach ($keynotes as $idx => $kn): ?>
                <button class="keynote-dot w-2.5 h-2.5 rounded-full transition-all duration-300 <?php echo $idx === 0 ? 'bg-accent scale-125' : 'bg-surface-300 hover:bg-surface-400'; ?>" data-index="<?php echo $idx; ?>" aria-label="Keynote <?php echo $idx + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($invited)): ?>
        <!-- Invited speakers header -->
        <div class="flex items-center mb-8 reveal">
            <span class="w-1 h-8 rounded-full bg-primary shrink-0 mr-4"></span>
            <div>
                <p class="text-heading-sm text-ink font-semibold">Invited Speakers</p>
                <p class="text-caption text-ink-subtle"><?php echo count($invited); ?> speakers across 3 tracks</p>
            </div>
        </div>

        <!-- Invited speakers grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 reveal-stagger">
            <?php foreach ($invited as $iv):
                $tk = $iv['track'];
                $tc = $track_accent[$tk] ?? '#666';
                $lbl = $track_labels[$tk] ?? $tk;
            ?>
            <div class="bg-white rounded-2xl border border-surface-200 overflow-hidden group hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-300">
                <!-- Photo -->
                <div class="aspect-[3/4] overflow-hidden bg-surface-200">
                    <?php if (has_post_thumbnail($iv['cpt_id'])): ?>
                        <?php echo get_the_post_thumbnail($iv['cpt_id'], 'medium_large', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105', 'loading' => 'lazy']); ?>
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-surface-100 to-surface-200">
                            <svg class="w-16 h-16 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Info -->
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="px-2 py-0.5 rounded-full text-[0.65rem] font-semibold" style="background: <?php echo esc_attr($tc); ?>15; color: <?php echo esc_attr($tc); ?>;"><?php echo esc_html($lbl); ?></span>
                    </div>
                    <h3 class="text-body font-semibold text-ink leading-tight mb-0.5"><?php echo esc_html($iv['name']); ?></h3>
                    <?php if ($iv['title']): ?>
                        <p class="text-caption text-primary truncate"><?php echo esc_html($iv['title']); ?></p>
                    <?php endif; ?>
                    <?php if ($iv['affiliation']): ?>
                        <p class="text-caption text-ink-subtle truncate"><?php echo esc_html($iv['affiliation']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (empty($keynotes) && empty($invited)): ?>
        <div class="text-center py-16 reveal">
            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-surface-200 flex items-center justify-center">
                <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h3 class="text-heading text-ink mb-3">Speakers to be announced</h3>
            <p class="text-ink-muted max-w-sm mx-auto">The organizing committee is confirming speakers. Check back soon for updates.</p>
        </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>

<!-- ============================================
     IMPORTANT DATES
     ============================================ -->
<?php $important_dates = get_option('aic_important_dates', []); ?>
<?php if (!empty($important_dates)): ?>
<section class="section bg-primary text-white overflow-hidden relative" id="dates">
    <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 80% 20%, #C7982C 1px, transparent 1px); background-size: 32px 32px;"></div>

    <div class="container-custom relative z-10">
        <div class="text-center max-w-xl mx-auto mb-16 reveal">
            <h2 class="text-display-sm lg:text-display text-white mb-4 text-balance">Important dates</h2>
            <p class="text-surface-400 text-body-lg">Plan your participation with these key deadlines.</p>
        </div>

        <div class="max-w-3xl mx-auto reveal">
            <?php $total = count($important_dates); $idx = 0; ?>
            <?php foreach ($important_dates as $d): $idx++; $is_last = $idx === $total; ?>
            <div class="flex gap-6 <?php echo !$is_last ? 'pb-10' : ''; ?>">
                <div class="flex flex-col items-center">
                    <div class="w-3 h-3 rounded-full shrink-0 mt-1.5 bg-white/60"></div>
                    <?php if (!$is_last): ?>
                    <div class="w-px flex-1 bg-white/15 mt-2"></div>
                    <?php endif; ?>
                </div>
                <div class="rounded-xl p-5 -mt-0.5 flex-1">
                    <p class="text-accent text-caption sm:text-body-sm font-semibold uppercase tracking-wider mb-1 break-words"><?php echo esc_html($d['date_value']); ?></p>
                    <h4 class="text-white text-heading-sm font-semibold mb-1"><?php echo esc_html($d['date_label']); ?></h4>
                    <?php if (!empty($d['date_desc'])): ?>
                    <p class="text-surface-400 text-body-sm"><?php echo esc_html($d['date_desc']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $co_organizers = get_option('aic_co_organizers', []); ?>
<?php if (!empty($co_organizers)): ?>
<section class="section-sm bg-white" id="organizers">
    <div class="container-custom">
        <div class="text-center reveal">
            <p class="text-caption text-ink-subtle uppercase tracking-widest mb-6">Co-organized by</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 max-w-5xl mx-auto">
                <?php foreach ($co_organizers as $co): ?>
                <div class="bg-surface-100 rounded-2xl p-5 lg:p-6 border border-surface-200 text-center">
                    <?php
                        $co_logo_url = !empty($co['co_logo']) ? wp_get_attachment_image_url($co['co_logo'], 'large') : '';
                    ?>
                    <?php if (!empty($co_logo_url)): ?>
                    <img src="<?php echo esc_url($co_logo_url); ?>"
                         alt="<?php echo esc_attr($co['co_name']); ?>"
                         class="h-32 lg:h-40 w-auto mx-auto mb-3 object-contain"
                         loading="lazy">
                    <?php else: ?>
                    <div class="h-20 lg:h-24 w-20 lg:w-24 mx-auto mb-3 rounded-xl bg-surface-200 flex items-center justify-center">
                        <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($co['co_name'])): ?>
                    <p class="text-body-sm font-semibold text-ink"><?php echo esc_html($co['co_name']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($co['co_desc'])): ?>
                    <p class="text-caption text-ink-muted mt-0.5"><?php echo esc_html($co['co_desc']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($co['co_url'])): ?>
                    <a href="<?php echo esc_url($co['co_url']); ?>" target="_blank" rel="noopener" class="inline-block mt-2 text-caption text-primary hover:text-primary-600 transition-colors no-underline">
                        Visit website &rarr;
                    </a>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $gallery_ids = get_option('aic_gallery_images', []); ?>
<section class="section bg-white overflow-hidden" id="memories">
    <div class="container-custom">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-16 reveal">
            <div>
                <h2 class="text-display-sm lg:text-display text-ink">Past conferences,<br>lasting impact</h2>
            </div>
            <p class="text-ink-muted max-w-md text-body">A glimpse into previous AIC events showing the collaboration, scholarship, and community that define our conference.</p>
        </div>

        <?php if (!empty($gallery_ids)): ?>
        <?php $gallery_imgs = []; foreach ($gallery_ids as $id) { $src = wp_get_attachment_image_src($id, 'medium_large'); if ($src) $gallery_imgs[] = $src; } ?>
        <?php if (!empty($gallery_imgs)): ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 lg:gap-4 reveal-stagger">
            <?php foreach ($gallery_imgs as $i => $img):
                $span = ($i === 0 || $i === 4) ? 'md:col-span-2 md:row-span-2' : '';
                $aspect = ($i === 0 || $i === 4) ? 'aspect-[4/3] md:aspect-auto' : 'aspect-square';
            ?>
            <div class="<?php echo $span; ?> <?php echo $aspect; ?> rounded-xl overflow-hidden bg-surface-200 group cursor-pointer relative">
                <img src="<?php echo esc_url($img[0]); ?>"
                     alt="AIC Conference"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                     loading="lazy">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php else: ?>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3 lg:gap-4 reveal">
            <?php for ($i = 0; $i < 5; $i++): ?>
            <div class="aspect-square rounded-xl bg-surface-200 flex items-center justify-center">
                <svg class="w-10 h-10 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a3.75 3.75 0 014.432-.593l.659.395a3.75 3.75 0 014.432.593L21.75 15M3.75 4.5h16.5a1.5 1.5 0 011.5 1.5v12a1.5 1.5 0 01-1.5 1.5H3.75a1.5 1.5 0 01-1.5-1.5V6a1.5 1.5 0 011.5-1.5z"/></svg>
            </div>
            <?php endfor; ?>
        </div>
       <?php endif; ?>
    </div>
</section>

    <!-- ============================================
         CTA BANNER
         ============================================ -->
<section class="section bg-surface-200" id="register">
    <div class="container-custom">
        <div class="relative bg-gradient-to-br from-primary to-primary-700 rounded-3xl overflow-hidden">
            <div class="absolute inset-0 opacity-[0.06]" style="background-image: radial-gradient(circle at 30% 70%, #C7982C 1px, transparent 1px), radial-gradient(circle at 70% 30%, #ffffff 1px, transparent 1px); background-size: 32px 32px, 48px 48px;"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-accent/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
            <div class="relative z-10 px-6 py-16 sm:px-20 sm:py-24 md:px-20 md:py-24 text-center max-w-3xl mx-auto reveal">
                <div class="w-12 h-12 mx-auto mb-6 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm border border-white/10">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                </div>
                <h2 class="text-display-sm lg:text-display text-white mb-4 text-balance">Ready to share your research?</h2>
                <p class="text-surface-400 text-body-lg mb-10 max-w-xl mx-auto">
                    Be part of AIC <?php echo intval($edition); ?>. Submit your abstract and join the conversation that shapes tomorrow.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://conference.usk.ac.id/" target="_blank" rel="noopener" class="group btn-accent btn-lg no-underline">
                        Submit Abstract
                        <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/conference/registration-fee/')); ?>" class="group btn-lg border border-white/20 text-white hover:bg-white/10 transition-all duration-300 rounded-xl px-8 py-4 font-medium text-body inline-flex items-center gap-2 no-underline active:scale-[0.98]">
                        Registration Fees
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
