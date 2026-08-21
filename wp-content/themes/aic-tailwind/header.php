<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-surface text-ink font-sans antialiased'); ?>>
<?php wp_body_open(); ?>

<!-- Loader Overlay -->
<div id="loader" role="status" aria-label="Loading">
    <div class="loader-logo">
        <?php if (has_custom_logo()): ?>
            <?php
            $custom_logo_id = get_theme_mod('custom_logo');
            $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
            ?>
            <img src="<?php echo esc_url($logo_url); ?>" alt="AIC 2026" class="h-16 lg:h-20 w-auto" style="filter: brightness(0) invert(1);">
        <?php else: ?>
            <span class="text-4xl lg:text-5xl font-bold text-white tracking-tight">AIC<span class="text-accent"> 2026</span></span>
        <?php endif; ?>
    </div>
    <div class="loader-text mt-4">
        <span class="text-surface-400 text-body-sm tracking-wider">The <?php echo esc_html(get_option('aic_edition_number', '16th')); ?> Annual International Conference</span>
    </div>
</div>

<?php
// ============================================
// Track detection — determine if page belongs to SE/ELS/SS
// ============================================
$track_colors = [
    'se'  => '#F79007',
    'els' => '#137622',
    'ss'  => '#AA39AF',
];
$track_names = [
    'se'  => 'Sciences & Engineering',
    'els' => 'Environmental & Life Sciences',
    'ss'  => 'Social Sciences',
];
$track_codes = ['se' => 'AIC-SE', 'els' => 'AIC-ELS', 'ss' => 'AIC-SS'];

$current_track = null;
$slug = get_post_field('post_name', get_the_ID());

// Check if current page is a track page or child of one
foreach (['se', 'els', 'ss'] as $t) {
    $tp = get_page_by_path($t);
    if ($tp) {
        if (get_the_ID() == $tp->ID) { $current_track = $t; break; }
        $ancestors = get_post_ancestors(get_the_ID());
        if (in_array($tp->ID, $ancestors ?? [])) { $current_track = $t; break; }
    }
}
// Also check if viewing a speaker/committee single post
if (!$current_track && is_singular(['speaker', 'committee'])) {
    $current_track = get_field('speaker_track') ?: get_field('committee_track');
}
?>

<a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100] focus:bg-primary focus:text-white focus:px-4 focus:py-2 focus:rounded-lg">Skip to content</a>

<!-- Track color bar (only on track pages) -->
<?php if ($current_track): ?>
<div id="track-bar" class="fixed top-0 left-0 right-0 z-[60] h-1" style="background: <?php echo esc_attr($track_colors[$current_track]); ?>;" aria-hidden="true"></div>
<?php endif; ?>

