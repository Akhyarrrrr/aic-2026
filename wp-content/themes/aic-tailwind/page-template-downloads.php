<?php
/**
 * Template Name: Template Downloads
 * Abstract template download cards per track
 */
get_header();
?>

<?php
$title    = 'Template';
$subtitle = 'Download the abstract template for your track.';
get_template_part('template-parts/hero-inner');
?>

<section class="section bg-surface">
    <div class="container-custom">

        <!-- Section header -->
        <div class="flex items-center gap-3 mb-8 reveal">
            <span class="w-1.5 h-6 rounded-full bg-primary"></span>
            <h2 class="text-heading-lg text-ink">Abstract Templates</h2>
        </div>

        <p class="text-body text-ink-muted mb-10 reveal max-w-3xl">Download the abstract template for your respective track. Follow the formatting guidelines provided in the template when preparing your submission.</p>

        <!-- Download cards -->
        <div class="grid md:grid-cols-3 gap-6 reveal-stagger">
            <?php
            $dl_tracks = [
                ['slug' => 'se',  'field' => 'tmpl_abstract_se',  'color' => '#F79007', 'code' => 'AIC-SE',  'name' => 'Sciences & Engineering'],
                ['slug' => 'els', 'field' => 'tmpl_abstract_els', 'color' => '#137622', 'code' => 'AIC-ELS', 'name' => 'Environmental & Life Sciences'],
                ['slug' => 'ss',  'field' => 'tmpl_abstract_ss',  'color' => '#AA39AF', 'code' => 'AIC-SS',  'name' => 'Social Sciences'],
            ];
            foreach ($dl_tracks as $dl):
                $file_id = get_option('aic_' . $dl['field'], 0);
                $url = $file_id ? wp_get_attachment_url($file_id) : '';
            ?>
            <div class="bg-white rounded-2xl border border-surface-300/60 p-7 text-center group hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-300">
                    <div class="w-14 h-14 mx-auto rounded-xl flex items-center justify-center mb-5" style="background: <?php echo esc_attr($dl['color']); ?>15;">
                        <svg class="w-7 h-7" style="color: <?php echo esc_attr($dl['color']); ?>;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                    <span class="inline-block px-3 py-1 rounded-full text-caption font-semibold uppercase tracking-wider mb-3" style="background: <?php echo esc_attr($dl['color']); ?>15; color: <?php echo esc_attr($dl['color']); ?>;"><?php echo esc_html($dl['code']); ?></span>
                    <h3 class="text-heading-sm text-ink font-semibold mb-2"><?php echo esc_html($dl['name']); ?></h3>
                    <p class="text-caption text-ink-subtle mb-5">Abstract Template (.docx)</p>
                    <?php if ($url): ?>
                    <a href="<?php echo esc_url($url); ?>" class="inline-flex items-center gap-1.5 text-body-sm font-medium no-underline transition-colors" style="color: <?php echo esc_attr($dl['color']); ?>;" download>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        Download
                    </a>
                    <?php else: ?>
                    <p class="text-caption italic" style="color: <?php echo esc_attr($dl['color']); ?>;">Template not yet uploaded</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>
