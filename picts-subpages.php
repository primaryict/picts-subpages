<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Primary ICT Support - Sub Pages
 * Plugin URI:        www.primaryictsupport.co.uk
 * Description:       PICTS Plugin to display all sub pages using shortcode [picts_childpages]
 * Version:           1.0.2
 * Author:            John Emmett
 * Author URI:        www.primaryictsupport.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Set up plugin constants
define( 'PICTS_SUBPAGES_PLUGIN_DIR', plugin_dir_path(__FILE__) );
define( 'PICTS_SUBPAGES_BASENAME', plugin_basename(__FILE__) );


/**
 * Shortcode registration for the subpage code
**/
function picts_list_child_pages() {

    global $post;

    $link_after = '<a href="#" class="dropDown"><span class="dashicons dashicons-arrow-down-alt2"></span></i></a>';

    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&link_after='.$link_after.'&child_of=' . $post->ID . '&echo=0' );

    if ( $childpages ) {
        $string = '<div class="picts_sub_page_list_wrapper"><h4>Menu</h4><ul class="picts_sub_page_list">' . $childpages . '</ul></div>';
    } else {
        $string = wp_nav_menu(
			array(
				'theme_location'  => 'sidebar-fallback-menu',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'picts_sub_page_list_wrapper',
				'items_wrap'      => '<h4>Menu</h4><ul class="picts_sub_page_list menuList" class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
				'link_after'      => $link_after
			)
		);

    }
    return $string;
}

add_shortcode('picts_childpages', 'picts_list_child_pages');


/**
 * Loading All CSS Stylesheets and Javascript Files.
**/
function picts_subpages_scripts_loader() {

	// 1. Styles.
	wp_enqueue_style( 'style', plugin_dir_url( __FILE__ ) . 'assets/css/picts-subpages.css' );
	wp_enqueue_style('dashicons');

	// 2. Scripts.
	wp_enqueue_script( 'mainjs', plugin_dir_url( __FILE__ ) . 'assets/js/picts-subpages.js', 9999);


}
add_action( 'wp_enqueue_scripts', 'picts_subpages_scripts_loader' );



function register_menus() {
    register_nav_menu('sidebar-fallback-menu',__('Sidebar Fallback Menu'));
}
add_action('init', 'register_menus');

/**
 * Loading Classes.
**/

$picts_updater = PICTS_SUBPAGES_PLUGIN_DIR . '/inc/updater/picts-updater.php';
if ( is_readable( $picts_updater ) ) {
    require_once $picts_updater;
}
