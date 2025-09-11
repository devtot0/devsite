<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( !class_exists( 'Haru_Testimonial_Post_Type' ) ) {
    class Haru_Testimonial_Post_Type {

        protected $prefix;

        public function __construct() {
            $this->prefix = 'haru_testimonial';

            add_action('init', array($this,'haru_testimonial'));
            add_action('admin_init', array($this, 'haru_register_meta_boxes'));

            if( is_admin() ) {
                add_action( 'do_meta_boxes', array( $this, 'remove_plugin_metaboxes' ) );
                // Add custom columns reference: http://code.tuharulus.com/articles/add-a-custom-column-in-posts-and-custom-post-types-admin-screen--wp-24934
                add_filter( 'manage_haru_testimonial_posts_columns', array( $this, 'add_columns' ) );
                add_action( 'manage_haru_testimonial_posts_custom_column', array( $this, 'set_columns_value'), 10, 2);
            }
        }

        function remove_plugin_metaboxes() {
            remove_meta_box( 'mymetabox_revslider_0', 'haru_testimonial', 'normal' );
            remove_meta_box( 'handlediv', 'haru_testimonial', 'normal' );
            remove_meta_box( 'commentsdiv', 'haru_testimonial', 'normal' );
        }

        function haru_testimonial() {
            $labels = array(
                'name'               => esc_html__( 'Testimonials', 'haru-pangja' ),
                'singular_name'      => esc_html__( 'Testimonial', 'haru-pangja' ),
                'menu_name'          => esc_html__( 'Testimonials', 'haru-pangja' ),
                'add_new'            => esc_html__( 'Add New', 'haru-pangja' ) ,
                'add_new_item'       => esc_html__( 'Add New Testimonial', 'haru-pangja' ) ,
                'edit_item'          => esc_html__( 'Edit Testimonial', 'haru-pangja' ) ,
                'new_item'           => esc_html__( 'Add New Testimonial', 'haru-pangja' ) ,
                'view_item'          => esc_html__( 'View Testimonial', 'haru-pangja' ) ,
                'search_items'       => esc_html__( 'Search Testimonial', 'haru-pangja' ) ,
                'not_found'          => esc_html__( 'No Testimonial items found', 'haru-pangja' ) ,
                'not_found_in_trash' => esc_html__( 'No Testimonial items found in trash', 'haru-pangja' ) ,
                'parent_item_colon'  => '',
            );

            $args = array(
                'labels'                => $labels,
                'description'           => esc_html__( 'Display client\'s testimonials', 'haru-pangja' ),
                'supports'              => array( 'title', 'editor', 'thumbnail' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_icon'             => 'dashicons-id',
                'menu_position'         => 5,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'post',
                'rewrite'           => array(
                    'slug'          => 'testimonial',
                    'with_front'    => false
                ) ,
            );

            register_post_type( 'haru_testimonial', $args );

            // Register a taxonomy for Testimonials Categories.
            $category_labels = array(
                'name'                          => esc_html__( 'Testimonial Categories', 'haru-pangja' ) ,
                'singular_name'                 => esc_html__( 'Testimonial Category', 'haru-pangja') ,
                'menu_name'                     => esc_html__( 'Categories', 'haru-pangja' ) ,
                'all_items'                     => esc_html__( 'All Testimonial Categories', 'haru-pangja' ) ,
                'edit_item'                     => esc_html__( 'Edit Testimonial Category', 'haru-pangja' ) ,
                'view_item'                     => esc_html__( 'View Testimonial Category', 'haru-pangja' ) ,
                'update_item'                   => esc_html__( 'Update Testimonial Category', 'haru-pangja' ) ,
                'add_new_item'                  => esc_html__( 'Add New Testimonial Category', 'haru-pangja' ) ,
                'new_item_name'                 => esc_html__( 'New Testimonial Category Name', 'haru-pangja' ) ,
                'parent_item'                   => esc_html__( 'Parent Testimonial Category', 'haru-pangja' ) ,
                'parent_item_colon'             => esc_html__( 'Parent Testimonial Category:', 'haru-pangja' ) ,
                'search_items'                  => esc_html__( 'Search Testimonial Categories', 'haru-pangja' ) ,
                'popular_items'                 => esc_html__( 'Popular Testimonial Categories', 'haru-pangja') ,
                'separate_items_with_commas'    => esc_html__( 'Separate Testimonial Categories with commas', 'haru-pangja' ) ,
                'add_or_remove_items'           => esc_html__( 'Add or remove Testimonial Categories', 'haru-pangja' ) ,
                'choose_from_most_used'         => esc_html__( 'Choose from the most used Testimonial Categories', 'haru-pangja' ) ,
                'not_found'                     => esc_html__( 'No Testimonial Categories found', 'haru-pangja' ) ,
            );

            $category_args = array(
                'labels'            => $category_labels,
                'public'            => false,
                'show_ui'           => true,
                'show_in_nav_menus' => false,
                'show_tagcloud'     => false,
                'show_admin_column' => false,
                'hierarchical'      => true,
                'query_var'         => true,
                'rewrite'           => array(
                    'slug'          => 'category',
                    'with_front'    => false
                ) ,
            );

            register_taxonomy('testimonial_category', array(
                'haru_testimonial'
            ) , $category_args);
        }

        // Add columns to Testimonial
        function add_columns($columns) {
            unset(
                $columns['cb'],
                $columns['title'],
                $columns['date']
            );
            $cols = array_merge(array('cb' => ('')), $columns);
            $cols = array_merge($cols, array('title' => esc_html__( 'Name', 'haru-pangja' )));
            $cols = array_merge($cols, array('category' => esc_html__( 'Category', 'haru-pangja' )));
            $cols = array_merge($cols, array('thumbnail' => esc_html__( 'Picture', 'haru-pangja' )));
            $cols = array_merge($cols, array('date' => esc_html__( 'Date', 'haru-pangja' )));

            return $cols;
        }

        // Set values for columns
        function set_columns_value($column, $post_id) {
            $prefix = $this->prefix;
            
            switch ($column) {
                case 'id': {
                    echo wp_kses_post($post_id);
                    break;
                }
                case 'category': {
                    $terms = get_the_terms( $post_id, 'testimonial_category' );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        $term_links = array();
                        foreach($terms as $term) {
                            $term_links[] = $term->name;
                        }
                        echo join( ", ", $term_links );
                    }
                    break;
                }
                case 'thumbnail': {
                    echo get_the_post_thumbnail($post_id, 'thumbnail');
                    break;
                }
            }
        }

        // Register metaboxies
        function haru_register_meta_boxes() {
            $prefix       = $this->prefix;

            $meta_boxes   = array();
            $meta_boxes[] = array(
                'id'            => "{$prefix}_meta_boxes",
                'title'         => esc_html__( 'Testimonial Information:', 'haru-pangja' ),
                'post_types'    => array( 'haru_testimonial' ),
                'fields'        => array(
                    array(
                        'id'    => "{$prefix}_position",
                        'name'  => esc_html__( 'Position', 'haru-pangja' ),
                        'type'  => 'text',
                    ),
                    array(
                        'name'        => esc_html__( 'Rating', 'haru-pangja' ),
                        'id'          => "{$prefix}_rating",
                        'type'        => 'select',
                        'options'     => array(
                            '1' => esc_html__( '1 Star', 'haru-pangja' ),
                            '2' => esc_html__( '2 Stars', 'haru-pangja' ),
                            '3' => esc_html__( '3 Stars', 'haru-pangja' ),
                            '4' => esc_html__( '4 Stars', 'haru-pangja' ),
                            '5' => esc_html__( '5 Stars', 'haru-pangja' ),
                        ),
                        'multiple'    => false,
                        'std'         => '1',
                        'placeholder' => esc_html__( 'Select Rating', 'haru-pangja' ),
                    ),
                )
            );
            
            // Use RW Metaboxies fields
            if ( class_exists('RW_Meta_Box') ) {
                foreach ($meta_boxes as $meta_box) {
                    new RW_Meta_Box($meta_box);
                }
            }
        }
    }

    new Haru_Testimonial_Post_Type;
}