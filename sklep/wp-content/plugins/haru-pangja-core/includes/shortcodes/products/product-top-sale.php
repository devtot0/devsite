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

if ( ! class_exists('Haru_Framework_Shortcode_Products_Top_Sale') ) {
    class Haru_Framework_Shortcode_Products_Top_Sale {
        function __construct() {
            add_shortcode( 'haru_products_top_sale', array($this, 'haru_products_top_sale_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_products_top_sale_vc_map') );
        }

        function haru_products_top_sale_shortcode($atts) {
            global $woocommerce;

            $atts  = vc_map_get_attributes( 'haru_products_top_sale', $atts );
            $title = $layout_type = $products_per_page = $columns = $rows = $autoplay = $slide_duration = $orderby = $order = $el_class = $css_animation = $duration = $delay = $haru_animation = $styles_animation = '';
            extract(shortcode_atts(array(
                'title'             => '',
                'layout_type'       => 'carousel_1',
                'products_per_page' => '6',
                'columns'           => 1,
                'rows'              => 1,
                'autoplay'          => 'true',
                'slide_duration'    => '6000',
                'orderby'           => 'date',
                'order'             => 'asc',
                'el_class'          => '',
                'css_animation'     => '',
                'duration'          => '',
                'delay'             => ''
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();
            
            ?>
            <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('products/top-sale.php', array('atts' => $atts), '', '' ); ?>
            </div>
            <?php
            wp_reset_postdata();
            $content =  ob_get_clean();
            
            return $content;
        }

        function haru_products_top_sale_vc_map() {
            vc_map(
                array(
                    'base'        => 'haru_products_top_sale',
                    'name'        => esc_html__( 'Haru Products Top Sale', 'haru-pangja' ),
                    'icon'        => 'fa fa-shopping-cart haru-vc-icon',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'description' => esc_html__( 'Display products top rated.', 'haru-pangja' ),
                    'params'      => array(
                        array(
                            'param_name'  => 'title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Title', 'haru-pangja' ),
                            'description' => esc_html__( 'Enter title of Product Top Rated.', 'haru-pangja' ),
                        ),
                        array(
                            'param_name'  => 'layout_type',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Layout type', 'haru-pangja' ),
                            'description' => esc_html__( 'Choose layout type of products top rated', 'haru-pangja'),
                            'admin_label' => true,
                            'std'         => 'carousel',
                            'value'       => array(
                                esc_html__( 'Carousel (1 Column - Multi Rows)', 'haru-pangja' ) => 'carousel_1',
                                esc_html__( 'Carousel (Sale with countdown)', 'haru-pangja' )   => 'carousel_2',
                                esc_html__( 'Grid', 'haru-pangja' )                             => 'grid',
                            )
                        ),
                        array(
                            'param_name'  => 'products_per_page',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Products Number', 'haru-pangja' ),
                            'description' => esc_html__( 'Select number products to display.', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => '6',
                        ),
                        array(
                            'param_name'  => 'columns',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Columns', 'haru-pangja' ),
                            'description' => esc_html__( 'Select products columns.', 'haru-pangja'),
                            'admin_label' => true,
                            'value'       => array( 1, 2, 3, 4, 5, 6 ),
                            'std'           => 1,
                            'dependency' => array(
                                'element' => 'layout_type', 
                                'value'   => array('grid')
                            )
                        ),
                        array(
                            'param_name'  => 'rows',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Rows', 'haru-pangja' ),
                            'description' => esc_html__( 'Select products rows.', 'haru-pangja'),
                            'admin_label' => true,
                            'value'       => array( 1, 2, 3, 4, 5, 6 ),
                            'std'           => 1,
                            'dependency' => array(
                                'element' => 'layout_type', 
                                'value'   => array('carousel_1')
                            )
                        ),
                        array(
                            'param_name' => 'autoplay',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'AutoPlay', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Yes', 'haru-pangja') => 'true', 
                                esc_html__( 'No', 'haru-pangja')  => 'false'
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'slide_duration',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Slide Duration (ms)', 'haru-pangja' ),
                            'description' => esc_html__( 'Auto rotate slides each X milliseconds.', 'haru-pangja' ),
                            'std'         => '6000',
                            'admin_label' => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name' => 'orderby',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Order By', 'haru-pangja' ),
                            'description'=> esc_html__( 'Select how to sort retrieved products.', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Publish Date', 'haru-pangja' )  => 'date',
                                esc_html__( 'ID', 'haru-pangja' )            => 'id',
                                esc_html__( 'Author', 'haru-pangja' )        => 'author',
                                esc_html__( 'Alphabetic', 'haru-pangja' )    => 'title',
                                esc_html__( 'Modified', 'haru-pangja' )      => 'modified',
                                esc_html__( 'Random', 'haru-pangja' )        => 'rand',
                                esc_html__( 'Comment Count', 'haru-pangja' ) => 'comment_count',
                                esc_html__( 'Menu order', 'haru-pangja' )    => 'menu_order',
                                esc_html__( 'Price', 'haru-pangja' )         => 'price' 
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

    new Haru_Framework_Shortcode_Products_Top_Sale();
}