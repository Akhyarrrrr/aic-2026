<?php
/** Single speaker profile. Existing duplicate URLs retain their own biography. */
get_header();
$speaker_id = get_the_ID();
$speaker = aic_get_speaker($speaker_id);
$tracks = $speaker['tracks'] ?? (array) get_field('speaker_track', $speaker_id);
$name = get_the_title();
$affiliation = (string) get_field('speaker_affiliation', $speaker_id);
$position = (string) get_field('speaker_title', $speaker_id);
$is_keynote = (bool) get_field('speaker_is_keynote', $speaker_id);
get_template_part('template-parts/hero-inner', null, ['title' => $name, 'subtitle' => $affiliation]);
?>
<section class="section bg-surface">
    <div class="container-custom">
        <a href="<?php echo esc_url(home_url('/speaker/')); ?>" class="btn-ghost no-underline mb-8">
            <svg class="w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            All Speakers
        </a>
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 mb-16 items-start reveal">
            <div class="lg:col-span-4">
                <div class="aspect-[4/5] max-w-md rounded-2xl overflow-hidden bg-surface-200">
                    <?php if (has_post_thumbnail($speaker_id)): ?>
                        <?php echo get_the_post_thumbnail($speaker_id, 'large', ['class' => 'w-full h-full object-contain', 'alt' => $name]); ?>
                    <?php else: ?>
                        <div class="h-full flex items-center justify-center text-ink-muted">Photo to be announced</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="lg:col-span-8">
                <div class="flex flex-wrap items-center gap-2 mb-5">
                    <?php aic_speaker_track_badges($tracks); ?>
                    <?php if ($is_keynote): ?><span class="speaker-track bg-accent-100 text-accent-800">Keynote Speaker</span><?php endif; ?>
                </div>
                <h2 class="text-heading-lg mb-3"><?php echo esc_html($name); ?></h2>
                <?php if ($position): ?><p class="text-body-lg text-primary font-medium mb-3"><?php echo esc_html($position); ?></p><?php endif; ?>
                <?php if ($affiliation): ?><p class="text-body text-ink-muted mt-0 mb-5"><?php echo esc_html($affiliation); ?></p><?php endif; ?>
                <?php $email = get_field('speaker_email', $speaker_id); ?>
                <?php if ($email): ?><p class="mb-5"><a href="<?php echo esc_url('mailto:' . sanitize_email($email)); ?>"><?php echo esc_html($email); ?></a></p><?php endif; ?>
                <?php $bio = get_the_content(); ?>
                <?php if (trim($bio) !== ''): ?>
                    <div class="prose-custom border-t border-surface-300 pt-6"><?php echo wp_kses_post(aic_clean_colibri($bio)); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        $related = array_filter(aic_get_speakers(), function ($candidate) use ($speaker_id, $tracks) {
            if (in_array($speaker_id, $candidate['ids'], true)) return false;
            return array_intersect($tracks, $candidate['tracks']) || in_array('all', $tracks, true) || in_array('all', $candidate['tracks'], true);
        });
        $related = array_slice(array_values($related), 0, 4);
        ?>
        <?php if ($related): ?>
        <div class="reveal">
            <h2 class="text-heading-lg mb-8">More speakers across your tracks</h2>
            <div class="speaker-grid">
                <?php foreach ($related as $speaker) get_template_part('template-parts/speaker-card', null, ['speaker' => $speaker]); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
