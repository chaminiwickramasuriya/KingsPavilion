<?php
class Hamburger_Menu_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<ul class="sub-menu">';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $has_children = in_array('menu-item-has-children', $item->classes);

        $output .= '<li class="' . implode(' ', $item->classes) . '">';

        $output .= '<div class="menu-item-wrapper">';

        // Parent link
        $output .= '<a href="' . esc_attr($item->url) . '">' . esc_html($item->title) . '</a>';

		// Toggle icon if it has children
        if ( $has_children ) {
            $output .= '<span class="submenu-toggle" role="button" tabindex="0"><svg class="icon"><use xlink:href="#Down_Arrow"></use></svg></span>';
        }
        

        $output .= '</div>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= '</li>';
    }
}
