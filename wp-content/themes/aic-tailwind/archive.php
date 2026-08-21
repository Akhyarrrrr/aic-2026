<?php
/**
 * Archive fallback for custom post types and standard archives
 */
get_header();

if (is_post_type_archive()) {
    $post_type_obj = get_post_type_object(get_post_type());
    $title = $post_type_obj ? $post_type_obj->labels->name : 'Archive';
} elseif (is_category()) {
    $title = single_cat_title('', false);
} elseif (is_tag()) {
    $title = single_tag_title('', false);
} elseif (is_date()) {
    $title = get_the_archive_title();
} else {
    $title = 'Archive';
}

$subtitle = get_the_archive_description() ?: '';
?>
<?php get_template_part('template-parts/hero-inner'); ?>

<section class="section bg-surface">
    <div class="container-custom">

        <?php if (have_posts()): ?>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 reveal-stagger">
                <?php while (have_posts()): the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="group bg-white rounded-2xl border border-surface-300/60 overflow-hidden no-underline transition-all duration-300 hover:-translate-y-1 hover:shadow-card">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="aspect-[16/10] overflow-hidden bg-surface-200">
                                <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105', 'loading' => 'lazy']); ?>
                            </div>
                        <?php else: ?>
                            <div class="aspect-[16/10] bg-gradient-to-br from-surface-100 to-surface-200 flex items-center justify-center">
                                <svg class="w-12 h-12 text-surface-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </div>
                        <?php endif; ?>

                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-caption text-ink-subtle"><?php echo esc_html(get_the_date()); ?></span>
                            </div>
                            <h3 class="text-heading-sm text-ink font-semibold mb-2 group-hover:text-primary transition-colors line-clamp-2"><?php the_title(); ?></h3>
                            <?php if (has_excerpt()): ?>
                                <p class="text-body-sm text-ink-muted line-clamp-2"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-center gap-3 mt-12 reveal">
                <?php
                $prev = get_previous_posts_link('Previous');
                $next = get_next_posts_link('Next');
                ?>
                <?php if ($prev): ?>
                    <a href="<?php echo esc_url(get_previous_posts_page_link()); ?>" class="btn-ghost no-underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Previous
                    </a>
                <?php endif; ?>
                <?php if ($next): ?>
                    <a href="<?php echo esc_url(get_next_posts_page_link()); ?>" class="btn-ghost no-underline">
                        Next
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                <?php endif; ?>
            </div>

        <?php else: ?>

            <!-- Empty state -->
            <div class="max-w-lg mx-auto text-center py-16 reveal">
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-surface-200 flex items-center justify-center">
                    <svg class="w-8 h-8 text-surface-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h2 class="text-heading text-ink mb-3">Nothing here yet</h2>
                <p class="text-ink-muted max-w-sm mx-auto">No content has been published in this archive yet. Check back soon for updates.</p>
            </div>

        <?php endif; ?>

    </div>
</section>

<?php get_footer(); ?>
