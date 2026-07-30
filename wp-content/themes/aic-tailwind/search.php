<?php
/**
 * Search Results page
 */
get_header();

$search_query = get_search_query();
$title    = 'Search Results';
$subtitle = $search_query ? "Results for: {$search_query}" : '';
?>
<?php get_template_part('template-parts/hero-inner'); ?>

<section class="section bg-surface">
    <div class="container-custom">
        <div class="max-w-3xl mx-auto">

            <?php if (have_posts()): ?>

                <div class="space-y-6">
                    <?php while (have_posts()): the_post(); ?>
                        <article class="bg-white rounded-2xl border border-surface-300/60 p-6 lg:p-8 reveal">
                            <div class="flex items-start justify-between gap-4 mb-3">
                                <h2 class="text-heading text-ink">
                                    <a href="<?php the_permalink(); ?>" class="no-underline text-ink hover:text-primary transition-colors"><?php the_title(); ?></a>
                                </h2>
                                <span class="text-caption text-ink-subtle shrink-0 mt-1"><?php echo get_the_date(); ?></span>
                            </div>
                            <div class="prose-custom">
                                <?php echo wp_trim_words(wp_strip_all_tags(get_the_excerpt()), 40); ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-12 reveal">
                    <div>
                        <?php if (get_previous_posts_link()): ?>
                            <a href="<?php echo esc_url(get_previous_posts_link_url()); ?>" class="btn-ghost no-underline">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                Previous
                            </a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if (get_next_posts_link()): ?>
                            <a href="<?php echo esc_url(get_next_posts_link_url()); ?>" class="btn-ghost no-underline">
                                Next
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

            <?php else: ?>

                <!-- Empty state -->
                <div class="max-w-lg mx-auto text-center py-16 reveal">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-surface-200 flex items-center justify-center">
                        <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </div>
                    <h2 class="text-heading text-ink mb-3">No results found</h2>
                    <p class="text-ink-muted mb-8 max-w-sm mx-auto">Sorry, we couldn't find any results for "<strong><?php echo esc_html($search_query); ?></strong>". Try a different search term.</p>

                    <div class="max-w-md mx-auto">
                        <?php get_search_form(); ?>
                    </div>

                    <div class="mt-8 pt-8 border-t border-surface-200">
                        <p class="text-body-sm text-ink-subtle mb-3">Popular pages:</p>
                        <div class="flex flex-wrap justify-center gap-2">
                            <a href="<?php echo esc_url(home_url('/call-for-paper/')); ?>" class="px-3 py-1.5 rounded-lg bg-surface-100 text-body-sm text-ink-muted hover:text-primary hover:bg-primary/5 transition-colors no-underline">Call for Paper</a>
                            <a href="<?php echo esc_url(home_url('/se/')); ?>" class="px-3 py-1.5 rounded-lg bg-surface-100 text-body-sm text-ink-muted hover:text-primary hover:bg-primary/5 transition-colors no-underline">AIC-SE</a>
                            <a href="<?php echo esc_url(home_url('/els/')); ?>" class="px-3 py-1.5 rounded-lg bg-surface-100 text-body-sm text-ink-muted hover:text-primary hover:bg-primary/5 transition-colors no-underline">AIC-ELS</a>
                            <a href="<?php echo esc_url(home_url('/ss/')); ?>" class="px-3 py-1.5 rounded-lg bg-surface-100 text-body-sm text-ink-muted hover:text-primary hover:bg-primary/5 transition-colors no-underline">AIC-SS</a>
                            <a href="<?php echo esc_url(home_url('/speaker/')); ?>" class="px-3 py-1.5 rounded-lg bg-surface-100 text-body-sm text-ink-muted hover:text-primary hover:bg-primary/5 transition-colors no-underline">Speakers</a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
