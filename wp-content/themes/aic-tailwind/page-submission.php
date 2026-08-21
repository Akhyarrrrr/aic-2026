<?php
/**
 * Template Name: Paper Submission
 * Paper submission process and publication info
 */
get_header();

$title    = 'Paper Submission & Publication';
$subtitle = 'Step-by-step guide to submitting your paper and publication details for AIC 2026.';
?>
<?php get_template_part('template-parts/hero-inner'); ?>

<section class="section bg-surface">
    <div class="container-custom">

        <!-- Submission Steps — two-column layout -->
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20 mb-20 reveal">
            <div class="lg:col-span-5">
                <p class="text-accent text-body-sm font-semibold uppercase tracking-wider mb-4">How It Works</p>
                <h2 class="text-display text-ink mb-6 text-balance">
                    Submission<br class="hidden lg:block"> Process
                </h2>
                <div class="w-16 h-1 bg-accent rounded-full mb-6"></div>
                <p class="text-body text-ink-muted">Follow these five steps to submit your abstract and full paper to AIC 2026.</p>
            </div>
            <div class="lg:col-span-7">
                <?php
                $steps = [
                    ['title' => 'Prepare Your Abstract', 'desc' => 'Write 250-300 words following the conference template for your track. Include objectives, methods, results, and conclusions.'],
                    ['title' => 'Submit via Online System', 'desc' => 'Upload your abstract through the online submission system for your track (AIC-SE, AIC-ELS, or AIC-SS).'],
                    ['title' => 'Receive Acceptance', 'desc' => 'Abstracts are reviewed on a rolling basis. You will receive an acceptance notification within 2-3 days.'],
                    ['title' => 'Submit Full Paper', 'desc' => 'Upon acceptance, prepare and submit your full paper by October 31, 2026, following the template guidelines.'],
                    ['title' => 'Register & Pay Fee', 'desc' => 'Complete your registration and pay the registration fee to confirm your participation and secure your slot.'],
                ];
                ?>
                <div class="relative">
                    <div class="absolute left-5 top-5 bottom-5 w-px bg-surface-300"></div>
                    <div class="space-y-6">
                        <?php foreach ($steps as $i => $step): ?>
                        <div class="flex gap-5 relative">
                            <div class="step-number relative z-10"><?php echo $i + 1; ?></div>
                            <div class="bg-white rounded-xl border border-surface-200 p-6 flex-1 hover:shadow-card transition-shadow">
                                <h3 class="text-heading-sm text-ink font-semibold mb-2"><?php echo esc_html($step['title']); ?></h3>
                                <p class="text-body-sm text-ink-muted leading-relaxed"><?php echo esc_html($step['desc']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submission Links + Publication — two-column -->
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 mb-20 reveal">
            <!-- Submission Links -->
            <div class="bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    </div>
                    <h2 class="text-heading-lg text-ink">Online Submission</h2>
                </div>
                <div class="grid sm:grid-cols-3 gap-3">
                    <?php
                    $submit_urls = [
                        'se'  => get_option('aic_submit_url_se', 'https://conference.usk.ac.id/AIC-SE/'),
                        'els' => get_option('aic_submit_url_els', 'https://conference.usk.ac.id/AIC-ELS/'),
                        'ss'  => get_option('aic_submit_url_ss', 'https://conference.usk.ac.id/AIC-SS/'),
                    ];
                    foreach ($submit_urls as $slug => $url):
                        $color = aic_track_color($slug);
                        $code  = aic_track_code($slug);
                    ?>
                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="flex flex-col items-center text-center p-5 rounded-xl border-2 border-surface-200 hover:shadow-card transition-all no-underline group">
                        <span class="inline-block px-3 py-1 rounded-full text-caption font-semibold uppercase tracking-wider mb-3" style="background: <?php echo esc_attr($color); ?>15; color: <?php echo esc_attr($color); ?>;"><?php echo esc_html($code); ?></span>
                        <p class="text-body-sm text-ink font-medium group-hover:text-primary transition-colors">Submit to <?php echo esc_html($code); ?></p>
                        <svg class="w-4 h-4 text-surface-400 mt-2 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Publication Info -->
            <div class="bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                    </div>
                    <h2 class="text-heading-lg text-ink">Publication</h2>
                </div>
                <div class="space-y-4">
                    <div class="flex gap-4 p-5 rounded-xl border border-surface-200">
                        <div class="w-2 h-2 rounded-full mt-2 shrink-0" style="background: <?php echo esc_attr(aic_track_color('se')); ?>;"></div>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">AIC-SE &amp; AIC-ELS — Scopus-Indexed</p>
                            <p class="text-body-sm text-ink-muted leading-relaxed">Accepted papers published in Scopus-indexed proceedings. APC of <strong class="text-ink">IDR 2,300,000</strong> applies.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-5 rounded-xl border border-surface-200">
                        <div class="w-2 h-2 rounded-full mt-2 shrink-0" style="background: <?php echo esc_attr(aic_track_color('ss')); ?>;"></div>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">AIC-SS — SINTA 2-Accredited</p>
                            <p class="text-body-sm text-ink-muted leading-relaxed">Published in SINTA 2 journals. APC paid by authors directly to the journal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA — full width green section -->
        <div class="bg-primary rounded-2xl p-10 lg:p-16 text-center relative overflow-hidden reveal">
            <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 80% 20%, #C7982C 1px, transparent 1px); background-size: 32px 32px;"></div>
            <div class="relative z-10">
                <h2 class="text-display-sm text-white mb-4">Ready to Submit?</h2>
                <p class="text-surface-400 text-body-lg mb-8 max-w-xl mx-auto">Submit your abstract today and be part of AIC <?php echo intval(get_option('aic_edition', '16')); ?>.</p>
                <a href="https://conference.usk.ac.id/" target="_blank" rel="noopener" class="btn-accent btn-lg no-underline">
                    View Call for Paper
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>
