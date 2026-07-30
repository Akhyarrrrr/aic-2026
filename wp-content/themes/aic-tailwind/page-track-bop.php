<?php
/**
 * Template Name: Track Book of Program
 * Conference program/schedule for a specific track
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

$hero_title    = 'Book of Program';
$hero_subtitle = "Conference schedule and program for " . $track['name'] . ".";

$presenters = get_posts([
    'post_type'      => 'speaker',
    'posts_per_page' => -1,
    'meta_query'     => [
        'relation' => 'AND',
        ['key' => 'speaker_track', 'value' => $slug],
        ['key' => 'speaker_is_keynote', 'value' => '0'],
    ],
    'meta_key' => 'speaker_order',
    'orderby'  => 'meta_value_num',
    'order'    => 'ASC',
]);

include get_template_directory() . '/template-parts/track-hero.php';
?>

<section class="section bg-surface">
    <div class="container-custom">
        <div class="grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-8 space-y-14">

                <!-- Program Overview -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 reveal">
                    <?php
                    $stats = [
                        ['val' => '2', 'label' => 'Conference Days'],
                        ['val' => max(count($presenters), 48), 'label' => 'Presentations'],
                        ['val' => '8', 'label' => 'Parallel Sessions'],
                        ['val' => '2', 'label' => 'Keynote Sessions'],
                    ];
                    foreach ($stats as $st):
                    ?>
                    <div class="bg-white rounded-xl border border-surface-300/60 p-5 text-center">
                        <span class="block text-2xl md:text-3xl font-bold leading-none mb-1" style="color: <?php echo esc_attr($track['color']); ?>;"><?php echo esc_html($st['val']); ?></span>
                        <span class="text-caption text-ink-subtle uppercase tracking-wider font-medium"><?php echo esc_html($st['label']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Schedule -->
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                        <p class="text-body-sm font-semibold uppercase tracking-wider" style="color: <?php echo esc_attr($track['color']); ?>;">Conference Schedule</p>
                    </div>
                    <h2 class="text-display text-ink mb-8"><?php echo esc_html($track['code']); ?> Program</h2>

                    <div class="space-y-6">
                        <!-- Day 1 -->
                        <div class="bg-white rounded-2xl border border-surface-300/60 overflow-hidden reveal">
                            <div class="px-6 py-4 flex items-center gap-3" style="background: <?php echo esc_attr($track['color']); ?>08;">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: <?php echo esc_attr($track['color']); ?>15;">
                                    <span class="text-heading-sm font-bold" style="color: <?php echo esc_attr($track['color']); ?>;">1</span>
                                </div>
                                <div>
                                    <h3 class="text-heading-sm text-ink font-semibold">Day 1 — November 4, 2026</h3>
                                    <p class="text-caption text-ink-subtle">Opening ceremony, keynote sessions, and parallel presentations</p>
                                </div>
                            </div>
                            <div class="p-6 space-y-0 divide-y divide-surface-300/40">
                                <?php
                                $day1 = get_option('aic_schedule_day1', []);
                                $badge_colors = [
                                    'keynote' => '#C7982C',
                                    'plenary' => $track['color'],
                                    'oral'    => $track['color'],
                                    'poster'  => '#8B5CF6',
                                    'break'   => '',
                                    'closing' => '#0D5F3A',
                                ];
                                $badge_labels = [
                                    'keynote' => 'Keynote',
                                    'plenary' => 'Plenary',
                                    'oral'    => 'Oral',
                                    'poster'  => 'Poster',
                                    'break'   => '',
                                    'closing' => 'Closing',
                                ];
                                foreach ($day1 as $i => $s):
                                    $type = $s['sched_type'];
                                    $bc   = $badge_colors[$type] ?? '';
                                    $bl   = $badge_labels[$type] ?? '';
                                ?>
                                <div class="flex items-start gap-4 py-4 <?php echo $i === 0 ? 'pt-0' : ''; ?> <?php echo $i === count($day1) - 1 ? 'pb-0' : ''; ?>">
                                    <div class="text-right shrink-0 w-16 md:w-[4.5rem] pt-0.5">
                                        <p class="text-caption font-semibold text-ink"><?php echo esc_html($s['sched_time']); ?></p>
                                    </div>
                                    <div class="w-px self-stretch shrink-0" style="background: <?php echo esc_attr($track['color']); ?>20;"></div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <?php if ($bl): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-caption font-semibold text-white" style="background: <?php echo esc_attr($bc); ?>;"><?php echo esc_html($bl); ?></span>
                                            <?php endif; ?>
                                            <span class="text-caption text-ink-subtle"><?php echo esc_html($s['sched_room']); ?></span>
                                        </div>
                                        <p class="text-body-sm font-semibold text-ink mt-0.5"><?php echo esc_html($s['sched_activity']); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Day 2 -->
                        <div class="bg-white rounded-2xl border border-surface-300/60 overflow-hidden reveal">
                            <div class="px-6 py-4 flex items-center gap-3" style="background: <?php echo esc_attr($track['color']); ?>08;">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: <?php echo esc_attr($track['color']); ?>15;">
                                    <span class="text-heading-sm font-bold" style="color: <?php echo esc_attr($track['color']); ?>;">2</span>
                                </div>
                                <div>
                                    <h3 class="text-heading-sm text-ink font-semibold">Day 2 — November 5, 2026</h3>
                                    <p class="text-caption text-ink-subtle">Parallel sessions, keynote sessions, and closing ceremony</p>
                                </div>
                            </div>
                            <div class="p-6 space-y-0 divide-y divide-surface-300/40">
                                <?php
                                $day2 = get_option('aic_schedule_day2', []);
                                foreach ($day2 as $i => $s):
                                    $type = $s['sched_type'];
                                    $bc   = $badge_colors[$type] ?? '';
                                    $bl   = $badge_labels[$type] ?? '';
                                ?>
                                <div class="flex items-start gap-4 py-4 <?php echo $i === 0 ? 'pt-0' : ''; ?> <?php echo $i === count($day2) - 1 ? 'pb-0' : ''; ?>">
                                    <div class="text-right shrink-0 w-16 md:w-[4.5rem] pt-0.5">
                                        <p class="text-caption font-semibold text-ink"><?php echo esc_html($s['sched_time']); ?></p>
                                    </div>
                                    <div class="w-px self-stretch shrink-0" style="background: <?php echo esc_attr($track['color']); ?>20;"></div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <?php if ($bl): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-caption font-semibold text-white" style="background: <?php echo esc_attr($bc); ?>;"><?php echo esc_html($bl); ?></span>
                                            <?php endif; ?>
                                            <span class="text-caption text-ink-subtle"><?php echo esc_html($s['sched_room']); ?></span>
                                        </div>
                                        <p class="text-body-sm font-semibold text-ink mt-0.5"><?php echo esc_html($s['sched_activity']); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <p class="text-body-sm text-ink-muted mt-6 text-center italic">Schedule is subject to change. Registered participants will be notified of any updates.</p>
                </div>

                <!-- Accepted Presentations -->
                <?php if ($presenters): ?>
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                        <p class="text-body-sm font-semibold uppercase tracking-wider" style="color: <?php echo esc_attr($track['color']); ?>;">Accepted Presentations</p>
                    </div>
                    <h2 class="text-display text-ink mb-8"><?php echo count($presenters); ?> Presentations in <?php echo esc_html($track['code']); ?></h2>

                    <div class="space-y-3 reveal-stagger">
                        <?php
                        $session_letters = ['A','B','C','D','E','F','G','H'];
                        foreach ($presenters as $pi => $p):
                            $p_affil  = get_field('speaker_affiliation', $p->ID);
                            $p_title  = get_field('speaker_title', $p->ID);
                            $abstract = !empty(trim(wp_strip_all_tags($p->post_content))) ? wp_trim_words($p->post_content, 20) : '';
                            $session_idx = $pi % 8;
                            $code = 'AIC-' . strtoupper($slug) . '-' . str_pad($pi + 1, 3, '0', STR_PAD_LEFT);
                        ?>
                        <div class="bg-white rounded-xl border border-surface-300/60 p-5 transition-shadow duration-300 hover:shadow-card-hover">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-caption font-mono font-semibold tracking-wide px-1.5 py-0.5 rounded" style="background: <?php echo esc_attr($track['color']); ?>10; color: <?php echo esc_attr($track['color']); ?>;">
                                            <?php echo esc_html($code); ?>
                                        </span>
                                        <span class="text-caption text-ink-subtle">Session <?php echo esc_html($session_letters[$session_idx]); ?></span>
                                    </div>
                                    <h3 class="text-body-sm font-semibold text-ink"><?php echo esc_html($p->post_title); ?></h3>
                                    <?php if ($p_title || $p_affil): ?>
                                    <p class="text-caption text-ink-muted mt-0.5"><?php echo esc_html($p_title); ?><?php echo ($p_title && $p_affil) ? ', ' : ''; ?><?php echo esc_html($p_affil); ?></p>
                                    <?php endif; ?>
                                    <?php if ($abstract): ?>
                                    <p class="text-caption text-ink-subtle mt-2 leading-relaxed"><?php echo esc_html($abstract); ?></p>
                                    <?php endif; ?>
                                </div>
                                <span class="shrink-0 inline-flex items-center px-2.5 py-1 rounded-full text-caption font-medium <?php echo $pi % 2 === 0 ? 'bg-accent/10 text-accent-600' : 'bg-primary/10 text-primary'; ?>">
                                    <?php echo $pi % 2 === 0 ? 'Oral' : 'Poster'; ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Download -->
                <div class="bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-10 reveal">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                        <h2 class="text-heading-lg text-ink">Download</h2>
                    </div>
                    <p class="text-body text-ink-muted mb-6">Access the abstract template and program materials for <?php echo esc_html($track['code']); ?>.</p>
                    <div class="flex flex-wrap gap-3">
                        <?php
                        $abstract_field = 'tmpl_abstract_' . $slug;
                        $program_field  = 'tmpl_program_' . $slug;
                        $abstract_url   = wp_get_attachment_url(get_option('aic_' . $abstract_field, 0)) ?: '';
                        $program_url    = wp_get_attachment_url(get_option('aic_' . $program_field, 0)) ?: '';
                        ?>
                        <?php if ($abstract_url): ?>
                        <a href="<?php echo esc_url($abstract_url); ?>" class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl text-white font-medium text-body-sm transition-all hover:opacity-90 active:scale-[0.98] no-underline" style="background: <?php echo esc_attr($track['color']); ?>;" download>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            Abstract Template (.docx)
                        </a>
                        <?php else: ?>
                        <span class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl text-body-sm text-ink-subtle italic border border-surface-300/60">Abstract template not yet uploaded</span>
                        <?php endif; ?>
                        <?php if ($program_url): ?>
                        <a href="<?php echo esc_url($program_url); ?>" class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl font-medium text-body-sm transition-all hover:opacity-90 active:scale-[0.98] no-underline border border-surface-300/60 text-ink-muted hover:border-surface-400 hover:text-ink">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            Full Program (PDF)
                        </a>
                        <?php else: ?>
                        <span class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl text-body-sm text-ink-subtle italic border border-surface-300/60">Program not yet uploaded</span>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <?php include get_template_directory() . '/template-parts/track-sidebar.php'; ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
