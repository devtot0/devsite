<?php
/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
if ( ! defined( 'ABSPATH' ) ) die( '-1' );

if ( ! class_exists('Haru_Framework_Shortcode_Products_List') ) {
    class Haru_Framework_Shortcode_Products_List {
        function __construct() {
            add_shortcode( 'haru_products_list', array( $this, 'haru_products_list_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_products_list_vc_map') );
        }

        function haru_products_list_shortcode($atts) {
            global $woocommerce;      

            $atts        = vc_map_get_attributes( 'haru_products_list', $atts );
            $data_source = $category = $product_ids = $paging_style = $per_page = $paging_align = $orderby = $order = $el_class = $css_animation = $duration = $delay = $haru_animation = $styles_animation = '';
            extract(shortcode_atts(array(
                'data_source'        => '',
                'category'           => '',
                'product_ids'        => '',
                'per_page'           => '4',
                'paging_style'       => 'default', // page number
                'paging_align'       => 'center',
                'orderby'            => 'date',
                'order'              => 'asc',
                'el_class'           => '',
                'css_animation'      => '',
                'duration'           => '',
                'delay'              => ''
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();
            
            ?>
            
            <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('products/list.php', array('atts' => $atts), '', '' ); ?>
            </div>

            <?php
            wp_reset_postdata();
            $content =  ob_get_clean();
            
            return $content;
        }

        function haru_products_list_vc_map() {
            vc_map(
                array(
                    'base'        => 'haru_products_list',
                    'name'        => esc_html__( 'Haru Products List', 'haru-pangja' ),
                    'icon'        => 'fa fa-shopping-cart haru-vc-icon',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'description' => esc_html__( 'Display product with list layout', 'haru-pangja' ),
                    'params'      => array(
                        array(
                            'param_name'  => 'data_source',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Data Source', 'haru-pangja' ),
                            'description' => esc_html__( 'Choose the source which products will be displayed on products page.', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'Categories', 'haru-pangja' )    => 'product_cat',
                                esc_html__( 'Product Items', 'haru-pangja' ) => 'product_list_id'
                            )
                        ),
                        array(
                            'param_name'  => 'category',
                            'type'        => 'haru_product_categories',
                            'heading'     => esc_html__( 'Categories', 'haru-pangja' ),
                            'admin_label' => true,
                            'dependency'  => array(
                                'element' => 'data_source',
                                'value'   => array('product_cat')
                            ),
                        ),
                        array(
                            'param_name' => 'product_ids',
                            'type'       => 'haru_product_list',
                            'heading'    => esc_html__( 'Product Items', 'haru-pangja' ),
                            'dependency' => array(
                                'element' => 'data_source', 
                                'value'   => array('product_list_id')
                            )
                        ),
                        array(
                            'param_name'  => 'per_page',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Products Per Page', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => 12 ,
                        ),
                        array(
                            'param_name' => 'paging_style',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Pagination', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Page Number', 'haru-pangja' )        => 'default',
                                esc_html__( 'Load More Button', 'haru-pangja' )   => 'load-more',
                                esc_html__( 'Infinite Scrolling', 'haru-pangja' ) => 'infinity-scroll',
                            ),
                            'description'      => esc_html__( 'Choose pagination type.', 'haru-pangja' ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name' => 'paging_align',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Paging alignment', 'haru-pangja' ),
                            'description'=> esc_html__( 'Select filter alignment.', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Center', 'haru-pangja' ) => 'center',
                                esc_html__( 'Left', 'haru-pangja' )   => 'left',
                                esc_html__( 'Right', 'haru-pangja' )  => 'right'
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding', 
                        ),
                        array(
                            'param_name' => 'orderby',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Order By', 'haru-pangja' ),
                            'description'=> esc_html__( 'Select how to sort retrieved products.', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Publish Date', 'haru-pangja' ) => 'date',
                                esc_html__( 'Random', 'haru-pangja' )       => 'rand',
                                esc_html__( 'Alphabetic', 'haru-pangja' )   => 'title',
                                esc_html__( 'Popularity', 'haru-pangja' )   => 'popularity',
                                esc_html__( 'Rate', 'haru-pangja' )         => 'rating',
                                esc_html__( 'Price', 'haru-pangja' )        => 'price' 
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name' => 'order',
                            'type'       => 'dropdown',
                            'class'      => '',
                            'heading'    => esc_html__( 'Sort order', 'haru-pangja' ),
                            'description'=> esc_html__( 'Select sorting order.', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Ascending', 'haru-pangja' )  => 'asc',
                                esc_html__( 'Descending', 'haru-pangja' ) => 'desc' 
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding', 
                        ),
                        Haru_PangjaCore_Shortcodes::add_css_animation(),
                        Haru_PangjaCore_Shortcodes::add_duration_animation(),
                        Haru_PangjaCore_Shortcodes::add_delay_animation(),
                        Haru_PangjaCore_Shortcodes::add_el_class()
                    )
                )
            );
        }
    }

    new Haru_Framework_Shortcode_Products_List();
}