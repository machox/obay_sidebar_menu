<?php
/**
 * @package obay_sidebar_menu
 * @version 1.0
 */
/*
Plugin Name: Sidebar Menu Widget
Plugin URI: http://wordpress.org
Description: Plugin to make sidebar menu widget.
Author: Bayu Prahasto
Version: 1.0
Author URI: mailto:bayoe13@gmail.com
*/

require_once plugin_dir_path(__FILE__).'/obay_sidebar_menu_widget.php';
require_once plugin_dir_path(__FILE__).'/obay_sidebar_navwalker.php';
 
use obay\libs\obay_sidebar_menu_widget;

class Obay_sidebar_menu {

    private static $_instance = null;
    private $widget_class = null;

    public static function getInstance() {
        if( is_null( self::$_instance ) ){
            self::$_instance = new Obay_sidebar_menu();
        }
        return self::$_instance;
    }

    private function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );
        add_action( 'widgets_init',  array( $this, 'registerWidget' ) );
        $this->registerMenu();
    }

    /* register widget */
	public function registerWidget() {
        register_widget( new obay_sidebar_menu_widget );
        return true;
    }

    /* Set navigation menus on themes */
    public function registerMenu() {
        register_nav_menus( array(
            'sidebar' => __( 'Sidebar Menu'),
        ) );
    }

    /* enqueue script and CSS */
    public function enqueueScripts(){
        wp_enqueue_script( 'jquery' );
       	wp_enqueue_style(
            'obay-sidebar-menu',
            plugin_dir_url( __FILE__ ) . 'css/style.css',
            array(),
            '',
            FALSE
        );
    }
}

add_action( 'plugins_loaded', function(){
    Obay_sidebar_menu::getInstance();
}, 10 );
