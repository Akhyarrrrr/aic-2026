<?php
/**
 * AIC Tailwind Theme - Functions
 */

if (!defined('ABSPATH')) exit;

// Include nav walker
require_once get_template_directory() . '/inc/nav-walker.php';
// CPT + ACF
require_once get_template_directory() . '/inc/cpt-acf.php';
// Settings page
require_once get_template_directory() . '/inc/settings-page.php';
// TEMPORARY: seed data (uncomment to populate speakers + committees)
// require_once get_template_directory() . '/inc/seed-data.php';
// aic_run_seed();

// ============================================
// Theme Setup
// ============================================
function aic_tailwind_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('responsive-embeds');

    // Register nav menus
    register_nav_menus([
        'primary' => __('Primary Menu', 'aic-tailwind'),
        'footer'  => __('Footer Menu', 'aic-tailwind'),
        'track'   => __('Track Sub-menu', 'aic-tailwind'),
    ]);
}
add_action('after_setup_theme', 'aic_tailwind_setup');

// ============================================
// Assets
// ============================================
function aic_tailwind_assets() {
    $theme_version = filemtime(get_template_directory() . '/assets/css/main.css') ?: '1.0.0';

    // Theme CSS
    wp_enqueue_style(
        'aic-tailwind',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        $theme_version
    );

    // Poppins font
    wp_enqueue_style(
        'google-fonts-poppins',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // Theme JS
    $js_version = filemtime(get_template_directory() . '/assets/js/main.js') ?: '1.0.0';
    wp_enqueue_script(
        'aic-tailwind-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $js_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'aic_tailwind_assets');

// ============================================
// Preconnect to Google Fonts (reduces font load latency)
// ============================================
function aic_preconnect_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'aic_preconnect_fonts', 1);

// ============================================
// Remove bloat
// ============================================
function aic_tailwind_cleanup() {
    // Remove WP block CSS
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('classic-theme-styles');
    // Remove global styles inline CSS
    wp_dequeue_style('global-styles');
    // Remove emoji cruft
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    // Remove WP version
    remove_action('wp_head', 'wp_generator');
    // Remove RSS feed links
    remove_action('wp_head', 'feed_links_extra', 3);
    // Remove adjacent post links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    // Remove REST API link
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    // Remove oEmbed discovery links
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    // Remove template saving
    remove_action('wp_head', '_wp_render_title_tag', 10);
    // Remove Dashicons on frontend (keep if admin bar shown)
    if (!is_admin() && !is_user_logged_in()) {
        wp_dequeue_style('dashicons');
    }
}
add_action('wp_enqueue_scripts', 'aic_tailwind_cleanup', 100);

// ============================================
// Body class
// ============================================
function aic_tailwind_body_class($classes) {
    if (is_front_page()) {
        $classes[] = 'is-front-page';
        $classes[] = 'home';
    }
    if (is_singular()) {
        $classes[] = 'is-singular';
    }
    return $classes;
}
add_filter('body_class', 'aic_tailwind_body_class');

// ============================================
// Clean Colibri HTML — strip builder wrappers, keep content
// ============================================
function aic_clean_colibri($html) {
    if (empty(trim($html))) return '';

    // Remove <!----> comment placeholders
    $html = str_replace('<!---->', '', $html);

    // Remove Colibri data attributes
    $html = preg_replace('/\s*data-colibri-id="[^"]*"/i', '', $html);
    $html = preg_replace('/\s*data-colibri-component="[^"]*"/i', '', $html);

    // Remove inline Colibri styles (they reference Colibri class IDs)
    $html = preg_replace('/\s*style="[^"]*style-\d+[^"]*"/i', '', $html);
    $html = preg_replace('/\s*class="[^"]*style-\d+[^"]*"/i', '', $html);
    $html = preg_replace('/\s*class="[^"]*style-local-\d+[^"]*"/i', '', $html);

    // Strip Colibri structural wrapper classes but keep the elements
    $strip_classes = [
        'h-section\S*', 'h-row-container\S*', 'h-row\S*',
        'h-column-container\S*', 'h-column\S*', 'h-flex-basis\S*',
        'h-column__inner\S*', 'h-column__content\S*', 'h-column__v-align\S*',
        'h-y-container\S*', 'h-section-grid-container\S*', 'h-section-boxed-container\S*',
        'h-global-transition-all\S*', 'h-text-component\S*', 'h-element\S*',
        'h-px-lg\S*', 'h-px-md\S*', 'h-px\S*', 'v-inner-lg\S*', 'v-inner-md\S*', 'v-inner\S*',
        'w-100\S*', 'position-relative\S*', 'd-flex\S*',
        'gutters-row-lg\S*', 'gutters-row-md\S*', 'gutters-col-lg\S*', 'gutters-col-md\S*',
        'gutters-col-v-lg\S*', 'gutters-col-v-md\S*', 'gutters-row-v-lg\S*', 'gutters-row-v-md\S*',
        'align-items-lg-center\S*', 'align-items-md-center\S*', 'align-items-center\S*',
        'justify-content-lg-center\S*', 'justify-content-md-center\S*', 'justify-content-center\S*',
        'align-self-lg-start\S*', 'align-self-md-start\S*', 'align-self-start\S*',
        'flex-basis-100\S*', 'h-col-lg-auto\S*', 'h-col-md-auto\S*', 'h-col-auto\S*', 'h-col-12\S*',
    ];
    foreach ($strip_classes as $cls) {
        $html = preg_replace('/\s*class="[^"]*' . $cls . '[^"]*"/i', '', $html);
    }

    // Remove empty or nearly-empty div wrappers
    $html = preg_replace('/<div[^>]*>\s*(?:<div[^>]*>\s*)*\s*<\/div>/i', '', $html);
    $prev = '';
    while ($prev !== $html) {
        $prev = $html;
        $html = preg_replace('/<div[^>]*>\s*<\/div>/i', '', $html);
    }

    // Clean excessive whitespace
    $html = preg_replace('/\n\s*\n\s*\n/', "\n\n", $html);
    $html = preg_replace('/^\s+|\s+$/m', '', $html);

    return trim($html);
}

// ============================================
// Track color helper
// ============================================
function aic_track_color($slug) {
    $colors = ['se' => '#F79007', 'els' => '#137622', 'ss' => '#AA39AF'];
    return $colors[$slug] ?? '#0D5F3A';
}

function aic_track_name($slug) {
    $names = ['se' => 'Sciences & Engineering', 'els' => 'Environmental & Life Sciences', 'ss' => 'Social Sciences'];
    return $names[$slug] ?? '';
}

function aic_track_code($slug) {
    $codes = ['se' => 'AIC-SE', 'els' => 'AIC-ELS', 'ss' => 'AIC-SS'];
    return $codes[$slug] ?? '';
}

// ============================================
// Fallback footer links (when no menu assigned)
// ============================================
function aic_fallback_footer_links() {
    $links = [
        '/se/'          => 'Sciences & Engineering',
        '/els/'         => 'Environmental & Life Sciences',
        '/ss/'          => 'Social Sciences',
        '/call-for-paper/' => 'Call for Paper',
        '/conference/registration-fee/' => 'Registration',
    ];
    foreach ($links as $url => $label) {
        echo '<li><a href="' . esc_url(home_url($url)) . '" class="block py-1.5 text-surface-400 hover:text-accent transition-colors no-underline text-body-sm">' . esc_html($label) . '</a></li>';
    }
}

// Add mobile-friendly touch padding to footer nav menu links
add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
    if ($args->theme_location === 'footer') {
        $atts['class'] = ($atts['class'] ?? '') . ' block py-1.5 text-surface-400 hover:text-accent transition-colors no-underline text-body-sm';
    }
    return $atts;
}, 10, 3);
