<?php
/**
 * Section Heading — reusable heading block with optional eyebrow and subtitle.
 *
 * Usage:
 *   $eyebrow   = 'Important Dates';      // optional — small text above title
 *   $title     = 'Key Dates';            // required
 *   $subtitle  = 'Important deadlines…'; // optional — description below title
 *   $align     = 'center';               // optional — 'center' (default) or 'left'
 *   $class     = 'mb-8';                 // optional — extra CSS classes on wrapper
 *   include get_template_directory() . '/template-parts/section-heading.php';
 */
if (!defined('ABSPATH')) exit;
if (!isset($title)) return;

$eyebrow  = $eyebrow  ?? '';
$subtitle = $subtitle ?? '';
$align    = $align    ?? 'center';
$class    = $class    ?? '';

$is_center = $align === 'center';
$wrapper   = $is_center ? 'text-center max-w-2xl mx-auto' : '';
$wrapper  .= $class ? ' ' . $class : '';
?>
<div class="reveal <?php echo esc_attr($wrapper); ?>">
    <?php if ($eyebrow): ?>
        <p class="section-eyebrow"><?php echo esc_html($eyebrow); ?></p>
    <?php endif; ?>

    <h2 class="section-title"><?php echo esc_html($title); ?></h2>

    <?php if ($subtitle): ?>
        <p class="section-subtitle<?php echo $is_center ? ' mx-auto' : ''; ?>"><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>
</div>
