<?php
/**
 * Template Name: Track Registration
 * Registration & Publication Fee per track
 */
get_header();

$parent_id = wp_get_post_parent_id(get_the_ID());
$slug      = $parent_id ? get_post_field('post_name', $parent_id) : get_post_field('post_name');

$track_config = [
    'se'  => ['color' => '#F79007', 'name' => 'Sciences &amp; Engineering', 'code' => 'AIC-SE'],
    'els' => ['color' => '#137622', 'name' => 'Environmental &amp; Life Sciences', 'code' => 'AIC-ELS'],
    'ss'  => ['color' => '#AA39AF', 'name' => 'Social Sciences',         'code' => 'AIC-SS'],
];
$track     = $track_config[$slug] ?? $track_config['se'];
$parent_id = $parent_id ?: get_the_ID();

$hero_title    = 'Registration &amp; Publication Fee';
$hero_subtitle = 'Complete your registration and explore publication options for ' . $track['name'] . '.';

include get_template_directory() . '/template-parts/track-hero.php';

// Per-track publication / fee notes — editable via AIC Settings
$fee_notes     = get_option('aic_fee_notes_' . $slug, '');
$pub_info_text = get_option('aic_pub_info_' . $slug, '');
$submit_url    = get_option('aic_submit_url_' . $slug, '');

$fee_presenter_domestic = get_option('aic_fee_presenter_domestic', 'IDR 500,000');
$fee_presenter_intl     = get_option('aic_fee_presenter_intl', 'USD 50');
$fee_nonpresenter_dom   = get_option('aic_fee_nonpresenter_domestic', 'IDR 350,000');
$fee_nonpresenter_intl  = get_option('aic_fee_nonpresenter_intl', 'USD 35');
?>

