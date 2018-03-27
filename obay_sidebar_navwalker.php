<?php namespace obay\libs;

class obay_sidebar_navwalker extends \Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<ul>';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes = array();
        if( !empty( $item->classes ) ) {
            $classes = (array) $item->classes;
        }

        $klass = '';
        if( in_array('current-menu-item', $classes) ) {
            $klass .= 'active';
        }
        if( in_array('menu-item-has-children', $classes) ) {
            $klass .= 'has-sub';
        }

        $url = '';
        if( !empty( $item->url ) ) {
            $url = $item->url;
        }

        $output .= '<li class="'. $klass . '"><a href="' . $url . '">' . $item->title . '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= '</li>';
    }
}