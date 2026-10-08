<?php
/**
 * Template Name: Publication AICs
 * Open-access archive of AIC proceedings (AIC-SE & AIC-ELS), newest first.
 */
get_header();

$title    = 'Publication AICs';
$subtitle = 'Published proceedings and papers from previous AIC conferences in our open-access archive.';
?>
<?php get_template_part('template-parts/hero-inner', null, ['title' => $title, 'subtitle' => $subtitle]); ?>

<section class="section bg-surface">
    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Intro -->
        <div class="mb-16 reveal">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-1.5 h-6 rounded-full bg-accent"></span>
                <span class="text-accent-700 text-body-sm font-semibold uppercase tracking-wider">Open Access Archive</span>
            </div>
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 mb-10">
                <div class="lg:col-span-7">
                    <h2 class="text-display-sm lg:text-display text-ink mb-5 text-balance">A Publication Record, Edition by Edition</h2>
                    <p class="text-body text-ink-muted leading-relaxed max-w-3xl mb-5">Published proceedings of the AIC-SE and AIC-ELS tracks are available in open-access archives. Papers are indexed by the respective publisher, ensuring worldwide discoverability.</p>
                    <span class="inline-flex max-w-full items-start gap-2 px-3.5 py-2 rounded-xl bg-primary/10 text-primary text-caption font-semibold">
                        <svg class="w-4 h-4 shrink-0 mt-0.5" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        <span>Publication Records (AIC-SE &amp; AIC-ELS)</span>
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-white rounded-2xl border border-surface-300/60 p-3 sm:p-6 lg:p-8 text-center">
                    <span class="block text-xl sm:text-display-sm lg:text-display font-bold text-primary leading-none mb-1">9</span>
                    <span class="text-caption text-ink-muted">Editions Published</span>
                </div>
                <div class="bg-white rounded-2xl border border-surface-300/60 p-3 sm:p-6 lg:p-8 text-center">
                    <span class="block text-xl sm:text-display-sm lg:text-display font-bold text-accent-700 leading-none mb-1">3</span>
                    <span class="text-caption text-ink-muted">Publishers</span>
                </div>
                <div class="bg-white rounded-2xl border border-surface-300/60 p-3 sm:p-6 lg:p-8 text-center">
                    <span class="block text-xl sm:text-display-sm lg:text-display font-bold text-primary leading-none mb-1">2017</span>
                    <span class="text-caption text-ink-muted">First Record</span>
                </div>
            </div>
        </div>

        <!-- Records -->
        <div class="space-y-6 lg:space-y-8">
            <?php
            $publications = [
                [
                    'year'     => '2025',
                    'edition'  => '15th Edition',
                    'name'     => 'The 15th Annual International Conference (15th AIC 2025)',
                    'date'     => 'September 4-5, 2025',
                    'series'   => 'IOP Conference Series: Earth and Environmental Science, Volume 1641, Issue 1',
                    'publisher'=> 'IOP · Earth &amp; Environmental Science',
                    'links'    => ['https://iopscience.iop.org/issue/1755-1315/1641/1'],
                ],
                [
                    'year'     => '2024',
                    'edition'  => '14th Edition',
                    'name'     => 'The 14th Annual International Conference (14th AIC 2024)',
                    'date'     => '',
                    'series'   => 'IOP Conference Series: Earth and Environmental Science, Volume 1510, Issue 1',
                    'publisher'=> 'IOP · Earth &amp; Environmental Science',
                    'links'    => ['https://iopscience.iop.org/issue/1755-1315/1510/1'],
                ],
                [
                    'year'     => '2023',
                    'edition'  => '13th Edition',
                    'name'     => 'The 13th Annual International Conference (13th AIC 2023)',
                    'date'     => '',
                    'series'   => 'Scientific.Net: The 13th AIC-SE proceedings. IOP Conference Series: Earth and Environmental Science, Volume 1356, Issue 1.',
                    'publisher'=> 'Scientific.Net &amp; IOP · Earth &amp; Environmental Science',
                    'links'    => [
                        'https://www.scientific.net/book/the-13th-annual-international-conference-on-sciences-and-engineering-aic-se/978-3-0357-3888-9',
                        'https://iopscience.iop.org/issue/1755-1315/1356/1',
                    ],
                ],
                [
                    'year'     => '2022',
                    'edition'  => '12th Edition',
                    'name'     => 'The 12th Annual International Conference on Science and Engineering (12th AIC-SE 2022)',
                    'date'     => '',
                    'series'   => 'AIP Conference Proceedings, Volume 3082, Issue 1',
                    'publisher'=> 'AIP Conference Proceedings',
                    'links'    => ['https://pubs.aip.org/aip/acp/issue/3082/1'],
                ],
                [
                    'year'     => '2021',
                    'edition'  => '11th Edition',
                    'name'     => 'The 11th Annual International Conference on Science and Engineering (11th AIC-SE 2021)',
                    'date'     => '',
                    'series'   => 'AIP Conference Proceedings, Volume 2613, Issue 1',
                    'publisher'=> 'AIP Conference Proceedings',
                    'links'    => ['https://pubs.aip.org/aip/acp/issue/2613/1'],
                ],
                [
                    'year'     => '2020',
                    'edition'  => '10th Edition',
                    'name'     => 'The 10th Annual International Conference on Science and Engineering (10th AIC-SE 2020)',
                    'date'     => 'October 15-16, 2020',
                    'series'   => 'IOP Conference Series: Materials Science and Engineering, Volume 1087',
                    'publisher'=> 'IOP · Materials Science &amp; Engineering',
                    'links'    => ['https://iopscience.iop.org/issue/1757-899X/1087/1'],
                ],
                [
                    'year'     => '2019',
                    'edition'  => '9th Edition',
                    'name'     => 'The 9th AIC 2019 on Sciences &amp; Engineering (9th AIC-SE)',
                    'date'     => 'September 18-20, 2019',
                    'series'   => 'IOP Conference Series: Materials Science and Engineering, Volume 796',
                    'publisher'=> 'IOP · Materials Science &amp; Engineering',
                    'links'    => ['https://iopscience.iop.org/issue/1757-899X/796/1'],
                ],
                [
                    'year'     => '2018',
                    'edition'  => '8th Edition',
                    'name'     => 'The 8th Annual International Conference (AIC) 2018 on Science and Engineering',
                    'date'     => 'September 12-14, 2018',
                    'series'   => 'IOP Conference Series: Materials Science and Engineering, Volume 523',
                    'publisher'=> 'IOP · Materials Science &amp; Engineering',
                    'links'    => ['https://iopscience.iop.org/issue/1757-899X/523/1'],
                ],
                [
                    'year'     => '2017',
                    'edition'  => '7th Edition',
                    'name'     => 'The 7th AIC-ICMR on Sciences and Engineering 2017',
                    'date'     => 'October 18-20, 2017',
                    'series'   => 'IOP Conference Series: Materials Science and Engineering, Volume 352',
                    'publisher'=> 'IOP · Materials Science &amp; Engineering',
                    'links'    => ['https://iopscience.iop.org/issue/1757-899X/352/1'],
                ],
            ];

            foreach ($publications as $rec):
                $has_single = count($rec['links']) === 1;
            ?>
            <article class="group relative bg-white rounded-2xl border border-surface-300/60 overflow-hidden transition-all duration-500 hover:shadow-card-hover hover:-translate-y-1 reveal">
                <!-- Year backdrop -->
                <div class="absolute top-0 right-0 text-[8rem] sm:text-[10rem] leading-none font-bold select-none pointer-events-none text-primary/[0.04] group-hover:text-primary/[0.07] transition-all duration-500" style="line-height: 0.7;"><?php echo esc_html($rec['year']); ?></div>

                <div class="relative z-10 grid gap-6 lg:grid-cols-12 px-5 py-6 sm:px-7 sm:py-8 lg:px-10 lg:py-10">
                    <!-- Meta -->
                    <div class="lg:col-span-4">
                        <span class="text-caption font-semibold uppercase tracking-wider text-primary"><?php echo esc_html($rec['edition']); ?></span>
                        <div class="mt-3 text-5xl sm:text-6xl font-bold tracking-tight leading-none text-ink"><?php echo esc_html($rec['year']); ?></div>
                        <?php if (!empty($rec['date'])): ?>
                        <p class="mt-3 flex items-center gap-2 text-body-sm text-ink-muted">
                            <svg class="w-4 h-4 text-surface-400 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                            <?php echo esc_html($rec['date']); ?>
                        </p>
                        <?php endif; ?>
                    </div>

                    <!-- Details -->
                    <div class="lg:col-span-8">
                        <h3 class="text-heading text-ink font-semibold mb-3"><?php echo $rec['name']; ?></h3>
                        <span class="inline-flex max-w-full items-center px-3 py-1.5 rounded-xl border border-surface-300 text-caption font-medium text-ink-muted mb-4"><?php echo wp_kses_post($rec['publisher']); ?></span>
                        <p class="text-body text-ink-muted leading-relaxed mb-6"><?php echo esc_html($rec['series']); ?></p>

                        <?php if ($has_single): ?>
                        <a href="<?php echo esc_url($rec['links'][0]); ?>" target="_blank" rel="noopener" class="inline-flex min-h-[44px] items-center gap-2 text-body-sm font-medium text-primary no-underline transition-all duration-300 hover:gap-3">
                            View Proceeding
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>
                        <?php else: ?>
                        <div class="flex flex-col sm:flex-row flex-wrap gap-3">
                            <?php foreach ($rec['links'] as $sub_i => $sub_url): ?>
                            <a href="<?php echo esc_url($sub_url); ?>" target="_blank" rel="noopener" class="inline-flex min-h-[44px] items-center justify-center gap-2 px-4 py-2 rounded-lg text-body-sm font-medium no-underline transition-all duration-300 <?php echo $sub_i === 0 ? 'bg-primary text-white hover:bg-primary-600' : 'bg-primary/10 text-primary hover:bg-primary/15'; ?>">
                                <?php echo $sub_i === 0 ? 'Scientific.Net' : 'IOP Proceeding'; ?>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>
