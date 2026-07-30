<?php
/**
 * Template Name: Paper Submission & Publication
 * Two-column layout: submission guidelines + important dates
 */
get_header();
?>

<?php
$title    = 'Paper Submission & Publication';
$subtitle = 'Guidelines for abstract and full paper submissions.';
get_template_part('template-parts/hero-inner');
?>

<section class="section bg-surface">
    <div class="container-custom">

        <!-- Two-column: Submission Guidelines + Important Dates -->
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 mb-16 reveal">

            <!-- Left: Submission Guidelines -->
            <div class="lg:col-span-7">
                <div class="flex items-center gap-3 mb-6">
                    <span class="w-1.5 h-6 rounded-full bg-primary"></span>
                    <h2 class="text-heading-lg text-ink">Abstract & Full Paper Submissions</h2>
                </div>

                <div class="space-y-4 mb-8">
                    <div class="flex gap-4 p-4 rounded-xl bg-white border border-surface-200">
                        <span class="step-number shrink-0">1</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Submit Electronically</p>
                            <p class="text-body-sm text-ink-muted">Authors are invited to submit their manuscripts electronically through the conference submission system.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-4 rounded-xl bg-white border border-surface-200">
                        <span class="step-number shrink-0">2</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Maximum Two Abstracts</p>
                            <p class="text-body-sm text-ink-muted">Each author is limited to submit a maximum of two abstracts (as main author or co-author).</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-4 rounded-xl bg-white border border-surface-200">
                        <span class="step-number shrink-0">3</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Presentation Only</p>
                            <p class="text-body-sm text-ink-muted">Authors who prefer not to have their papers published are allowed to submit abstracts for presentation only at the conference.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-4 rounded-xl bg-white border border-surface-200">
                        <span class="step-number shrink-0">4</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Book of Program</p>
                            <p class="text-body-sm text-ink-muted">All accepted abstracts will be included in the AIC's Book of Program.</p>
                        </div>
                    </div>
                    <div class="flex gap-4 p-4 rounded-xl bg-accent/5 border border-accent/20">
                        <span class="step-number shrink-0" style="background: #C7982C; color: white;">!</span>
                        <div>
                            <p class="text-body-sm font-semibold text-ink mb-1">Acceptance Required</p>
                            <p class="text-body-sm text-ink-muted"><strong>Only after receiving notification of abstract acceptance may you proceed with submitting the full paper and completing your registration.</strong></p>
                        </div>
                    </div>
                </div>

                <a href="<?php echo esc_url(home_url('/call-for-paper/')); ?>" class="btn-primary no-underline">
                    Submit Now
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <!-- Right: Publication Info -->
            <div class="lg:col-span-5">
                <!-- Publication Info -->
                <div class="bg-white rounded-2xl border border-surface-300/60 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                        </div>
                        <h3 class="text-heading-sm text-ink font-semibold">Publication</h3>
                    </div>
                    <p class="text-body-sm text-ink-muted leading-relaxed">Accepted papers will be published in the <strong class="text-ink">Scopus-indexed proceedings</strong> and <strong class="text-ink">SINTA 2 Journals</strong>.</p>
                </div>
            </div>

        </div>

    </div>
</section>

<?php get_footer(); ?>
