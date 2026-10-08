<?php
/** Template Name: Track Speakers */
get_header();
$slug = aic_page_track_slug() ?: 'se';
$track = ['color' => aic_track_color($slug), 'name' => aic_track_name($slug), 'code' => aic_track_code($slug)];
$parent_id = wp_get_post_parent_id(get_the_ID()) ?: get_the_ID();
$hero_title = 'Speakers';
$hero_subtitle = 'Keynote and invited speakers for ' . $track['name'] . '.';
$keynotes = [];
$invited = [];
foreach (aic_get_speakers($slug) as $speaker) {
    if ($speaker['is_keynote']) $keynotes[] = $speaker;
    else $invited[] = $speaker;
}
include get_template_directory() . '/template-parts/track-hero.php';
?>
<section class="section bg-surface">
    <div class="container-custom">
        <div class="grid lg:grid-cols-12 gap-8 xl:gap-12 items-start">
            <div class="lg:col-span-8 space-y-12">
                <?php if ($keynotes): ?>
                <div class="reveal">
                    <h2 class="text-display-sm lg:text-display mb-3">Voices that shape<br>this track</h2>
                    <p class="text-body-sm font-semibold text-accent-700 mb-8">Keynote Speakers</p>
                    <div class="speaker-grid speaker-grid-track">
                        <?php foreach ($keynotes as $speaker) get_template_part('template-parts/speaker-card', null, ['speaker' => $speaker]); ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($invited): ?>
                <div class="reveal">
                    <h2 class="text-display-sm lg:text-display mb-3">Experts in focus</h2>
                    <p class="text-body-sm font-semibold text-primary mb-8">Invited Speakers</p>
                    <div class="speaker-grid speaker-grid-track">
                        <?php foreach ($invited as $speaker) get_template_part('template-parts/speaker-card', null, ['speaker' => $speaker]); ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!$keynotes && !$invited): ?>
                <div class="bg-white rounded-2xl border border-surface-200 p-6 sm:p-10 text-center reveal">
                    <h2 class="text-heading-lg mb-3">Speakers to be announced</h2>
                    <p>Speakers for <?php echo esc_html($track['name']); ?> will be announced soon. Please check back later for updates.</p>
                </div>
                <?php endif; ?>
            </div>
            <?php include get_template_directory() . '/template-parts/track-sidebar.php'; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
