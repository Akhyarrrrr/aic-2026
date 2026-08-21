<?php
/**
 * Template Name: Registration Fee
 * Clean fee table layout from existing content
 */
get_header();
?>

<?php
$title    = 'Registration Fee';
$subtitle = 'Complete your registration for the 16th AIC 2026.';
get_template_part('template-parts/hero-inner');
?>

<!-- Fee Content -->
<section class="section bg-surface">
    <div class="container-custom">

        <!-- Two-column layout: Fee + Payment -->
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 mb-16 reveal">
            <!-- Fee Table -->
            <div class="bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07 1.757 4.242 0 .515-.769.697-1.676.697-2.591V6.75c0-.414-.336-.75-.75-.75H10.5a.75.75 0 00-.75.75v6.432z"/></svg>
                    </div>
                    <h2 class="text-heading-lg text-ink">Registration Fee</h2>
                </div>

                <?php
                $fee_presenter_domestic = get_option('aic_fee_presenter_domestic', 'IDR 500K');
                $fee_presenter_intl     = get_option('aic_fee_presenter_intl', 'USD 50');
                $fee_nonpresenter_domestic = get_option('aic_fee_nonpresenter_domestic', 'IDR 350K');
                $fee_nonpresenter_intl  = get_option('aic_fee_nonpresenter_intl', 'USD 35');
                ?>
                <div class="grid sm:grid-cols-2 gap-4 mb-6">
                    <div class="bg-surface-100 rounded-xl p-6 text-center">
                        <p class="text-caption text-ink-subtle uppercase tracking-wider mb-2">Presenter</p>
                        <div class="text-display-sm font-bold text-primary mb-1"><?php echo esc_html($fee_presenter_domestic); ?></div>
                        <p class="text-body-sm text-ink-muted"><?php echo esc_html($fee_presenter_intl); ?> (International)</p>
                        <p class="text-caption text-ink-subtle mt-2">General & Student</p>
                    </div>
                    <div class="bg-surface-100 rounded-xl p-6 text-center">
                        <p class="text-caption text-ink-subtle uppercase tracking-wider mb-2">Non-Presenter</p>
                        <div class="text-display-sm font-bold text-primary mb-1"><?php echo esc_html($fee_nonpresenter_domestic); ?></div>
                        <p class="text-body-sm text-ink-muted"><?php echo esc_html($fee_nonpresenter_intl); ?> (International)</p>
                        <p class="text-caption text-ink-subtle mt-2">Participant</p>
                    </div>
                </div>

                <?php $fee_notes = get_option('aic_fee_notes', ''); ?>
                <?php if ( $fee_notes ) : ?>
                <div class="bg-accent/5 border border-accent/20 rounded-xl p-5">
                    <p class="text-body-sm text-ink-muted leading-relaxed">
                        <strong class="text-ink">Notes:</strong>
                    </p>
                    <div class="text-body-sm text-ink-muted leading-relaxed mt-2 prose prose-sm max-w-none">
                        <?php echo wp_kses_post($fee_notes); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Payment Method -->
            <div class="bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                    </div>
                    <h2 class="text-heading-lg text-ink">Registration Payment Method</h2>
                </div>

                <!-- For Presenters -->
                <div class="mb-6">
                    <h3 class="text-body-sm font-semibold text-ink mb-3 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-primary text-white text-caption flex items-center justify-center font-bold">1</span>
                        For Presenter Participants
                    </h3>
                    <div class="ml-8 space-y-2 text-body-sm text-ink-muted">
                        <p>Submit your abstract through the online submission system.</p>
                        <p>Registration will proceed after you submit the abstract. Once your abstract is accepted, the payment for registration fee will be instructed along with the <strong class="text-ink">Letter of Acceptance (LoA)</strong> which will be sent via corresponding author email.</p>
                    </div>
                </div>

                <!-- For Non-Presenters -->
                <div class="mb-6">
                    <h3 class="text-body-sm font-semibold text-ink mb-3 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-primary text-white text-caption flex items-center justify-center font-bold">2</span>
                        For Non-Presenter Participants
                    </h3>
                    <div class="ml-8 text-body-sm text-ink-muted">
                        <p>Please fill in this form to register:</p>
                        <a href="<?php echo esc_url( get_option('aic_reg_form_url', '#') ); ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-primary font-medium mt-2 no-underline hover:underline">
                            Registration Form
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="<?php echo esc_url(home_url('/call-for-paper/')); ?>" class="btn-primary no-underline">
                        Submit Abstract
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Per-Track Registration Hub -->
        <div class="reveal">
            <div class="text-center mb-10">
                <div class="flex items-center justify-center gap-3 mb-3">
                    <span class="w-1.5 h-6 rounded-full bg-primary"></span>
                    <p class="text-primary text-body-sm font-semibold uppercase tracking-wider">Per-Track Information</p>
                </div>
                <h2 class="text-display-sm text-ink mb-3">Choose Your Conference Track</h2>
                <p class="text-body text-ink-muted max-w-xl mx-auto">Select your track to view detailed registration procedure, publication venues, and submission information specific to your field.</p>
            </div>

            <?php
            $tracks = [
                'se'  => ['name' => 'Sciences &amp; Engineering', 'code' => 'AIC-SE', 'color' => '#F79007', 'desc' => 'Scopus-indexed proceedings and partner journals (JEEEMI, INFOTEL, IJEEEMI).'],
                'els' => ['name' => 'Environmental &amp; Life Sciences', 'code' => 'AIC-ELS', 'color' => '#137622', 'desc' => 'Scopus-indexed proceedings publication.'],
                'ss'  => ['name' => 'Social Sciences', 'code' => 'AIC-SS', 'color' => '#AA39AF', 'desc' => 'Scopus-indexed journal SIELE and SINTA 2 partner journals.'],
            ];
            ?>
            <div class="grid sm:grid-cols-3 gap-5">
                <?php foreach ($tracks as $slug => $t): ?>
                <a href="<?php echo esc_url(home_url("/{$slug}/registration-publication-fee/")); ?>"
                   class="group block bg-white rounded-2xl border border-surface-200 p-6 no-underline hover:shadow-card-hover hover:-translate-y-0.5 transition-all duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-3 h-3 rounded-full shrink-0" style="background: <?php echo esc_attr($t['color']); ?>;"></span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink group-hover:text-primary transition-colors"><?php echo $t['name']; ?></p>
                            <p class="text-caption font-semibold" style="color: <?php echo esc_attr($t['color']); ?>;"><?php echo $t['code']; ?></p>
                        </div>
                    </div>
                    <p class="text-body-sm text-ink-muted leading-relaxed mb-4"><?php echo $t['desc']; ?></p>
                    <span class="inline-flex items-center gap-1.5 text-body-sm font-medium no-underline" style="color: <?php echo esc_attr($t['color']); ?>;">
                        View Registration Details
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </a>
                <?php endforeach; ?>
            </div>

            <p class="text-center text-body-sm text-ink-muted mt-6">
                Don't have an abstract yet?
                <a href="<?php echo esc_url(home_url('/call-for-paper/')); ?>" class="font-medium text-primary hover:underline">Submit your abstract first</a>
                before registering.
            </p>
        </div>

    </div>
</section>

<?php get_footer(); ?>
