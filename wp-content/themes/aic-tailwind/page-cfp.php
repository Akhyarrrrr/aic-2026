<?php
/**
 * Template Name: Call for Paper
 */
get_header();
?>

<?php
$title    = 'Call for Paper';
$subtitle = 'Submit your research to the 16th Annual International Conference 2026.';
get_template_part('template-parts/hero-inner');
?>

<!-- Content -->
<section class="section bg-surface">
    <div class="container-custom">

        <!-- Intro — wide layout like homepage About -->
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20 mb-16 reveal">
            <div class="lg:col-span-5">
                <p class="text-accent text-body-sm font-semibold uppercase tracking-wider mb-4">Call for Papers</p>
                <h2 class="text-display-sm lg:text-display text-ink mb-6 text-balance">
                    Share your research<br class="hidden lg:block"> with the world
                </h2>
                <div class="w-16 h-1 bg-accent rounded-full"></div>
            </div>
            <div class="lg:col-span-7">
                <div class="prose-custom space-y-4">
                    <p class="text-body-lg">
                        We are excited to announce the <strong class="text-ink">Call for Papers for the 16th AIC 2026</strong>, inviting submissions across three specialized tracks.
                    </p>
                    <p>
                        The conference will be held on <strong class="text-ink">November 4-5, 2026</strong> in Banda Aceh, Indonesia (hybrid: online and on-site). Present your work and network with peers from around the world.
                    </p>
                </div>
            </div>
        </div>

        <!-- 3 Track Cards — full width grid like homepage Tracks section -->
        <div class="mb-20 reveal-stagger">
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                <?php
                $cfp_tracks = [
                    ['name' => 'Sciences & Engineering', 'code' => 'AIC-SE', 'color' => '#F79007', 'desc' => 'Civil Engineering, Architecture, Urban Planning, Geology, Mechanical, Industrial Engineering, Computer Science, and related fields.', 'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>'],
                    ['name' => 'Environmental & Life Sciences', 'code' => 'AIC-ELS', 'color' => '#137622', 'desc' => 'Ecology, Conservation, Agriculture, Biology, Biotechnology, Chemistry, Marine Sciences, and green technology.', 'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>'],
                    ['name' => 'Social Sciences', 'code' => 'AIC-SS', 'color' => '#AA39AF', 'desc' => 'Sociology, Economics, Education, Psychology, Political Science, Law, and Humanities.', 'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>'],
                ];
                foreach ($cfp_tracks as $t):
                ?>
                <div class="group relative bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-10 transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover"
                     style="--track-hover: <?php echo esc_attr($t['color']); ?>;">
                    <!-- Color accent top bar -->
                    <div class="absolute top-0 left-0 right-0 h-1 rounded-t-2xl transition-all duration-300 group-hover:h-1.5" style="background: <?php echo esc_attr($t['color']); ?>;"></div>

                    <div class="mb-4" style="color: <?php echo esc_attr($t['color']); ?>"><?php echo $t['icon']; ?></div>
                    <span class="text-caption font-semibold uppercase tracking-wider" style="color: <?php echo esc_attr($t['color']); ?>;"><?php echo esc_html($t['code']); ?></span>
                    <h3 class="text-heading text-ink font-semibold mt-2 mb-3 group-hover:opacity-80 transition-opacity track-title"><?php echo esc_html($t['name']); ?></h3>
                    <p class="text-body-sm text-ink-muted leading-relaxed"><?php echo esc_html($t['desc']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Two-column: Important Dates + Submission Guidelines -->
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 mb-20 reveal">
            <!-- Important Dates -->
            <?php
            $important_dates = get_option('aic_important_dates', []);
            if (empty($important_dates)) {
                $important_dates = [
                    ['date_label' => 'Abstract Submission Deadline', 'date_value' => 'September 19, 2026', 'date_desc' => ''],
                    ['date_label' => 'Abstract Acceptance Notification', 'date_value' => '2-3 Days After Submission', 'date_desc' => ''],
                    ['date_label' => 'Full Paper Submission', 'date_value' => 'October 31, 2026', 'date_desc' => ''],
                    ['date_label' => 'Conference Days', 'date_value' => 'November 4-5, 2026', 'date_desc' => ''],
                ];
            }
            ?>
            <div class="bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                    </div>
                    <h2 class="text-heading-lg text-ink">Important Dates</h2>
                </div>
                <div class="space-y-0">
                    <?php foreach ($important_dates as $i => $d): ?>
                    <div class="flex items-center justify-between py-4 <?php echo $i < count($important_dates) - 1 ? 'border-b border-surface-200' : ''; ?>">
                        <div>
                            <span class="text-body text-ink-muted"><?php echo esc_html($d['date_label']); ?></span>
                            <?php if (!empty($d['date_desc'])): ?>
                                <p class="text-body-sm text-ink-subtle mt-1"><?php echo esc_html($d['date_desc']); ?></p>
                            <?php endif; ?>
                        </div>
                        <span class="text-body-sm font-semibold text-ink shrink-0 ml-4"><?php echo esc_html($d['date_value']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Submission Guidelines -->
            <div class="bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15a2.25 2.25 0 012.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                    </div>
                    <h2 class="text-heading-lg text-ink">Submission Guidelines</h2>
                </div>
                <ol class="space-y-4">
                    <li class="flex gap-4">
                        <span class="step-number shrink-0">1</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Prepare Your Abstract</p>
                            <p class="text-body-sm text-ink-muted">Write 250-300 words following the conference template for your track.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="step-number shrink-0">2</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Submit Online</p>
                            <p class="text-body-sm text-ink-muted">Upload through the submission system for AIC-SE, AIC-ELS, or AIC-SS.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="step-number shrink-0">3</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Get Notification</p>
                            <p class="text-body-sm text-ink-muted">Rolling review — receive acceptance within 2-3 days of submission.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="step-number shrink-0">4</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Submit Full Paper</p>
                            <p class="text-body-sm text-ink-muted">Upon acceptance, submit your full paper by October 31, 2026.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="step-number shrink-0">5</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Register & Pay</p>
                            <p class="text-body-sm text-ink-muted">Complete registration and payment to confirm your participation.</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>

        <!-- CTA — full width green section like homepage -->
        <div class="bg-primary rounded-2xl p-10 lg:p-16 text-center relative overflow-hidden reveal">
            <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 80% 20%, #C7982C 1px, transparent 1px); background-size: 32px 32px;"></div>
            <div class="relative z-10">
                <h2 class="text-display-sm text-white mb-4">Ready to Submit?</h2>
                <p class="text-surface-400 text-body-lg mb-8 max-w-xl mx-auto">Submit your abstract today and be part of AIC <?php echo intval(get_option('aic_edition', '16')); ?>.</p>
                <a href="https://conference.usk.ac.id/" target="_blank" rel="noopener" class="btn-accent btn-lg no-underline">
                    Submit Abstract
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>
