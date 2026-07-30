<?php
/**
 * Template Name: Track Committees
 * Committees for a specific track, grouped by role
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

$hero_title    = 'Committees';
$hero_subtitle = "The dedicated committee members guiding " . $track['name'] . ".";

$committee_q = new WP_Query([
    'post_type'      => 'committee',
    'posts_per_page' => -1,
    'meta_query'     => [
        'relation' => 'OR',
        ['key' => 'committee_track', 'value' => $slug],
        ['key' => 'committee_track', 'value' => 'all'],
    ],
]);

$role_map = [
    'Conference Chair'      => 'Organizing Committees',
    'Conference Vice Chair' => 'Organizing Committees',
    'Secretary & Finance'   => 'Organizing Committees',
    'SCIENTIFIC COMMITTEES' => 'Scientific Committee',
    'Scientific Committees' => 'Scientific Committee',
    'Event'                 => 'Event Committee',
    'OCS Personel'          => 'OCS Personnel',
];

$badge_map = [
    'Conference Chair'      => 'Chair',
    'Conference Vice Chair' => 'Vice Chair',
    'Secretary & Finance'   => 'Secretary & Finance',
];

$by_role = [];
if ($committee_q->have_posts()) {
    while ($committee_q->have_posts()) { $committee_q->the_post();
        $role_raw = trim(get_field('committee_role') ?: 'Member');
        $sub_role = $role_raw;
        $role     = $role_map[$role_raw] ?? $role_raw;
        $aff      = get_field('committee_affiliation');
        $by_role[$role][] = ['name' => get_the_title(), 'aff' => $aff, 'sub_role' => $sub_role];
    }
    wp_reset_postdata();
}

$role_order = ['Steering Committee', 'Organizing Committees', 'Scientific Committee', 'International Scientific Committee', 'Event Committee', 'Editorial Board', 'International Editorial Board', 'Editor In Chief', 'Managing Editor', 'Associate Editor', 'Article Publication', 'OCS Personnel', 'Website Administration'];

include get_template_directory() . '/template-parts/track-hero.php';
?>

<section class="section bg-surface">
    <div class="container-custom">
        <div class="grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-8 space-y-14">

                <?php if (!empty($by_role)): ?>
                    <?php foreach ($role_order as $ri => $role):
                        if (empty($by_role[$role])) continue;
                        $count = count($by_role[$role]);
                    ?>
                    <div class="reveal">
                        <div class="relative pl-5 mb-8">
                            <div class="absolute left-0 top-1 bottom-1 w-1 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                            <h2 class="text-heading text-ink font-semibold"><?php echo esc_html($role); ?></h2>
                            <p class="text-body-sm" style="color: <?php echo esc_attr($track['color']); ?>;"><?php echo esc_html($count); ?> member<?php echo $count > 1 ? 's' : ''; ?></p>
                        </div>

                        <?php if (str_contains($role, 'Organizing')): ?>
                        <?php $chair = null; $others = []; foreach ($by_role[$role] as $m) { if ($m['sub_role'] === 'Conference Chair') $chair = $m; else $others[] = $m; } $sub_order = ['Conference Vice Chair' => 0, 'Secretary & Finance' => 1]; usort($others, fn($a,$b) => ($sub_order[$a['sub_role']]??99) - ($sub_order[$b['sub_role']]??99)); ?>
                        <?php if ($chair): ?>
                        <!-- Chair — full width -->
                        <div class="space-y-3">
                            <div class="group relative bg-white rounded-xl border border-surface-200 overflow-hidden transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5">
                                <div class="absolute left-0 top-0 bottom-0 w-0.5 opacity-0 group-hover:opacity-100 transition-all duration-300" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                                <div class="flex items-center justify-between px-6 py-5">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-body font-semibold text-ink truncate"><?php echo esc_html($chair['name']); ?></p>
                                        <?php if ($chair['aff']): ?>
                                        <p class="text-caption text-ink-subtle mt-0.5 truncate"><?php echo esc_html($chair['aff']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <span class="shrink-0 ml-4 px-3 py-1 rounded-full text-caption font-semibold" style="background: <?php echo esc_attr($track['color']); ?>12; color: <?php echo esc_attr($track['color']); ?>;"><?php echo esc_html($badge_map[$chair['sub_role']] ?? $chair['sub_role']); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($others)): ?>
                        <div class="grid sm:grid-cols-2 gap-3<?php echo $chair ? ' mt-3' : ''; ?>">
                            <?php foreach ($others as $member): ?>
                            <div class="group relative bg-white rounded-xl border border-surface-200 transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute left-0 top-0 bottom-0 w-0.5 opacity-0 group-hover:opacity-100 transition-all duration-300" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                                <div class="flex items-center justify-between px-5 py-4 min-w-0">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-body-sm font-semibold text-ink truncate"><?php echo esc_html($member['name']); ?></p>
                                        <?php if ($member['aff']): ?>
                                        <p class="text-caption text-ink-subtle mt-0.5 truncate"><?php echo esc_html($member['aff']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <span class="shrink-0 ml-3 px-3 py-1 rounded-full text-caption font-semibold" style="background: <?php echo esc_attr($track['color']); ?>12; color: <?php echo esc_attr($track['color']); ?>;"><?php echo esc_html($badge_map[$member['sub_role']] ?? $member['sub_role']); ?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <?php else: ?>
                        <!-- All other roles — grid -->
                        <div class="grid sm:grid-cols-2 gap-3">
                            <?php foreach ($by_role[$role] as $member): ?>
                            <div class="group relative bg-white rounded-xl border border-surface-200 transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute left-0 top-0 bottom-0 w-0.5 opacity-0 group-hover:opacity-100 transition-all duration-300" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                                <div class="flex items-center justify-between px-5 py-4 min-w-0">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-body-sm font-semibold text-ink truncate"><?php echo esc_html($member['name']); ?></p>
                                        <?php if ($member['aff']): ?>
                                        <p class="text-caption text-ink-subtle mt-0.5 truncate"><?php echo esc_html($member['aff']); ?></p>
                                        <?php endif; ?>
                                </div>
                            </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>

                    <?php
                    // Fallback: remaining roles not in ordered list
                    $remaining = array_diff_key($by_role, array_flip($role_order));
                    foreach ($remaining as $role => $members):
                        $count = count($members);
                    ?>
                    <div class="reveal">
                        <div class="relative pl-5 mb-8">
                            <div class="absolute left-0 top-1 bottom-1 w-1 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                            <h2 class="text-heading text-ink font-semibold"><?php echo esc_html($role); ?></h2>
                            <p class="text-body-sm" style="color: <?php echo esc_attr($track['color']); ?>;"><?php echo esc_html($count); ?> member<?php echo $count > 1 ? 's' : ''; ?></p>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-3">
                            <?php foreach ($members as $member): ?>
                            <div class="group relative bg-white rounded-xl border border-surface-200 transition-all duration-300 hover:shadow-card-hover hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute left-0 top-0 bottom-0 w-0.5 opacity-0 group-hover:opacity-100 transition-all duration-300" style="background: <?php echo esc_attr($track['color']); ?>;"></div>
                                <div class="flex items-center justify-between px-5 py-4 min-w-0">
                                    <div class="min-w-0 flex-1">
                                        <p class="text-body-sm font-semibold text-ink truncate"><?php echo esc_html($member['name']); ?></p>
                                        <?php if ($member['aff']): ?>
                                        <p class="text-caption text-ink-subtle mt-0.5 truncate"><?php echo esc_html($member['aff']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                <div class="bg-white rounded-2xl border border-surface-200 p-12 text-center reveal">
                    <div class="w-20 h-20 mx-auto mb-5 rounded-full flex items-center justify-center" style="background: <?php echo esc_attr($track['color']); ?>10;">
                        <svg class="w-10 h-10" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                    </div>
                    <h3 class="text-heading text-ink mb-2">Committees To Be Announced</h3>
                    <p class="text-body text-ink-muted max-w-md mx-auto">Committee members for <?php echo esc_html($track['name']); ?> will be announced soon.</p>
                </div>
                <?php endif; ?>

            </div>

            <?php include get_template_directory() . '/template-parts/track-sidebar.php'; ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
