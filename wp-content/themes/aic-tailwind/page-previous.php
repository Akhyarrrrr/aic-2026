<?php
/**
 * Template Name: Previous AICs
 * Links to previous AIC conferences on production
 */
get_header();

$title    = 'Previous AICs';
$subtitle = 'Explore the legacy of AIC conferences.';
?>
<?php get_template_part('template-parts/hero-inner'); ?>

<section class="section bg-surface">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Legacy summary -->
        <div class="mb-16 reveal">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-1.5 h-6 rounded-full bg-accent"></span>
                <span class="text-accent text-body-sm font-semibold uppercase tracking-wider">AIC Through the Years</span>
            </div>
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 mb-10">
                <div class="lg:col-span-7">
                    <h2 class="text-display-sm lg:text-display text-ink mb-5 text-balance">A Legacy of Excellence</h2>
                    <p class="text-body text-ink-muted leading-relaxed max-w-3xl">Since its inception, the Annual International Conference has brought together researchers, academics, and professionals from around the world to share knowledge and drive innovation across sciences, engineering, life sciences, and social sciences.</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-white rounded-2xl border border-surface-300/60 p-6 lg:p-8 text-center">
                    <span class="block text-display-sm lg:text-display font-bold text-primary leading-none mb-1">15</span>
                    <span class="text-caption text-ink-muted">Editions</span>
                </div>
                <div class="bg-white rounded-2xl border border-surface-300/60 p-6 lg:p-8 text-center">
                    <span class="block text-display-sm lg:text-display font-bold text-accent leading-none mb-1">2011</span>
                    <span class="text-caption text-ink-muted">First Edition</span>
                </div>
                <div class="bg-white rounded-2xl border border-surface-300/60 p-6 lg:p-8 text-center">
                    <span class="block text-display-sm lg:text-display font-bold text-primary leading-none mb-1">1K+</span>
                    <span class="text-caption text-ink-muted">Presenters</span>
                </div>
            </div>
        </div>

        <!-- Editions grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-16 reveal-stagger">
            <?php
            $editions = [
                [
                    'year'  => '2025',
                    'label' => '15th Edition',
                    'url'   => 'https://aic.usk.ac.id/2025/',
                    'theme' => 'Resilience and Innovation',
                ],
                [
                    'year'  => '2024',
                    'label' => '14th Edition',
                    'url'   => 'https://aic.usk.ac.id/2024',
                    'theme' => 'Sustainable Development',
                ],
                [
                    'year'  => '2023',
                    'label' => '13th Edition',
                    'url'   => '#',
                    'theme' => null,
                    'na'    => true,
                ],
                [
                    'year'  => '2022',
                    'label' => '12th Edition',
                    'url'   => '#',
                    'theme' => null,
                    'na'    => true,
                ],
                [
                    'year'  => '2021',
                    'label' => '11th Edition',
                    'url'   => '#',
                    'theme' => null,
                    'na'    => true,
                ],
            ];
            foreach ($editions as $ed):
                $available = empty($ed['na']);
            ?>
            <a href="<?php echo esc_url($ed['url']); ?>" class="group relative bg-white rounded-2xl border overflow-hidden no-underline transition-all duration-500 <?php echo $available ? 'border-surface-300/60 hover:shadow-card-hover hover:-translate-y-1' : 'border-surface-200/60 opacity-50 cursor-not-allowed'; ?>">
                <div class="relative">
                    <!-- Year backdrop -->
                    <div class="absolute top-0 right-0 text-[8rem] sm:text-[10rem] leading-none font-bold select-none pointer-events-none transition-all duration-500 <?php echo $available ? 'text-primary/[0.04] group-hover:text-primary/[0.07]' : 'text-surface-200'; ?>" style="line-height: 0.7;"><?php echo esc_html($ed['year']); ?></div>
                    <!-- Header bar -->
                    <div class="relative z-10 flex items-center justify-between px-7 pt-6 lg:px-8 lg:pt-8">
                        <span class="text-caption font-semibold uppercase tracking-wider <?php echo $available ? 'text-primary' : 'text-surface-400'; ?>"><?php echo esc_html($ed['label']); ?></span>
                        <?php if ($available): ?>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-caption font-semibold bg-primary/10 text-primary whitespace-nowrap">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary shrink-0"></span>
                            Available
                        </span>
                        <?php else: ?>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-caption font-semibold bg-surface-200 text-surface-400 whitespace-nowrap">
                            Pending
                        </span>
                        <?php endif; ?>
                    </div>
                    <!-- Content -->
                    <div class="relative z-10 px-7 pb-7 lg:px-8 lg:pb-8">
                        <div class="mb-5">
                            <span class="block text-5xl sm:text-6xl font-bold tracking-tight leading-none <?php echo $available ? 'text-ink' : 'text-surface-400'; ?>">
                                <?php echo esc_html($ed['year']); ?>
                            </span>
                        </div>
                        <?php if (!empty($ed['theme'])): ?>
                        <p class="text-body-sm text-ink-muted leading-relaxed">&ldquo;<?php echo esc_html($ed['theme']); ?>&rdquo;</p>
                        <?php else: ?>
                        <p class="text-body-sm text-ink-subtle italic">Theme information coming soon</p>
                        <?php endif; ?>
                        <!-- Action -->
                        <div class="mt-6 pt-5 border-t border-surface-200">
                            <?php if ($available): ?>
                            <span class="inline-flex items-center gap-2 text-body-sm font-medium text-primary transition-all duration-300 group-hover:gap-3">
                                Visit website
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </span>
                            <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 text-caption text-surface-400">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Coming soon
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Publication AICs CTA -->
        <div class="reveal">
            <div class="relative bg-gradient-to-br from-primary to-primary-800 rounded-3xl overflow-hidden">
                <div class="absolute inset-0 opacity-[0.07]" style="background-image: radial-gradient(circle at 25% 60%, #C7982C 1.5px, transparent 1.5px), radial-gradient(circle at 75% 40%, #ffffff 1px, transparent 1px); background-size: 40px 40px, 56px 56px;"></div>
                <div class="absolute top-0 left-1/3 w-72 h-72 bg-accent/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-56 h-56 bg-white/5 rounded-full blur-3xl"></div>
                <div class="relative z-10 px-8 py-16 lg:px-20 lg:py-24 text-center">
                    <div class="w-14 h-14 mx-auto mb-6 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm border border-white/10">
                        <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                    </div>
                    <h2 class="text-display-sm lg:text-display text-white mb-4 text-balance">Publication AICs</h2>
                    <p class="text-surface-400 text-body-lg mb-10 max-w-2xl mx-auto">Browse published proceedings and papers from previous AIC conferences in our open-access archive.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="https://aic.usk.ac.id/publication-aics/" target="_blank" rel="noopener" class="inline-flex items-center gap-2.5 btn-accent btn-lg no-underline shadow-lg shadow-accent/20">
                            View Publications
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                        <a href="https://scholar.google.com/" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-body-sm font-medium text-white/80 border border-white/20 hover:bg-white/10 hover:text-white transition-all duration-300 no-underline">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                            Google Scholar
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php get_footer(); ?>
