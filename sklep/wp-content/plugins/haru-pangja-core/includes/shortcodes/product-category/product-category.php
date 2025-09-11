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

if ( ! class_exists('Haru_Framework_Shortcode_Product_Category') ) {
    class Haru_Framework_Shortcode_Product_Category {
        function __construct() {
            add_shortcode( 'haru_product_category', array($this, 'haru_product_category_shortcode') );
            add_action( 'vc_before_init', array($this, 'haru_product_category_vc_map') );
        }

        function haru_product_category_shortcode($atts) {
            $atts        = vc_map_get_attributes( 'haru_product_category', $atts );
            $layout_type = $images = $css = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'images'            => '',
                'layout_type'       => 'grid',
                'columns'           => '',
                'image'           => '',
                'css'               => '',
                'el_class'          => '',
                'css_animation'     => '',
                'duration'          => '',
                'delay'             => '',
            ), $atts)); 

            $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'haru_product_category', $atts );

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();

            ?>
            <?php if ( $images != '' ) : ?>
            <div class="<?php echo esc_attr($css_class . ' ' . $haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('product-category/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
            <?php else : ?>
                <div class="image-not-select"><?php echo esc_html__( 'Please select image for category!', 'haru-pangja' ); ?></div>
            <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;         
        }

        function haru_product_category_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Product Category', 'haru-pangja' ),
                    'base'        => 'haru_product_category',
                    'icon'        => 'fa fa-shopping-cart haru-vc-icon',
                    'description' => esc_html__( 'Display Product category with creative layout', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'param_name'  => 'images',
                            'type'        => 'param_group',
                            'heading'     => esc_html__( 'Category List', 'haru-pangja' ),
                            'description' => esc_html__( 'Select image and insert information for Category List.', 'haru-pangja' ),
                            'value'       => urlencode( json_encode( array(
                                array(
                                    'title'       => esc_html__( 'Themeforest', 'haru-pangja' ),
                                    'image'       => '',
                                    'link'        => '',
                                ),
                                array(
                                    'title'       => esc_html__( 'Codecanyon', 'haru-pangja' ),
                                    'image'       => '',
                                    'link'        => '',
                                ),
                                array(
                                    'title'       => esc_html__( 'Photodune', 'haru-pangja' ),
                                    'image'       => '',
                                    'link'        => '',
                                ),
                            ) ) ),
                            'params' => array(
                                array(
                                    'param_name'  => 'title',
                                    'type'        => 'textfield',
                                    'heading'     => esc_html__( 'Title', 'haru-pangja' ),
                                    'description' => esc_html__( 'Enter title of image.', 'haru-pangja' ),
                                    'admin_label' => true,
                                ),
                                array(
                                    'param_name'  => 'image',
                                    'type'        => 'attach_image',
                                    'heading'     => esc_html__( 'Image', 'haru-pangja' ),
                                    'description' => esc_html__( 'Please select image.', 'haru-pangja' ),
                                    'admin_label' => true,
                                ),
                                array(
                                    'param_name'  => 'link',
                                    'type'        => 'vc_link',
                                    'heading'     => esc_html__( 'Link', 'haru-pangja' ),
                                    'description' => esc_html__( 'Set link of image.', 'haru-pangja' ),
                                    'admin_label' => false,
                                ),
                            ),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Layout Style', 'haru-pangja' ),
                            'param_name' => 'layout_type',
                            'value'      => array(
                                esc_html__( 'Grid Home 2', 'haru-pangja' )   => 'grid',
                                esc_html__( 'List Home 3', 'haru-pangja' )   => 'list',
                            ),
                            'admin_label' => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array( 
                            'param_name'       => 'columns', 
                            'heading'          => esc_html__( 'Columns', 'haru-pangja' ),
                            'type'             => 'dropdown',
                            'value'            => array( 2, 3, 4, 5, 6 ),
                            'admin_label'      => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            'dependency'  => array(
                                'element' => 'layout_type',
                                'value'   => array('grid'),
                            )
                        ),
                        array(
                            'param_name'  => 'image',
                            'type'        => 'attach_image',
                            'heading'     => esc_html__( 'Background Image', 'haru-pangja' ),
                            'description' => esc_html__( 'Please select image.', 'haru-pangja' ),
                            'admin_label' => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                            'dependency'  => array(
                                'element' => 'layout_type',
                                'value'   => array('list'),
                            )
                        ),
                        array(
                            'type'       => 'css_editor',
                            'heading'    => esc_html__( 'CSS box', 'haru-pangja' ),
                            'param_name' => 'css',
                            'group'      => esc_html__( 'Design Options', 'haru-pangja' ),
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

    new Haru_Framework_Shortcode_Product_Category();
}