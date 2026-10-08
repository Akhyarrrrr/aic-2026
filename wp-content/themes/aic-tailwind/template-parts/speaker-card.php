<?php
/** Speaker card. Pass a grouped speaker through get_template_part() arguments. */
$speaker = $args['speaker'] ?? null;
if (!$speaker) return;
?>
<a href="<?php echo esc_url($speaker['url']); ?>" class="speaker-profile <?php echo $speaker['is_keynote'] ? 'speaker-profile-keynote' : 'speaker-profile-invited'; ?>" aria-label="<?php echo esc_attr('View profile: ' . $speaker['name']); ?>">
    <div class="speaker-portrait">
        <?php if (has_post_thumbnail($speaker['id'])): ?>
            <?php echo get_the_post_thumbnail($speaker['id'], 'medium_large', ['class' => 'speaker-photo', 'loading' => 'lazy', 'alt' => $speaker['name']]); ?>
        <?php else: ?>
            <div class="flex h-full items-center justify-center" aria-hidden="true">
                <svg class="w-16 h-16 text-ink-muted" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.118a7.5 7.5 0 0115 0A17.9 17.9 0 0112 21.75c-2.676 0-5.216-.584-7.5-1.632z"/></svg>
            </div>
        <?php endif; ?>
        <?php if ($speaker['is_keynote']): ?>
            <span class="speaker-role">Keynote Speaker</span>
        <?php endif; ?>
    </div>
    <div class="speaker-info">
        <h3 class="speaker-name"><?php echo esc_html($speaker['name']); ?></h3>
        <?php if ($speaker['title']): ?>
            <p class="speaker-position"><?php echo esc_html($speaker['title']); ?></p>
        <?php endif; ?>
        <?php if ($speaker['affiliation']): ?>
            <p class="speaker-affiliation"><?php echo esc_html($speaker['affiliation']); ?></p>
        <?php endif; ?>
        <div class="speaker-card-footer">
            <div class="speaker-tracks"><?php aic_speaker_track_badges($speaker['tracks']); ?></div>
            <svg class="speaker-profile-arrow" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
        </div>
    </div>
</a>
