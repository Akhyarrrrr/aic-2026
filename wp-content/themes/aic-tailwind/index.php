<?php
/**
 * Fallback template for archives and index
 */
get_header();
?>

<div class="section pt-28 md:pt-36 bg-surface">
    <div class="container-custom">
        <?php if (have_posts()): ?>
            <div class="max-w-3xl mx-auto space-y-8">
                <?php while (have_posts()): the_post(); ?>
                    <article <?php post_class('bg-white rounded-2xl border border-surface-300/60 p-8 lg:p-12 reveal'); ?>>
                        <h1 class="text-display-sm text-ink mb-4">
                            <a href="<?php the_permalink(); ?>" class="no-underline text-ink hover:text-primary transition-colors"><?php the_title(); ?></a>
                        </h1>
                        <div class="prose-custom">
                            <?php echo wp_kses_post(aic_clean_colibri(get_the_content())); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="max-w-lg mx-auto text-center py-16 reveal">
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-surface-200 flex items-center justify-center">
                    <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h2 class="text-heading text-ink mb-3">Nothing here yet</h2>
                <p class="text-ink-muted">Content is being prepared. Check back soon for updates.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
