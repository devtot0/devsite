<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

 /*  Purpose: Register sidebar and add more custom sidebar via AJAX
 *   Files: theme-functions.php, haru-custom-sidebar.js, admin-style.css
 */

if ( !function_exists('haru_register_sidebar') ) {
    function haru_register_sidebar() {
        register_sidebar( 
            array(
                'name'          => esc_html__( 'Sidebar 1','pangja' ),
                'id'            => 'sidebar-1',
                'description'   => esc_html__( 'Widget Area 1 for Archive or Single Blog','pangja' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h4 class="widget-title"><span>',
                'after_title'   => '</span></h4>',
            ) 
        );
        register_sidebar( 
            array(
                'name'          => esc_html__( 'Sidebar 2','pangja' ),
                'id'            => 'sidebar-2',
                'description'   => esc_html__( 'Widget Area 2 for Archive or Single Blog','pangja' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h4 class="widget-title"><span>',
                'after_title'   => '</span></h4>',
            ) 
        );
        register_sidebar( 
            array(
                'name'          => esc_html__( 'WooCommerce','pangja' ),
                'id'            => 'woocommerce',
                'description'   => esc_html__( 'WooCommerce Sidebar','pangja' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h4 class="widget-title"><span>',
                'after_title'   => '</span></h4>',
            ) 
        );
        if ( true == haru_check_core_plugin_status() ) {
            register_sidebar(
                array(
                    'name'          => esc_html__( 'Top Header Left','pangja' ),
                    'id'            => 'top_header_left',
                    'description'   => esc_html__( 'Widget Area to display Top Bar left','pangja' ),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h4 class="widget-title"><span>',
                    'after_title'   => '</span></h4>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Top Header Right','pangja' ),
                    'id'            => 'top_header_right',
                    'description'   => esc_html__( 'Widget Area to display Top Bar right','pangja' ),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h4 class="widget-title"><span>',
                    'after_title'   => '</span></h4>',
                )
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'WooCommerce Ajax Filter','pangja' ),
                    'id'            => 'woocommerce_ajax_filter',
                    'description'   => esc_html__( 'WooCommerce Sidebar Ajax Filter','pangja' ),
                    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h4 class="widget-title"><span>',
                    'after_title'   => '</span></h4>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Footer Tags','pangja' ),
                    'id'            => 'footer_tags',
                    'description'   => esc_html__( 'Display Product tags','pangja' ),
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Footer Gallery','pangja' ),
                    'id'            => 'footer_gallery',
                    'description'   => esc_html__( 'Display Footer Gallery','pangja' ),
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Footer Gallery 2','pangja' ),
                    'id'            => 'footer_gallery_2',
                    'description'   => esc_html__( 'Display Footer Gallery 2','pangja' ),
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Mega Menu Column 1','pangja' ),
                    'id'            => 'mega_menu_column_1',
                    'description'   => esc_html__( 'Display Mega Menu Column widget','pangja' ),
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Mega Menu Column 2','pangja' ),
                    'id'            => 'mega_menu_column_2',
                    'description'   => esc_html__( 'Display Mega Menu Column widget 2','pangja' ),
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Mega Menu Tab 1','pangja' ),
                    'id'            => 'mega_menu_tab_1',
                    'description'   => esc_html__( 'Display Mega Menu Tab widget','pangja' ),
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Mega Menu Tab 2','pangja' ),
                    'id'            => 'mega_menu_tab_2',
                    'description'   => esc_html__( 'Display Mega Menu Tab widget 2','pangja' ),
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Mega Menu Tab 3','pangja' ),
                    'id'            => 'mega_menu_tab_3',
                    'description'   => esc_html__( 'Display Mega Menu Tab widget 3','pangja' ),
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                ) 
            );
            register_sidebar( 
                array(
                    'name'          => esc_html__( 'Canvas Sidebar','pangja' ),
                    'id'            => 'canvas-sidebar',
                    'description'   => esc_html__( 'Display Header Element Canvas Sidebar widget','pangja' ),
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                ) 
            );
        }

        // Add custom sidebar using ajax
        $custom_sidebars = haru_get_custom_sidebars();
        if( is_array($custom_sidebars) && !empty($custom_sidebars) ) {
            foreach( $custom_sidebars as $name ) {
                $haru_custom_sidebars[] = array(
                    'name'          => ''.$name.'',
                    'id'            => sanitize_title($name),
                    'description'   => '',
                    'class'         => 'haru-custom-sidebar',
                    'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<div class="widget-title-wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
                    'after_title'   => '</h3></div>',
                );
            }
            foreach( $haru_custom_sidebars as $custom_sidebar ) {
                register_sidebar($custom_sidebar);
            }
        }

    }

    add_action( 'widgets_init', 'haru_register_sidebar' );
}