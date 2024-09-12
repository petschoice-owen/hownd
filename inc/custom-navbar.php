<?php

class WP_bootstrap_4_walker_nav_menu extends Walker_Nav_menu {

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $object      = $item->object;
    	$type        = $item->type;
    	$title       = $item->title;
    	$description = $item->description;
    	$permalink   = $item->url;

        $active_class = '';
        if( $item->classes && in_array('current-menu-item', $item->classes) ) {
            $active_class = '';
        }

        $dropdown_class = '';
        $dropdown_link_class = '';
        if( $args->walker->has_children ) {
            $dropdown_class = 'dropdown';
            $dropdown_link_class = 'dropdown-toggle';
        }

        $output .= "<li class='nav-item $active_class $dropdown_class " .  ( $item->classes ? implode(" ", $item->classes) : '' ) . "'>";

        if( $args->walker->has_children) {
            $output .= '<a href="' . esc_url($permalink) . '" class="nav-link ' . $dropdown_link_class . '">';
        }
        else {
            $output .= '<a href="' . esc_url($permalink) . '" class="nav-link">';
        }

        $output .= $title;

        // if( $description != '' && $depth == 0 ) {
        //     $output .= '<small class="description">' . $description . '</small>';
        // }

        if( $args->walker->has_children) {
            $output .= '<span class="nav-item__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="20" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" fill="currentColor"></path><path fill="none" d="M0 0h24v24H0V0z"></path></svg></span>';
        }

        $output .= '</a>';
    }

    function start_lvl( &$output, $depth=0, $args = array() ){
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "<ul class='dropdown-menu $submenu depth_$depth'>";
    }


}