<section class="section bg-surface">
    <div class="container-custom">
        <div class="grid lg:grid-cols-12 gap-12">

            <!-- Main Content -->
            <div class="lg:col-span-8 space-y-12">

                <!-- ============================================
                     SECTION 1 — Registration Procedure
                     ============================================ -->
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></span>
                        <h2 class="text-heading-lg text-ink">Registration Procedure</h2>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <!-- Step 1 -->
                        <div class="bg-white rounded-2xl border border-surface-200 p-6">
                            <div class="flex items-center gap-2.5 mb-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background: <?php echo esc_attr($track['color']); ?>;">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <h3 class="text-body font-semibold text-ink">Receive Letter of Acceptance</h3>
                            </div>
                                <p class="text-body-sm text-ink-muted leading-relaxed">Registration as <strong class="text-ink">presenter</strong> should be done only after receiving the <strong class="text-ink">Letter of Acceptance (LoA)</strong> for your abstract.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="bg-white rounded-2xl border border-surface-200 p-6">
                            <div class="flex items-center gap-2.5 mb-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background: <?php echo esc_attr($track['color']); ?>;">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <h3 class="text-body font-semibold text-ink">Pay Registration Fee</h3>
                            </div>
                                <p class="text-body-sm text-ink-muted leading-relaxed">Complete your registration by paying the registration fee and filling out the <strong class="text-ink">registration form</strong> as instructed in the LoA email.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================
                     SECTION 2 — Registration Fees
                     ============================================ -->
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></span>
                        <h2 class="text-heading-lg text-ink">Registration Fees</h2>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <!-- Presenter -->
                        <div class="bg-white rounded-2xl border border-surface-200 p-6 hover:shadow-card-hover transition-shadow duration-300">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background: <?php echo esc_attr($track['color']); ?>10;">
                                    <svg class="w-5 h-5" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <div>
                                    <p class="text-body-sm font-semibold text-ink">Presenter</p>
                                    <p class="text-caption text-ink-subtle">General &amp; Student</p>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-surface-200">
                                <p class="text-display-sm font-bold text-ink mb-1"><?php echo esc_html($fee_presenter_domestic); ?></p>
                                <p class="text-body-sm text-ink-muted"><?php echo esc_html($fee_presenter_intl); ?> (International)</p>
                            </div>
                        </div>

                        <!-- Non-Presenter -->
                        <div class="bg-white rounded-2xl border border-surface-200 p-6 hover:shadow-card-hover transition-shadow duration-300">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background: <?php echo esc_attr($track['color']); ?>10;">
                                    <svg class="w-5 h-5" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-body-sm font-semibold text-ink">Non-Presenter</p>
                                    <p class="text-caption text-ink-subtle">Participant only</p>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-surface-200">
                                <p class="text-display-sm font-bold text-ink mb-1"><?php echo esc_html($fee_nonpresenter_dom); ?></p>
                                <p class="text-body-sm text-ink-muted"><?php echo esc_html($fee_nonpresenter_intl); ?> (International)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================
                     SECTION 3 — Important Notes (per-track)
                     ============================================ -->
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></span>
                        <h2 class="text-heading-lg text-ink">Important Notes</h2>
                    </div>

                    <div class="rounded-2xl border-l-4 p-6 lg:p-8" style="border-left-color: <?php echo esc_attr($track['color']); ?>; background: <?php echo esc_attr($track['color']); ?>05;">
                        <div class="flex gap-4">
                            <svg class="w-6 h-6 shrink-0 mt-0.5" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div class="space-y-3 text-body-sm text-ink-muted leading-relaxed">
                                <?php if ($fee_notes): ?>
                                    <?php echo wp_kses_post(wpautop($fee_notes)); ?>
                                <?php else: ?>
                                    <?php if ($slug === 'ss'): ?>
                                        <p>The registration fee <strong class="text-ink">does not include</strong> the cost for publication to proceedings or selected journals.</p>
                                        <p>Papers selected for publication in journals will pay the publication fee <strong class="text-ink">at cost</strong> according to the selected journal's APC.</p>
                                    <?php elseif ($slug === 'se'): ?>
                                        <p>The registration fee <strong class="text-ink">does not include</strong> the cost for publication to Scopus-indexed proceedings or selected journals.</p>
                                        <p>An <strong class="text-ink">additional payment of IDR 2,300,000</strong> will be requested for publication in Scopus-indexed proceedings after the paper passes the peer-review round for those who choose to publish their full paper with us.</p>
                                        <p>Papers selected for publication in journals will pay the publication fee <strong class="text-ink">at cost</strong> according to the selected journal's APC.</p>
                                    <?php else: ?>
                                        <p>The registration fee <strong class="text-ink">does not include</strong> the cost for publication to Scopus-indexed proceedings.</p>
                                        <p>An <strong class="text-ink">additional payment of IDR 2,300,000</strong> will be requested for publication in Scopus-indexed proceedings after the paper passes the peer-review round for those who choose to publish their full paper with us.</p>
                                    <?php endif; ?>
                                    <p>The registration fee for presenters remains <strong class="text-ink">consistent</strong> for presentation in online mode or offline mode.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================
                     SECTION 4 — Abstract & Full Paper Submission
                     ============================================ -->
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></span>
                        <h2 class="text-heading-lg text-ink">Abstract &amp; Full Paper Submission</h2>
                    </div>

                    <div class="bg-white rounded-2xl border border-surface-200 p-6 lg:p-8 space-y-0">
                        <?php
                        $steps = [
                            [
                                'num' => '1',
                                'title' => 'Submit Electronically',
                                'desc' => $submit_url
                                    ? 'Authors are invited to submit their manuscripts electronically through the <a href="' . esc_url($submit_url) . '" target="_blank" rel="noopener" class="font-medium underline" style="color: ' . esc_attr($track['color']) . ';">conference submission system</a>.'
                                    : 'Authors are invited to submit their manuscripts electronically through the conference submission system (OCS).',
                            ],
                            [
                                'num' => '2',
                                'title' => 'Maximum Submissions',
                                'desc' => 'Each author is limited to submit a maximum of <strong class="text-ink">two abstracts</strong> (as main author or co-author).',
                            ],
                            [
                                'num' => '3',
                                'title' => 'Abstract-Only Option',
                                'desc' => 'Authors who prefer <strong class="text-ink">not to have their papers published</strong> are allowed to submit abstracts for presentation only at the conference.',
                            ],
                            [
                                'num' => '4',
                                'title' => 'Book of Program',
                                'desc' => 'All accepted abstracts will be included in the <strong class="text-ink">AIC 2026 Book of Program</strong>.',
                            ],
                            [
                                'num' => '5',
                                'title' => 'Proceed After Acceptance',
                                'desc' => 'Only after receiving notification of abstract acceptance (LoA for Abstract) may you proceed with completing your <strong class="text-ink">registration payment</strong> and submitting your <strong class="text-ink">full paper</strong>.',
                            ],
                        ];
                        foreach ($steps as $i => $step):
                            $last = $i === count($steps) - 1;
                        ?>
                        <div class="flex gap-4 <?php echo !$last ? 'pb-5 mb-5 border-b border-surface-200' : ''; ?>">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 text-white text-body-sm font-bold" style="background: <?php echo esc_attr($track['color']); ?>;">
                                <?php echo $step['num']; ?>
                            </div>
                            <div>
                                <h3 class="text-body font-semibold text-ink mb-1"><?php echo esc_html($step['title']); ?></h3>
                                <p class="text-body-sm text-ink-muted leading-relaxed"><?php echo $step['desc']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- ============================================
                     SECTION 5 — Publication (per-track)
                     ============================================ -->
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-1.5 h-6 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>;"></span>
                        <h2 class="text-heading-lg text-ink">Publication</h2>
                    </div>

                    <?php if ($pub_info_text): ?>
                        <div class="bg-white rounded-2xl border border-surface-200 p-6 lg:p-8">
                            <div class="prose prose-sm max-w-none text-ink-muted">
                                <?php echo wp_kses_post(wpautop($pub_info_text)); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php if ($slug === 'els'): ?>
                        <div class="bg-white rounded-2xl border border-surface-200 p-6 lg:p-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background: <?php echo esc_attr($track['color']); ?>10;">
                                    <svg class="w-6 h-6" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-heading-sm text-ink font-semibold mb-2">Scopus-Indexed Proceedings</h3>
                                    <p class="text-body-sm text-ink-muted leading-relaxed">Accepted papers will be published in the <strong class="text-ink">Scopus-indexed proceedings</strong>.</p>
                                </div>
                            </div>
                        </div>

                        <?php elseif ($slug === 'se'): ?>
                        <div class="space-y-5">
                            <div class="bg-white rounded-2xl border border-surface-200 p-6 lg:p-8">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background: <?php echo esc_attr($track['color']); ?>10;">
                                        <svg class="w-6 h-6" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="text-heading-sm text-ink font-semibold mb-2">Scopus-Indexed Proceedings</h3>
                                        <p class="text-body-sm text-ink-muted leading-relaxed">Accepted papers will be published in the <strong class="text-ink">Scopus-indexed proceedings</strong>.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl border border-surface-200 p-6 lg:p-8">
                                <div class="flex items-start gap-4 mb-5">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background: <?php echo esc_attr($track['color']); ?>10;">
                                        <svg class="w-6 h-6" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="text-heading-sm text-ink font-semibold mb-2">Partner Journals</h3>
                                        <p class="text-body-sm text-ink-muted leading-relaxed">Papers may also be selected for publication in the following journals. Selection is based on <strong class="text-ink">quality and scope</strong> by the editorial board.</p>
                                    </div>
                                </div>
                                <div class="grid sm:grid-cols-3 gap-3">
                                    <?php
                                    $se_journals = [
                                        ['name' => 'JEEEMI', 'tier' => 'Scopus Q3', 'full' => 'Journal of Electronics, Electromedical Engineering, and Medical Informatics'],
                                        ['name' => 'INFOTEL', 'tier' => 'SINTA 1', 'full' => ''],
                                        ['name' => 'IJEEEMI', 'tier' => 'SINTA 2', 'full' => ''],
                                    ];
                                    foreach ($se_journals as $j):
                                    ?>
                                    <div class="rounded-xl p-4 text-center border border-surface-200" style="background: <?php echo esc_attr($track['color']); ?>05;">
                                        <p class="text-body-sm font-bold text-ink mb-0.5"><?php echo esc_html($j['name']); ?></p>
                                        <span class="text-caption font-semibold px-2 py-0.5 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>15; color: <?php echo esc_attr($track['color']); ?>;"><?php echo esc_html($j['tier']); ?></span>
                                        <?php if ($j['full']): ?>
                                        <p class="text-caption text-ink-subtle mt-1.5 leading-snug"><?php echo esc_html($j['full']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <?php else: ?>
                        <div class="bg-white rounded-2xl border border-surface-200 p-6 lg:p-8">
                            <div class="flex items-start gap-4 mb-5">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0" style="background: <?php echo esc_attr($track['color']); ?>10;">
                                    <svg class="w-6 h-6" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-heading-sm text-ink font-semibold mb-2">Accredited Journals</h3>
                                    <p class="text-body-sm text-ink-muted leading-relaxed">Accepted papers will be published in partner journals. The publication venue is determined by <strong class="text-ink">quality and scope</strong> of the submitted papers, based on the editorial board's assessment.</p>
                                </div>
                            </div>
                            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                <?php
                                $ss_journals = [
                                    ['name' => 'SIELE', 'tier' => 'Scopus Q3'],
                                    ['name' => 'Jaroe', 'tier' => 'SINTA 2'],
                                    ['name' => 'JABD', 'tier' => 'SINTA 2', 'full' => 'Journal of Accounting and Business Dynamics'],
                                    ['name' => 'JIS', 'tier' => 'SINTA 2', 'full' => 'Jurnal Ilmu Sosial'],
                                    ['name' => 'EEJ', 'tier' => 'SINTA 2', 'full' => 'English Education Journal'],
                                ];
                                foreach ($ss_journals as $j):
                                ?>
                                <div class="rounded-xl p-4 text-center border border-surface-200" style="background: <?php echo esc_attr($track['color']); ?>05;">
                                    <p class="text-body-sm font-bold text-ink mb-0.5"><?php echo esc_html($j['name']); ?></p>
                                    <span class="text-caption font-semibold px-2 py-0.5 rounded-full" style="background: <?php echo esc_attr($track['color']); ?>15; color: <?php echo esc_attr($track['color']); ?>;"><?php echo esc_html($j['tier']); ?></span>
                                    <?php if (!empty($j['full'])): ?>
                                    <p class="text-caption text-ink-subtle mt-1.5 leading-snug"><?php echo esc_html($j['full']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Sidebar -->
            <?php include get_template_directory() . '/template-parts/track-sidebar.php'; ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
