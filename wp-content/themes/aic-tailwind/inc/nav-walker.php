<?php
/**
 * Tailwind-styled nav walker. Outputs clean <li> + <a> with proper classes.
 * Enhanced with active underline indicator and smooth transitions.
 */
class AIC_Nav_Walker extends Walker_Nav_Menu {

    private $submenu_ids = [];

    function start_lvl(&$output, $depth = 0, $args = null) {
        $position = $depth === 0 ? 'top-full left-0' : 'top-0 left-full';
        $output .= '<ul id="' . esc_attr($this->submenu_ids[$depth] ?? '') . '" class="sub-menu absolute ' . $position . ' bg-white rounded-xl shadow-lg border border-surface-200 py-2 min-w-[220px] opacity-0 invisible scale-95 transition-all duration-200 z-50">';
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
        if ($has_kids) {
            $li_classes[] = 'group';
            $this->submenu_ids[$depth] = 'desktop-submenu-' . $item->ID;
        }
        if ($depth > 0) $li_classes[] = 'px-1';
        $output .= '<li class="' . esc_attr(implode(' ', $li_classes)) . '">';

        // <a> link styles
        $link_classes = 'block px-3 py-3 rounded-lg text-body-sm font-medium no-underline transition-all duration-200 whitespace-nowrap relative';

        if ($depth > 0) {
            $link_classes .= ' text-ink-muted';
        }

        if ($is_active) {
            $link_classes .= ' text-primary';
        } else {
            $link_classes .= ' hover:text-primary hover:bg-surface-100';
        }

        $output .= '<div class="flex items-center"><a href="' . esc_url($item->url) . '" class="' . esc_attr($link_classes) . '"' . ($is_active ? ' aria-current="page"' : '') . '>';
        $output .= '<span>' . esc_html($item->title) . '</span>';

        // Active underline indicator
        if ($is_active && $depth === 0) {
            $output .= '<span class="absolute bottom-0.5 left-3 right-3 h-0.5 bg-primary rounded-full"></span>';
        }

        $output .= '</a>';
        if ($has_kids) {
            $output .= '<button type="button" class="desktop-submenu-toggle" aria-label="' . esc_attr('Toggle ' . $item->title . ' submenu') . '" aria-expanded="false" aria-controls="' . esc_attr($this->submenu_ids[$depth]) . '"><svg class="w-3.5 h-3.5" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg></button>';
        }
        $output .= '</div>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}
