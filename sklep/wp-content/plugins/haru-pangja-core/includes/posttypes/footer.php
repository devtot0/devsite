<?php
/** 
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( !class_exists( 'Haru_Footer_Post_Type' ) ) {
    class Haru_Footer_Post_Type {
        protected $prefix;

        public function __construct(){
            $this->prefix = 'haru_footer';

            add_action('init', array($this, 'haru_footer'));
        }
        
        function haru_footer() {
            $labels = array(
                'menu_name'          => esc_html__( 'Footer Blocks', 'haru-pangja' ),
                'singular_name'      => esc_html__( 'Footer', 'haru-pangja' ),
                'name'               => esc_html__( 'All footer', 'haru-pangja' ),
                'add_new'            => esc_html__( 'Add New', 'haru-pangja' ) ,
                'add_new_item'       => esc_html__( 'Add New Footer', 'haru-pangja' ) ,
                'edit_item'          => esc_html__( 'Edit Footer', 'haru-pangja' ) ,
                'new_item'           => esc_html__( 'Add New Footer', 'haru-pangja' ) ,
                'view_item'          => esc_html__( 'View Footer', 'haru-pangja' ) ,
                'search_items'       => esc_html__( 'Search Footer', 'haru-pangja' ) ,
                'not_found'          => esc_html__( 'No Footer items found', 'haru-pangja' ) ,
                'not_found_in_trash' => esc_html__( 'No Footer items found in trash', 'haru-pangja' ) ,
                'parent_item_colon'  => ''
            );

            $args = array(
                'labels'                => $labels,
                'description'           => esc_html__( 'Display footer of site', 'haru-pangja' ),
                'supports'              => array( ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_icon'             => 'dashicons-menu',
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => false,
                'capability_type'       => 'page',
            );

            register_post_type( 'haru_footer', $args );
        }
    }

    new Haru_Footer_Post_Type;
}