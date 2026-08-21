<?php
/**
 * Template Name: Paper Template
 * Download abstract/paper templates for each track
 */
get_header();

$title    = 'Paper Template';
$subtitle = 'Download the abstract and paper templates for AIC 2026.';
?>
<?php get_template_part('template-parts/hero-inner'); ?>

<section class="section bg-surface">
    <div class="container-custom">

        <!-- Section header — left-aligned like homepage About -->
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20 mb-16 reveal">
            <div class="lg:col-span-5">
                <p class="text-accent text-body-sm font-semibold uppercase tracking-wider mb-4">Templates</p>
                <h2 class="text-display text-ink mb-6 text-balance">
                    Abstract & Paper<br class="hidden lg:block"> Templates
                </h2>
                <div class="w-16 h-1 bg-accent rounded-full mb-6"></div>
                <p class="text-body text-ink-muted">Download the template files for your track. Use the correct format when preparing your abstract and full paper.</p>
            </div>
            <div class="lg:col-span-7">
                <div class="grid sm:grid-cols-3 gap-6">
                    <?php
                    $templates = [
                        ['slug' => 'se',  'url' => wp_get_attachment_url(get_option('aic_tmpl_abstract_se', 0)) ?: '',  'label' => 'Abstract Template'],
                        ['slug' => 'els', 'url' => wp_get_attachment_url(get_option('aic_tmpl_abstract_els', 0)) ?: '', 'label' => 'Abstract Template'],
                        ['slug' => 'ss',  'url' => wp_get_attachment_url(get_option('aic_tmpl_abstract_ss', 0)) ?: '',  'label' => 'Abstract Template'],
                    ];
                    foreach ($templates as $t):
                        $color = aic_track_color($t['slug']);
                        $name  = aic_track_name($t['slug']);
                        $code  = aic_track_code($t['slug']);
                    ?>
                    <div class="group relative bg-white rounded-2xl border border-surface-300/60 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover">
                        <div class="h-1.5 w-full" style="background: <?php echo esc_attr($color); ?>;"></div>
                        <div class="p-7 flex flex-col items-center text-center">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 transition-colors" style="background: <?php echo esc_attr($color); ?>10;">
                                <?php if ($t['slug'] === 'se'): ?>
                                    <svg class="w-7 h-7" style="color: <?php echo esc_attr($color); ?>;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                                <?php elseif ($t['slug'] === 'els'): ?>
                                    <svg class="w-7 h-7" style="color: <?php echo esc_attr($color); ?>;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                <?php else: ?>
                                    <svg class="w-7 h-7" style="color: <?php echo esc_attr($color); ?>;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <?php endif; ?>
                            </div>
                            <span class="inline-block px-3 py-1 rounded-full text-caption font-semibold uppercase tracking-wider mb-3" style="background: <?php echo esc_attr($color); ?>15; color: <?php echo esc_attr($color); ?>;"><?php echo esc_html($code); ?></span>
                            <h3 class="text-heading-sm text-ink font-semibold mb-1"><?php echo esc_html($name); ?></h3>
                            <p class="text-caption text-ink-muted mb-5"><?php echo esc_html($t['label']); ?></p>
                            <?php if ($t['url']): ?>
                            <a href="<?php echo esc_url($t['url']); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-body-sm font-medium text-white transition-all hover:opacity-90 active:scale-[0.98] no-underline" style="background: <?php echo esc_attr($color); ?>;">
                                Download
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            </a>
                            <?php else: ?>
                            <p class="text-caption text-ink-subtle italic">Template not yet uploaded</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Book of Program — full width -->
        <div class="reveal">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-6 rounded-full bg-primary"></div>
                <h2 class="text-heading-lg text-ink">Book of Program</h2>
            </div>
            <div class="grid sm:grid-cols-3 gap-6">
                <?php
                $programs = [
                    ['slug' => 'se',  'url' => wp_get_attachment_url(get_option('aic_tmpl_program_se', 0)) ?: ''],
                    ['slug' => 'els', 'url' => wp_get_attachment_url(get_option('aic_tmpl_program_els', 0)) ?: ''],
                    ['slug' => 'ss',  'url' => wp_get_attachment_url(get_option('aic_tmpl_program_ss', 0)) ?: ''],
                ];
                foreach ($programs as $p):
                    $color = aic_track_color($p['slug']);
                    $name  = aic_track_name($p['slug']);
                    $code  = aic_track_code($p['slug']);
                ?>
                <div class="group relative bg-white rounded-2xl border border-surface-300/60 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-card-hover">
                    <div class="h-1.5 w-full" style="background: <?php echo esc_attr($color); ?>;"></div>
                    <div class="p-7 flex flex-col items-center text-center">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4" style="background: <?php echo esc_attr($color); ?>10;">
                            <svg class="w-7 h-7" style="color: <?php echo esc_attr($color); ?>;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                        </div>
                        <span class="inline-block px-3 py-1 rounded-full text-caption font-semibold uppercase tracking-wider mb-3" style="background: <?php echo esc_attr($color); ?>15; color: <?php echo esc_attr($color); ?>;"><?php echo esc_html($code); ?></span>
                        <h3 class="text-heading-sm text-ink font-semibold mb-1"><?php echo esc_html($name); ?></h3>
                        <p class="text-caption text-ink-muted mb-5">Book of Program</p>
                        <?php if ($p['url']): ?>
                        <a href="<?php echo esc_url($p['url']); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-body-sm font-medium text-white transition-all hover:opacity-90 active:scale-[0.98] no-underline" style="background: <?php echo esc_attr($color); ?>;">
                            Download
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        </a>
                        <?php else: ?>
                        <p class="text-caption text-ink-subtle italic">Program not yet uploaded</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>
