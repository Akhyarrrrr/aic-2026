<?php
/** Template Name: All Speakers */
get_header();
get_template_part('template-parts/hero-inner', null, [
    'title' => 'Speakers',
    'subtitle' => 'Keynote and invited speakers across all three conference tracks.',
]);
$keynotes = [];
$invited = [];
foreach (aic_get_speakers() as $speaker) {
    if ($speaker['is_keynote']) $keynotes[] = $speaker;
    else $invited[] = $speaker;
}
?>
<?php if ($keynotes): ?>
<section class="section bg-white">
    <div class="container-custom">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10 reveal">
            <div>
                <h2 class="text-display-sm lg:text-display text-ink">Voices that shape<br>the conversation</h2>
                <p class="text-body-sm text-accent-700 font-semibold mt-3">Keynote Speakers</p>
            </div>
            <p class="text-ink-muted max-w-md">Opening insights and perspectives from distinguished leaders across disciplines.</p>
        </div>
        <div class="speaker-grid reveal">
            <?php foreach ($keynotes as $speaker) get_template_part('template-parts/speaker-card', null, ['speaker' => $speaker]); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if ($invited): ?>
<section class="section bg-surface">
    <div class="container-custom">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10 reveal">
            <div>
                <h2 class="text-display-sm lg:text-display text-ink">Experts across<br>every track</h2>
                <p class="text-body-sm text-primary font-semibold mt-3">Invited Speakers</p>
            </div>
            <p class="text-ink-muted max-w-md">Specialized presentations from researchers and practitioners in their respective fields.</p>
        </div>
        <div class="speaker-grid reveal">
            <?php foreach ($invited as $speaker) get_template_part('template-parts/speaker-card', null, ['speaker' => $speaker]); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if (!$keynotes && !$invited): ?>
<section class="section bg-surface">
    <div class="container-custom text-center">
        <h2 class="text-heading-lg mb-3">Speakers to be announced</h2>
        <p>The organizing committee is confirming speakers. Check back soon for updates.</p>
    </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>
