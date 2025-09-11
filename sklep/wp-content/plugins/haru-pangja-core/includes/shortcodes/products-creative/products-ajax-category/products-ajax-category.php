<?php
/**
 * @package    HaruTheme/Haru Pangja
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

if ( ! defined( 'ABSPATH' ) ) die( '-1' );

if ( ! class_exists('Haru_Products_Ajax_Category') ) {
    class Haru_Products_Ajax_Category {
        function __construct() {
            add_shortcode('haru_products_ajax_category', array($this, 'haru_products_ajax_category_shortcode' ));
            add_action( 'vc_before_init', array($this, 'haru_products_ajax_category_vc_map') );

            $this->includes();
        }

        private function includes() {
            include_once( 'utils/ajax-action.php' );
        }

        function haru_products_ajax_category_shortcode($atts) {
            $atts  = vc_map_get_attributes( 'haru_products_ajax_category', $atts );
            $product_cats = $layout_type = $product_style = $product_type = $filter_position = $per_page = $columns = $show_general_tab = $show_nav = $auto_play = $slide_duration = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'product_cats'     => '',
                'layout_type'      => 'grid',
                'product_style'    => 'default',
                'product_type'     => 'recent',
                'filter_position'  => 'filter_left',
                'per_page'         => 6,
                'columns'          => 2,
                'show_general_tab' => 'show_general_tab',
                'show_nav'         => 1,
                'auto_play'        => 1,
                'slide_duration'   => '6000',
                'el_class'         => '',
                'css_animation'    => '',
                'duration'         => '',
                'delay'            => '',
            ), $atts));

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            if ( !class_exists('WooCommerce') ) {
                return;
            }

            ob_start();

        ?>  
        <div class="<?php echo esc_attr( $haru_animation . ' ' . $styles_animation ); ?>">
            <?php echo haru_get_template('products-creative/ajax-category/' . $layout_type .'.php', array('atts' => $atts), '', '' ); ?>
        </div>
        <?php
            wp_reset_postdata();
            $content =  ob_get_clean();

            return $content;
        }

        function haru_products_ajax_category_vc_map() {
            vc_map( 
                array(
                    'base'        => 'haru_products_ajax_category',
                    'name'        => esc_html__( 'Haru Products Ajax Category', 'haru-pangja' ),
                    'class'       => '',
                    'icon'        => 'fa fa-shopping-cart haru-vc-icon',
                    'description' => esc_html__( 'Display products in category via ajax load', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'param_name'  => 'product_cats',
                            'type'        => 'haru_product_categories',
                            'heading'     => esc_html__( 'Product Categories', 'haru-pangja' ),
                            'admin_label' => true,
                        ),
                        array(
                            'param_name'  => 'layout_type',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Layout type', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                'Grid'   => 'grid',
                                'Slider' => 'slider'
                            ),
                            'description'  => '',
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'product_style',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Product Style', 'haru-pangja' ),
                            'description' => '',
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'Default', 'haru-pangja' )    => 'default',
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'filter_position',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Filter Align', 'haru-pangja' ),
                            'description' => esc_html__( 'Select Filter Align.', 'haru-pangja'),
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'Left', 'haru-pangja' )  => 'filter_left',
                                esc_html__( 'Right', 'haru-pangja' ) => 'filter_right',
                                esc_html__( 'Center', 'haru-pangja' )   => 'filter_center'
                            )
                        ),
                        array(
                            'param_name'  => 'product_type',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Product order type', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                'Recent'       => 'recent',
                                'Sale'         => 'sale',
                                'Featured'     => 'featured',
                                'Best Selling' => 'best_selling',
                                'Top Rated'    => 'top_rated',
                                'Mixed Order'  => 'mixed_order'
                            ),
                            'description'  => esc_html__( 'Select type of product order', 'haru-pangja' )
                        ),
                        array(
                            'param_name'  => 'per_page',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Number of Products', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => 6,
                            'description' => esc_html__( 'Number of Products per category', 'haru-pangja' )
                        ),
                        array(
                            'param_name'  => 'columns',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Columns', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                '2 Columns' => 2,
                                '3 Columns' => 3,
                                '4 Columns' => 4,
                                '5 Columns' => 5,
                                '6 Columns' => 6,
                            ),
                            'description' => esc_html__( 'Number of Columns', 'haru-pangja' )
                        ),

                        array(
                            'param_name'  => 'show_general_tab',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Show All tab', 'haru-pangja' ),
                            'admin_label' => false,
                            'value'       => array(
                                'No'  => 0,
                                'Yes' => 1
                            ),
                            'description'  => esc_html__( 'Get products from all categories', 'haru-pangja' )
                        ),
                        array(
                            'param_name'  => 'show_nav',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Show navigation button', 'haru-pangja' ),
                            'admin_label' => false,
                            'value'       => array(
                                'No'  => 0,
                                'Yes' => 1
                            ),
                            'description'  => '',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('slider')
                            ),
                        ),
                        array(
                            'param_name'  => 'auto_play',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Auto play', 'haru-pangja' ),
                            'admin_label' => false,
                            'value'       => array(
                                'Yes' => 1,
                                'No'  => 0
                            ),
                            'description'  => '',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('slider')
                            ),
                        ),
                        array(
                            'param_name'  => 'slide_duration',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Slide Duration(ms)', 'haru-pangja' ),
                            'admin_label' => false,
                            'value'       => '6000',
                            'description' => '',
                            'dependency'  => array(
                                'element' => 'layout_type', 
                                'value'   => array('slider')
                            ),
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

    new Haru_Products_Ajax_Category();
}