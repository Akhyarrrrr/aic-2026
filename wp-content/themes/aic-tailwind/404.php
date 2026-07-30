<?php
get_header();
?>
<section class="min-h-[80vh] flex items-center bg-surface">
    <div class="container-custom text-center">
        <p class="text-accent text-display-lg font-bold mb-4">404</p>
        <h1 class="text-display text-ink mb-4">Page not found</h1>
        <p class="text-body-lg text-ink-muted max-w-md mx-auto mb-8">
            The page you are looking for might have been moved or doesn't exist.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">Back to Home</a>
            <a href="<?php echo esc_url(home_url('/conference/')); ?>" class="btn-outline">Conference Info</a>
        </div>
    </div>
</section>
<?php get_footer(); ?>
