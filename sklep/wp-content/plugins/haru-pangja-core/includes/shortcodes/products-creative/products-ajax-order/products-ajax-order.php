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

if ( ! class_exists('Haru_Products_Ajax_Order') ) {
    class Haru_Products_Ajax_Order {
        function __construct() {
            add_shortcode('haru_products_ajax_order', array($this, 'haru_products_ajax_order_shortcode' ));
            add_action( 'vc_before_init', array($this, 'haru_products_ajax_order_vc_map') );

            $this->includes();
        }

        private function includes() {
            include_once( 'utils/ajax-action.php' );
        }

        function haru_products_ajax_order_shortcode($atts) {
            $atts  = vc_map_get_attributes( 'haru_products_ajax_order', $atts );
            $product_tabs = $recent_title = $best_selling_title = $featured_title = $sale_title = $top_rated_title = $mixed_order_title = $product_cats = $layout_type = $columns = $product_style = $tab_align = $per_page = $rows = $auto_play = $slide_duration = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'product_tabs'     => '',
                'recent_title'     => '',
                'best_selling_title'     => '',
                'featured_title'     => '',
                'sale_title'     => '',
                'top_rated_title'     => '',
                'mixed_order_title'     => '',
                'product_cats'     => '',
                'layout_type'      => 'grid',
                'columns'          => 2,
                'product_style'    => 'default',
                'tab_align'  => 'align_left',
                'per_page'         => 6,
                'rows'        => 1,
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
            <?php echo haru_get_template('products-creative/ajax-order/' . $layout_type .'.php', array('atts' => $atts), '', '' ); ?>
        </div>
        <?php
            wp_reset_postdata();
            $content =  ob_get_clean();

            return $content;
        }

        function haru_products_ajax_order_vc_map() {
            vc_map( 
                array(
                    'base'        => 'haru_products_ajax_order',
                    'name'        => esc_html__( 'Haru Products Ajax Order', 'haru-pangja' ),
                    'class'       => '',
                    'icon'        => 'fa fa-shopping-cart haru-vc-icon',
                    'description' => esc_html__( 'Display products by order via ajax load', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'param_name'  => 'product_tabs',
                            'type'        => 'checkbox',
                            'multiple'        => true,
                            'heading'     => esc_html__( 'Product order tabs', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                'Recent'       => 'recent',
                                'Best Selling' => 'best_selling',
                                'Featured'     => 'featured',
                                'Sale'         => 'sale',
                                'Top Rated'    => 'top_rated',
                                'Random'       => 'mixed_order'
                            ),
                            'description'  => esc_html__( 'Select product order tabs to display', 'haru-pangja' )
                        ),
                        array(
                            'param_name'  => 'recent_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Recent Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'product_tabs', 
                                'value'   => array('recent')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'best_selling_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Best Selling Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'product_tabs', 
                                'value'   => array('best_selling')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'featured_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Featured Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'product_tabs', 
                                'value'   => array('featured')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'sale_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Sale Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'product_tabs', 
                                'value'   => array('sale')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'top_rated_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Top Rated Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'product_tabs', 
                                'value'   => array('top_rated')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'mixed_order_title',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Random Tab title', 'haru-pangja' ),
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'product_tabs', 
                                'value'   => array('mixed_order')
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
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
                        // Tab
                        array(
                            'param_name'  => 'tab_align',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Tab Align', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                esc_html__( 'Left', 'haru-pangja' )  => 'align_left',
                                esc_html__( 'Right', 'haru-pangja' ) => 'align_right',
                                esc_html__( 'Center', 'haru-pangja' )   => 'align_center'
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'  => 'per_page',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Number of Products', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => 6,
                            'description' => esc_html__( 'Number of Products to show', 'haru-pangja' )
                        ),
                        array(
                            'param_name'  => 'rows',
                            'type'        => 'dropdown',
                            'heading'     => esc_html__( 'Rows', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => array(
                                '1 Rows' => 1,
                                '2 Rows' => 2,
                                '3 Rows' => 3
                            ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
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
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
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
                            )
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

    new Haru_Products_Ajax_Order();
}