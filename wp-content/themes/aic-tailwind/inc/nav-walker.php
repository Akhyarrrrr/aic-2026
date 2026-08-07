<?php
/**
 * Tailwind-styled nav walker. Outputs clean <li> + <a> with proper classes.
 * Enhanced with active underline indicator and smooth transitions.
 */
class AIC_Nav_Walker extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="sub-menu absolute top-full left-0 mt-2 bg-white rounded-xl shadow-lg border border-surface-200 py-2 min-w-[220px] opacity-0 invisible group-hover:opacity-100 group-hover:visible scale-95 group-hover:scale-100 transition-all duration-200 z-50">';
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes   = empty($item->classes) ? [] : (array) $item->classes;
        $has_kids  = in_array('menu-item-has-children', $classes);
        $is_active = in_array('current-menu-item', $classes);

        // <li> wrapper
        $li_classes = ['relative'];
        if ($has_kids)  $li_classes[] = 'group';
        if ($depth > 0) $li_classes[] = 'px-1';
        $output .= '<li class="' . esc_attr(implode(' ', $li_classes)) . '">';

        // <a> link styles
        $link_classes = 'block px-3 py-2 rounded-lg text-body-sm font-medium no-underline transition-all duration-200 whitespace-nowrap relative';

        if ($depth > 0) {
            $link_classes .= ' text-ink-muted';
        }

        if ($is_active) {
            $link_classes .= ' text-primary';
        } else {
            $link_classes .= ' hover:text-primary hover:bg-surface-100';
        }

        $output .= '<a href="' . esc_url($item->url) . '" class="' . esc_attr($link_classes) . '">';
        $output .= '<span>' . esc_html($item->title) . '</span>';

        // Active underline indicator
        if ($is_active && $depth === 0) {
            $output .= '<span class="absolute bottom-0.5 left-3 right-3 h-0.5 bg-primary rounded-full"></span>';
        }

        // Dropdown chevron
        if ($has_kids && $depth === 0) {
            $output .= '<svg class="inline w-3 h-3 ml-1 opacity-50 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
        }
        $output .= '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}