<header id="site-header" class="fixed left-0 right-0 z-50 <?php echo $current_track ? 'top-1' : 'top-0'; ?> <?php echo (is_front_page() && !is_paged()) ? 'header-transparent' : 'header-solid'; ?>">
    <div id="header-inner" class="transition-all duration-300">
        <div class="container-custom">
            <div class="flex items-center justify-between h-16 lg:h-18">

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <?php if (has_custom_logo()): ?>
                        <a href="<?php echo esc_url($current_track ? home_url("/{$current_track}/") : home_url('/')); ?>" class="custom-logo-link block no-underline" rel="home">
                            <?php the_custom_logo(); ?>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo esc_url($current_track ? home_url("/{$current_track}/") : home_url('/')); ?>" id="logo-text" class="text-lg lg:text-xl font-bold text-white no-underline tracking-tight">
                            AIC<span class="text-accent"> 2026</span>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if ($current_track): ?>
                <!-- ===== TRACK-SPECIFIC NAVIGATION ===== -->
                <nav class="hidden lg:flex items-center gap-1" aria-label="Track navigation">
                    <a href="<?php echo esc_url(home_url('/tracks/')); ?>" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg text-body-sm font-medium text-ink-muted hover:text-ink hover:bg-surface-100 transition-colors no-underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        All Tracks
                    </a>
                    <span class="w-px h-5 bg-surface-300 mx-1"></span>
                    <?php
                    $track_menu_items = [
                        ['label' => 'Home', 'url' => home_url("/{$current_track}/")],
                        ['label' => 'Speakers', 'url' => home_url("/{$current_track}/speaker-{$current_track}/")],
                        ['label' => 'Committees', 'url' => home_url("/{$current_track}/committees-{$current_track}/")],
                        ['label' => 'Book of Program', 'url' => home_url("/{$current_track}/book-of-program-{$current_track}/")],
                        ['label' => 'Registration', 'url' => home_url("/{$current_track}/registration-publication-fee/")],
                    ];
                    $track_current_url = strtok($_SERVER['REQUEST_URI'], '?');
                    foreach ($track_menu_items as $item):
                        $is_active = untrailingslashit($track_current_url) === untrailingslashit(wp_parse_url($item['url'], PHP_URL_PATH));
                    ?>
                    <a href="<?php echo esc_url($item['url']); ?>" class="px-3 py-2 rounded-lg text-body-sm font-medium transition-colors no-underline <?php echo $is_active ? 'text-white' : 'text-ink-muted hover:text-ink hover:bg-surface-100'; ?>" <?php if ($is_active): ?>style="background: <?php echo esc_attr($track_colors[$current_track]); ?>"<?php endif; ?>>
                        <?php echo esc_html($item['label']); ?>
                    </a>
                    <?php endforeach; ?>
                </nav>

                <!-- Track CTA -->
                <div class="hidden lg:flex items-center gap-3 ml-4">
                    <a href="https://conference.usk.ac.id/<?php echo esc_attr(aic_track_code($current_track)); ?>/" target="_blank" rel="noopener" class="btn-sm no-underline rounded-lg font-medium text-white transition-all hover:opacity-90 active:scale-[0.98] px-4 py-2" style="background: <?php echo esc_attr($track_colors[$current_track]); ?>">
                        Submit Abstract
                        <svg class="w-3.5 h-3.5 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    </a>
                </div>

                <!-- Mobile Toggle (Track) -->
                <button id="mobile-toggle" class="lg:hidden p-2 -mr-2 transition-colors" aria-label="Toggle menu" aria-expanded="false">
                    <svg id="menu-icon-open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="menu-icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 6L6 18M6 6l12 12"/></svg>
                </button>

                <?php else: ?>
                <!-- ===== MAIN SITE NAVIGATION ===== -->
                <nav class="hidden lg:flex items-center" aria-label="Main navigation">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'flex items-center gap-0.5',
                        'walker'         => new AIC_Nav_Walker(),
                        'fallback_cb'    => false,
                    ]);
                    ?>
                </nav>

                <!-- Tracks CTA -->
                <div class="hidden lg:flex items-center gap-3 ml-4">
                    <a href="<?php echo esc_url(home_url('/tracks/')); ?>" class="btn-accent btn-sm">Explore Tracks</a>
                </div>

                <!-- Mobile Toggle (Main) -->
                <button id="mobile-toggle" class="lg:hidden p-2 -mr-2 transition-colors" aria-label="Toggle menu" aria-expanded="false">
                    <svg id="menu-icon-open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="menu-icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white/95 backdrop-blur-lg border-t border-surface-200 shadow-lg max-h-[80vh] overflow-y-auto">
            <div class="container-custom py-4 space-y-1">
                <?php if ($current_track): ?>
                <!-- Track mobile menu -->
                <a href="<?php echo esc_url(home_url('/tracks/')); ?>" class="flex items-center gap-2 px-3 py-3 text-body-sm font-medium text-ink-muted hover:text-ink hover:bg-surface-100 rounded-xl transition-colors no-underline">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    All Tracks
                </a>
                <div class="h-px bg-surface-200 mx-3"></div>
                <?php foreach ($track_menu_items as $item):
                    $is_active = untrailingslashit($track_current_url) === untrailingslashit(wp_parse_url($item['url'], PHP_URL_PATH));
                ?>
                <a href="<?php echo esc_url($item['url']); ?>" class="block px-3 py-3 rounded-xl text-body-sm font-medium transition-all no-underline <?php echo $is_active ? 'text-white' : 'text-ink-muted hover:bg-surface-100 hover:text-ink'; ?>" <?php if ($is_active): ?>style="background: <?php echo esc_attr($track_colors[$current_track]); ?>; box-shadow: 0 2px 8px <?php echo esc_attr($track_colors[$current_track]); ?>30;"<?php endif; ?>>
                    <?php echo esc_html($item['label']); ?>
                </a>
                <?php endforeach; ?>
                <div class="h-px bg-surface-200 mx-3 mt-3"></div>
                <a href="https://conference.usk.ac.id/<?php echo esc_attr(aic_track_code($current_track)); ?>/" target="_blank" rel="noopener" class="flex items-center justify-center gap-2 w-full py-3.5 mt-2 rounded-xl text-white font-semibold text-body-sm transition-all hover:opacity-90 active:scale-[0.98] no-underline shadow-lg" style="background: <?php echo esc_attr($track_colors[$current_track]); ?>; box-shadow: 0 4px 14px <?php echo esc_attr($track_colors[$current_track]); ?>30;">
                    Submit Abstract
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </a>
                <?php else: ?>
                <!-- Main mobile menu -->
                <?php
                $locations = get_nav_menu_locations();
                $menu_id = $locations['primary'] ?? 0;
                $menu_items = $menu_id ? wp_get_nav_menu_items($menu_id) : [];
                if ($menu_items):
                    // Build tree from flat menu items
                    $menu_tree = [];
                    $orphans = [];
                    $all_items = []; // full lookup by ID
                    foreach ($menu_items as $item) {
                        $item->children = [];
                        $all_items[$item->ID] = $item;
                        if ($item->menu_item_parent == 0) {
                            $menu_tree[$item->ID] = $item;
                        } else {
                            $orphans[] = $item;
                        }
                    }
                    // Attach children to parents (multiple passes for deep nesting)
                    $prev_count = 0;
                    while (count($orphans) > 0 && count($orphans) !== $prev_count) {
                        $prev_count = count($orphans);
                        $remaining = [];
                        foreach ($orphans as $item) {
                            if (isset($all_items[$item->menu_item_parent])) {
                                $all_items[$item->menu_item_parent]->children[] = $item;
                            } else {
                                $remaining[] = $item;
                            }
                        }
                        $orphans = $remaining;
                    }
                    $is_active_page = function($item_id) use ($menu_items) {
                        global $post;
                        if (!$post) return false;
                        $target = array_filter($menu_items, fn($i) => $i->ID == $item_id);
                        if (empty($target)) return false;
                        $target = reset($target);
                        $target_id = $target->object_id;
                        if (!$target_id) return false;
                        $current_id = get_the_ID();
                        if (!$current_id) return false;
                        return $target_id == $current_id;
                    };
                ?>
                <div class="flex flex-col gap-0.5">
                    <?php foreach ($menu_tree as $item):
                        $has_children = !empty($item->children);
                        $is_active = $is_active_page($item->ID);
                    ?>
                    <?php if ($has_children): ?>
                    <div class="mobile-menu-group">
                        <button type="button" class="mobile-submenu-toggle flex items-center justify-between w-full px-3 py-3 rounded-xl text-body-sm font-medium transition-all no-underline <?php echo $is_active ? 'bg-primary/10 text-primary font-semibold' : 'text-ink-muted hover:bg-surface-100 hover:text-ink'; ?>">
                            <span><?php echo esc_html($item->title); ?></span>
                            <svg class="w-4 h-4 shrink-0 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="mobile-submenu hidden pl-4 mt-0.5 space-y-0.5">
                            <?php foreach ($item->children as $child):
                                $child_active = $is_active_page($child->ID);
                            ?>
                            <a href="<?php echo esc_url($child->url); ?>"
                               class="block px-3 py-2.5 rounded-lg text-body-sm font-medium transition-all no-underline <?php echo $child_active ? 'bg-primary/10 text-primary font-semibold' : 'text-ink-muted hover:bg-surface-100 hover:text-ink'; ?>">
                                <?php echo esc_html($child->title); ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <a href="<?php echo esc_url($item->url); ?>"
                       class="block px-3 py-3 rounded-xl text-body-sm font-medium transition-all no-underline <?php echo $is_active ? 'bg-primary/10 text-primary font-semibold' : 'text-ink-muted hover:bg-surface-100 hover:text-ink'; ?>">
                        <?php echo esc_html($item->title); ?>
                    </a>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="h-px bg-surface-200 mx-3 mt-3"></div>
                <a href="https://conference.usk.ac.id/" target="_blank" rel="noopener" class="flex items-center justify-center gap-2 w-full py-3.5 mt-2 rounded-xl text-white font-semibold text-body-sm transition-all hover:opacity-90 active:scale-[0.98] no-underline shadow-lg" style="background: #0D5F3A; box-shadow: 0 4px 14px rgba(13,95,58,0.30);">
                    Submit Abstract
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<main id="main-content">
