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

if ( ! class_exists('Haru_Framework_Shortcode_SingleProduct') ) {
    class Haru_Framework_Shortcode_SingleProduct {
        function __construct() {
            add_shortcode( 'haru_single_product', array( $this, 'haru_single_product_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_single_product_vc_map') );
        }

        function haru_single_product_shortcode($atts) {
            $atts  = vc_map_get_attributes( 'haru_single_product', $atts );
            $product_style = $product_image = $bg_img = $id = $product_brand = $product_brand_logo = $el_class = $haru_animation = $css_animation = $duration = $delay =  '';
            extract(shortcode_atts(array(
                'product_style'      => '',
                'id'                 => '',
                'product_image'      => '',
                'product_brand_logo' => '',
                'el_class'           => '',
                'css_animation'      => '',
                'duration'           => '',
                'delay'              => '',
            ), $atts));
	           
            $haru_animation   .= ' ' . esc_attr($el_class);
            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();
            $product = new WP_Query( 
                array( 
                    'p'         => $id,
                    'post_type' => 'product'
                ) 
            );

            ?>
            <?php if( $product->have_posts() ) : ?>
                <div class="<?php echo esc_attr($haru_animation . ' ' . $styles_animation); ?>">
                    <?php echo haru_get_template('single-product/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
                </div>
            <?php else : ?>
                <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
            <?php endif; ?>
        <?php
            wp_reset_postdata();
            $content =  ob_get_clean();
            return $content;         
        }

        function haru_single_product_vc_map() {
            vc_map(
                array(
                    'name'        =>  esc_html__( 'Haru Single Product', 'haru-pangja' ),
                    'base'        =>  'haru_single_product',
                    'category'    =>  HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'icon'        =>  'fa fa-shopping-cart haru-vc-icon',
                    'description' =>  esc_html__( 'Display single WooCommerce product', 'haru-pangja' ),
                    'params'      =>  array(
                        array(
                            'param_name' => 'product_style',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Layout Style', 'haru-pangja' ),
                            'description'=> esc_html__('Choose layout style from drop down list styles.', 'haru-pangja'),
                            'value'      => array(
                                esc_html__( 'Style 1', 'haru-pangja' ) => 'style_1',
                                esc_html__( 'Style 2', 'haru-pangja' ) => 'style_2',
                            ),
                        ),
                        array(
                            // "type"          => "autocomplete",
                            'param_name'  => 'id',
                            'type'        => 'single-select',
                            'holder'      => 'div',
                            'class'       => 'hide_in_vc_editor',
                            'admin_label' => true,
                            'heading'     => esc_html__( 'Select product', 'haru-pangja' ),
                            'description' => esc_html__( 'Choose single product by search product name.', 'haru-pangja'),
                        ),
                        array(
                            'param_name'    => 'product_image',
                            'type'          => 'attach_image',
                            'holder'        => 'div',
                            'heading'       => esc_html__( 'Choose Cover Image', 'haru-pangja' ),
                            'description'   => esc_html__( 'Choose another image to replace original product image.', 'haru-pangja'),
                            'dependency' => array(
                                'element' => 'product_style',
                                'value'   => array('style_2')
                            ),
                        ),
                        array(
                            'param_name'    => 'product_brand_logo',
                            'type'          => 'attach_image',
                            'heading'       => esc_html__( 'Choose branding logo', 'haru-pangja' ),
                            'description'   => esc_html__( 'Choose branding logo to display above product.', 'haru-pangja'),
                            'admin_label'   => true,
                            'dependency' => array(
                                'element' => 'product_style',
                                'value'   => array('style_2')
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

    new Haru_Framework_Shortcode_SingleProduct();
}
?>