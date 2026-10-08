<?php
/**
 * Track sidebar — shared across all track pages
 * Expects: $track (color, name, code), $slug, $parent_id
 */
$tmpl_field  = 'tmpl_abstract_' . $slug;
$tmpl_file_id = get_option('aic_' . $tmpl_field, 0);
$tmpl_url    = $tmpl_file_id ? wp_get_attachment_url($tmpl_file_id) : '';
?>
<aside class="lg:col-span-4 space-y-5 self-start">
    <!-- Important Dates -->
    <div class="track-dates" style="--dates-background: <?php echo esc_attr($track['color']); ?>; --dates-foreground: <?php echo esc_attr(aic_track_foreground($slug)); ?>; --dates-divider: rgba(255,255,255,0.25);">
        <div class="flex items-center gap-2.5 mb-2">
            <svg class="w-5 h-5 shrink-0" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
            <h3 class="text-heading-sm font-semibold tracking-tight">Important Dates</h3>
        </div>
        <p class="track-dates-intro">Key deadlines for <?php echo esc_html($track['code']); ?></p>
        <div>
            <?php
            $dates = get_option('aic_important_dates', []);
            if (!empty($dates)):
                foreach ($dates as $d):
            ?>
            <div class="track-date-row <?php echo aic_deadline_extended($d) ? 'track-date-row-extended' : ''; ?>">
                <p class="track-date-label"><?php echo esc_html($d['date_label']); ?><?php if (aic_deadline_extended($d)) aic_deadline_badge($slug); ?></p>
                <p class="track-date-value">
                    <?php aic_render_deadline_value($d, 'track-date-old', 'track-date-new'); ?>
                </p>
            </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>

    <!-- Submit -->
    <?php
    $submit_url = get_option('aic_submit_url_' . $slug, '');
    if ($submit_url):
    ?>
    <a href="<?php echo esc_url($submit_url); ?>" target="_blank" rel="noopener" class="flex items-center justify-center gap-2 w-full px-4 py-3.5 rounded-xl font-medium text-body-sm transition-all hover:opacity-90 active:scale-[0.98] no-underline" style="background: <?php echo esc_attr($track['color']); ?>; color: <?php echo esc_attr(aic_track_foreground($slug)); ?>;">
        Submit to <?php echo esc_html($track['code']); ?>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
    </a>
    <?php endif; ?>

    <!-- Download Template -->
    <div class="bg-white rounded-2xl border border-surface-300/60 p-5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: <?php echo esc_attr($track['color']); ?>10;">
                <svg class="w-5 h-5" style="color: <?php echo esc_attr($track['color']); ?>;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            </div>
            <div>
                <p class="text-body-sm font-semibold text-ink">Template Abstract</p>
                <p class="text-caption text-ink-subtle">.docx format</p>
            </div>
        </div>
        <?php if ($tmpl_url): ?>
        <a href="<?php echo esc_url($tmpl_url); ?>" class="flex items-center justify-center gap-2 w-full min-h-[44px] py-2.5 rounded-lg text-body-sm font-medium transition-all hover:opacity-90 no-underline" style="color: <?php echo esc_attr(aic_track_ink($slug)); ?>; background: <?php echo esc_attr($track['color']); ?>10;" download>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Download
        </a>
        <?php else: ?>
        <p class="text-caption text-ink-subtle italic text-center">Template not yet uploaded</p>
        <?php endif; ?>
    </div>

</aside>
