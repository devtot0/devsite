<?php
/**
 *  
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/
if ( ! defined( 'ABSPATH' ) ) die( '-1' );

if ( ! class_exists('Haru_Framework_Shortcode_Products_Creative_Masonry') ) {
    class Haru_Framework_Shortcode_Products_Creative_Masonry {

        public function __construct() {
            add_shortcode( 'haru_products_creative_masonry', array($this, 'haru_products_creative_masonry_shortcode' ));
            add_action( 'vc_before_init', array($this, 'haru_products_creative_masonry_vc_map') );
        }

        function haru_products_creative_masonry_shortcode($atts) {
            $atts  = vc_map_get_attributes( 'haru_products_creative_masonry', $atts );

            extract(shortcode_atts(array(
                'product_slugs'      => '',
                'product_img_width'  => '300',
                'product_img_height' => '300',
                'columns'            => '4',
                'product_width'      => '',
                'product_style'      => 'style_1',
                'action_tooltip'     => '',
                'action_disable'     => '',
                'css_animation'      => '',
                'duration'           => '',
                'delay'              => '',
                'el_class'           => '',
            ), $atts));

            $class                  = array('shortcode-product-wrap');
            $class[]                = 'creative clearfix';
            $class[]                = $el_class;
            $class[]                = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $class_name             = join(' ',$class);
            
            $product_wrap_class     = array('product-wrap', 'clearfix');
            $product_class          = array('product-inner','clearfix');
            $list_ids = array();
            if ( $product_slugs ) {
                $list_slug = explode( ',', $product_slugs );
                foreach ( $list_slug as $key => $val ) {
                    $id_tmp     = get_posts( array( 'name' => $val, 'post_type' => 'product' ) );
                    $list_ids[] = $id_tmp[0]->ID;
                }
            }
            // Get products
            $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'orderby'               => 'post__in',
                'post__in'              => $list_ids,
            );

            ob_start();

            $products = new WP_Query($args);
            $plugin_path = untrailingslashit(plugin_dir_path(__FILE__));
            $template_path = $plugin_path . '/templates/layout/default.php';

            switch ($product_style) {
                case 'style_1':
                    $product_path = $plugin_path . '/templates/product-style/creative_style_1.php';
                    break;
                case 'style_2':
                    $product_path = $plugin_path . '/templates/product-style/creative_style_2.php';
                    break;

                default:
                    $product_path = $plugin_path . '/templates/product-style/creative_style_1.php';
            }

            ?>

            <?php if ($products->have_posts()) : ?>
                <div class="<?php echo esc_attr($class_name) ?>" <?php echo HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration,$delay); ?>>
                    <?php include($template_path); ?>
                </div>
            <?php else : ?>
                <div class="item-not-found"><?php echo esc_html__( 'No item found', 'haru-pangja' ) ?></div>
            <?php endif; ?>

            <?php
            wp_reset_postdata();
            
            $content =  ob_get_clean();
            
            return $content;
        }

        function haru_products_creative_masonry_vc_map() {
            vc_map(
                array(
                    'base'        => 'haru_products_creative_masonry',
                    'name'        => esc_html__( 'Haru Products Creative', 'haru-pangja' ),
                    'icon'        => 'fa fa-shopping-cart haru-vc-icon',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'description' => esc_html__( 'Display products with creative layout', 'haru-pangja' ),
                    'params'      => array(
                        array(
                            'param_name' => 'product_style',
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Hover Product Style', 'haru-pangja' ),
                            'description'=> esc_html__( 'Choose hover product style effect.', 'haru-pangja' ),
                            'value'      => array(
                                esc_html__( 'Style 1', 'haru-pangja' ) => 'style_1',
                                esc_html__( 'Style 2', 'haru-pangja' ) => 'style_2',
                            ),
                            'std'        => 'style_1',
                            
                        ),
                        array(
                            'param_name' => 'product_slugs',
                            'type'       => 'haru_product_list',
                            'heading'    => esc_html__( 'Products', 'haru-pangja' ),
                            'description'=> esc_html__( 'Choose products to display on products creative.', 'haru-pangja' ),
                        ),
                        array(
                            'param_name'       => 'product_img_width',
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Width(px)', 'haru-pangja' ),
                            'description'      => esc_html__( 'Width of product image (px)', 'haru-pangja' ), 
                            'value'            => '300',
                            'description'      => esc_html__( 'Width of image(px)', 'haru-pangja' ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'param_name'       => 'product_img_height',
                            'type'             => 'textfield',
                            'heading'          => esc_html__( 'Height(px)', 'haru-pangja' ),
                            'description'      => esc_html__( 'Height of product image (px)', 'haru-pangja' ),
                            'value'            => '300',
                            'description'      => esc_html__( 'Height of image(px)', 'haru-pangja' ),
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Columns', 'haru-pangja' ),
                            'description'=> '',
                            'param_name' => 'columns',
                            'value'      => array(
                                esc_html__( '2', 'haru-pangja' ) => '2',
                                esc_html__( '3', 'haru-pangja' ) => '3',
                                esc_html__( '4', 'haru-pangja' ) => '4',
                                esc_html__( '5', 'haru-pangja' ) => '5',
                                esc_html__( '6', 'haru-pangja' ) => '6',
                            ),
                            'std'              => '4',
                        ),
                        array(
                            'type'       => 'textfield',
                            'heading'    => esc_html__( 'Product width ratio', 'haru-pangja' ),
                            'param_name' => 'product_width',
                            'description'=> esc_html__( 'Example: 5:1x1, 10:2x2, 15:2x1, 20:1x2...: 20 is ID, 1 is width ratio, 2 is height ratio', 'haru-pangja' )
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

    $products_creative = new Haru_Framework_Shortcode_Products_Creative_Masonry();
}