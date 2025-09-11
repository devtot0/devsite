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

if ( ! class_exists('Haru_Framework_Shortcode_Products_Slider') ) {
    class Haru_Framework_Shortcode_Products_Slider {
        function __construct() {
            add_shortcode( 'haru_products_slider', array($this, 'haru_products_slider_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_products_slider_vc_map') );
        }

        function haru_products_slider_shortcode($atts) {
            global $woocommerce;

            $atts  = vc_map_get_attributes( 'haru_products_slider', $atts );
            $layout_type = $data_source = $category = $product_ids = $products_per_slide = $autoplay = $slide_duration = $per_page = $orderby = $order = $el_class = $css_animation = $duration = $delay = $haru_animation = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type'        => 'carousel',
                'data_source'        => '',
                'category'           => '',
                'product_ids'        => '',
                'products_per_slide' => '2',
                'autoplay'           => 'true',
                'slide_duration'     => '6000',
                'per_page'           => '-1',
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
                <?php echo haru_get_template('products/slider.php', array('atts' => $atts), '', '' ); ?>
            </div>

            <?php
            wp_reset_postdata();
            $content =  ob_get_clean();
            
            return $content;
        }

        function haru_products_slider_vc_map() {
            vc_map(
                array(
                    'base'        => 'haru_products_slider',
                    'name'        => esc_html__( 'Haru Products Slider', 'haru-pangja' ),
                    'icon'        => 'fa fa-shopping-cart haru-vc-icon',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'description' => esc_html__( 'Display products with slider layout.', 'haru-pangja' ),
                    'params'      => array(
                        array(
                            'param_name'  => 'layout_type',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Layout type', 'haru-pangja' ),
                            'description' => esc_html__( 'Choose layout type of products slider', 'haru-pangja'),
                            'admin_label' => true,
                            'std'         => 'carousel',
                            'value'       => array(
                                esc_html__( 'Carousel', 'haru-pangja' )    => 'carousel',
                            )
                        ),
                        array(
                            'param_name'  => 'data_source',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Data Sources', 'haru-pangja' ),
                            'description' => esc_html__( 'Choose the source which products will be displayed on products page.', 'haru-pangja'),
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
                            'param_name'  => 'products_per_slide',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Products per slide', 'haru-pangja' ),
                            'description' => esc_html__('Select number products to display each slide.', 'haru-pangja'),
                            'admin_label' => true,
                            'value'       => array( 1, 2, 3, 4, 5, 6 ),
                            'group'       => esc_html__( 'Slide Settings', 'haru-pangja' )
                        ),
                        array(
                            'param_name' => 'autoplay',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'AutoPlay', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Yes', 'haru-pangja') => 'true', 
                                esc_html__( 'No', 'haru-pangja')  => 'false'
                            ),
                            'group'       => esc_html__( 'Slide Settings', 'haru-pangja' )
                        ),
                        array(
                            'param_name'  => 'slide_duration',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Slide Duration (ms)', 'haru-pangja' ),
                            'description' => esc_html__( 'Auto rotate slides each X milliseconds.', 'haru-pangja' ),
                            'std'         => '6000',
                            'admin_label' => true,
                            'group'       => esc_html__( 'Slide Settings', 'haru-pangja' )
                        ),

                        array(
                            'param_name'  => 'per_page',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Product count', 'haru-pangja' ),
                            'description' => esc_html__( 'Enter number of products to display (Note: Enter "-1" to display all products).', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => 12,
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
                            'description'=> esc_html__('Select sorting order.', 'haru-pangja'),
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

    new Haru_Framework_Shortcode_Products_Slider();
}