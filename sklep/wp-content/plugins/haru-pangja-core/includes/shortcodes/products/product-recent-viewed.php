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

if ( ! class_exists('Haru_Framework_Shortcode_Products_Recent_Viewed') ) {
    class Haru_Framework_Shortcode_Products_Recent_Viewed {
        function __construct() {
            add_shortcode( 'haru_products_recent_viewed', array($this, 'haru_products_recent_viewed_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_products_recent_viewed_vc_map') );
        }

        function haru_products_recent_viewed_shortcode($atts) {
            global $woocommerce;

            $atts  = vc_map_get_attributes( 'haru_products_recent_viewed', $atts );
            $layout_type = $products_per_slide = $autoplay = $slide_duration = $per_page = $el_class = $css_animation = $duration = $delay = $haru_animation = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type'        => 'carousel',
                'products_per_slide' => '2',
                'autoplay'           => 'true',
                'slide_duration'     => '6000',
                'per_page'           => '-1',
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
                <?php echo haru_get_template('products/recent-viewed.php', array('atts' => $atts), '', '' ); ?>
            </div>

            <?php
            wp_reset_postdata();
            $content =  ob_get_clean();
            
            return $content;
        }

        function haru_products_recent_viewed_vc_map() {
            vc_map(
                array(
                    'base'        => 'haru_products_recent_viewed',
                    'name'        => esc_html__( 'Haru Products Recent Viewed', 'haru-pangja' ),
                    'icon'        => 'fa fa-shopping-cart haru-vc-icon',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'description' => esc_html__( 'Display products recent viewed.', 'haru-pangja' ),
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
                            'param_name'  => 'per_page',
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Product count', 'haru-pangja' ),
                            'description' => esc_html__( 'Enter number of products to display (Note: Enter "-1" to display all products).', 'haru-pangja' ),
                            'admin_label' => true,
                            'value'       => 12,
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
                        Haru_PangjaCore_Shortcodes::add_css_animation(),
                        Haru_PangjaCore_Shortcodes::add_duration_animation(),
                        Haru_PangjaCore_Shortcodes::add_delay_animation(),
                        Haru_PangjaCore_Shortcodes::add_el_class()
                    )
                )
            );
        }
    }

    new Haru_Framework_Shortcode_Products_Recent_Viewed();
}