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

if ( ! class_exists('Haru_Framework_Shortcode_Banner_Creative') ) {
    class Haru_Framework_Shortcode_Banner_Creative {
        function __construct() {
            add_shortcode( 'haru_banner_creative', array($this, 'haru_banner_creative_shortcode') );
            add_action( 'vc_before_init', array($this, 'haru_banner_creative_vc_map') );
        }

        function haru_banner_creative_shortcode($atts) {
            $atts        = vc_map_get_attributes( 'haru_banner_creative', $atts );
            $layout_type = $images = $css = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'images'            => '',
                'layout_type'       => 'packery',
                'columns'           => '',
                'css'               => '',
                'el_class'          => '',
                'css_animation'     => '',
                'duration'          => '',
                'delay'             => '',
            ), $atts)); 

            $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'haru_banner_creative', $atts );

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();

            ?>
            <?php if ( $images != '' ) : ?>
            <div class="<?php echo esc_attr($css_class . ' ' . $haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('banner-creative/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
            <?php else : ?>
                <div class="banner-not-select"><?php echo esc_html__( 'Please select image for banner!', 'haru-pangja' ); ?></div>
            <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;         
        }

        function haru_banner_creative_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Banner Creative', 'haru-pangja' ),
                    'base'        => 'haru_banner_creative',
                    'icon'        => 'fa fa-windows haru-vc-icon',
                    'description' => esc_html__( 'Display banner with creative layout', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'param_name'  => 'images',
                            'type'        => 'param_group',
                            'heading'     => esc_html__( 'Images List', 'haru-pangja' ),
                            'description' => esc_html__( 'Select image and insert information for Images List.', 'haru-pangja' ),
                            'value'       => urlencode( json_encode( array(
                                array(
                                    'title'       => esc_html__( 'Themeforest', 'haru-pangja' ),
                                    'description' => '',
                                    'image'       => '',
                                    'size'        => '',
                                    'link'        => '',
                                ),
                                array(
                                    'title'       => esc_html__( 'Codecanyon', 'haru-pangja' ),
                                    'description' => '',
                                    'image'       => '',
                                    'size'        => '',
                                    'link'        => '',
                                ),
                                array(
                                    'title'       => esc_html__( 'Photodune', 'haru-pangja' ),
                                    'description' => '',
                                    'image'       => '',
                                    'size'        => '',
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
                                    'param_name'  => 'sub_title',
                                    'type'        => 'textfield',
                                    'heading'     => esc_html__( 'Sub Title', 'haru-pangja' ),
                                    'description' => esc_html__( 'Enter sub title of image.', 'haru-pangja' ),
                                    'admin_label' => true,
                                    'dependency'  => array(
                                        'element' => 'hover_style',
                                        'value'   => array('style_4'),
                                    )
                                ),
                                array(
                                    'param_name'  => 'description',
                                    'type'        => 'textarea',
                                    'heading'     => esc_html__( 'Description', 'haru-pangja' ),
                                    'description' => esc_html__( 'Enter description of image.', 'haru-pangja' ),
                                    'admin_label' => false,
                                ),
                                array(
                                    'param_name'  => 'sub_description',
                                    'type'        => 'textarea',
                                    'heading'     => esc_html__( 'Sub Description', 'haru-pangja' ),
                                    'description' => esc_html__( 'Enter sub description of image.', 'haru-pangja' ),
                                    'admin_label' => false,
                                    'dependency'  => array(
                                        'element' => 'hover_style',
                                        'value'   => array('style_4'),
                                    )
                                ),
                                array(
                                    'param_name'  => 'button_text',
                                    'type'        => 'textarea',
                                    'heading'     => esc_html__( 'Button Text', 'haru-pangja' ),
                                    'description' => esc_html__( 'Enter button text of image.', 'haru-pangja' ),
                                    'admin_label' => false,
                                    'dependency'  => array(
                                        'element' => 'hover_style',
                                        'value'   => array('style_4'),
                                    )
                                ),
                                array(
                                    'param_name'  => 'image',
                                    'type'        => 'attach_image',
                                    'heading'     => esc_html__( 'Image', 'haru-pangja' ),
                                    'description' => esc_html__( 'Please select image.', 'haru-pangja' ),
                                    'admin_label' => true,
                                ),
                                array(
                                    'param_name' => 'size',
                                    'type'       => 'dropdown',
                                    'heading'    => esc_html__( 'Image Size', 'haru-pangja' ),
                                    'description'=> esc_html__( 'Choose Image size from drop down list styles. Only use with Packery layout', 'haru-pangja'),
                                    'value'      => array(
                                        esc_html__( 'Default', 'haru-pangja' )             => 'default',
                                        esc_html__( 'Small Squared (1x1)', 'haru-pangja' ) => 'small_squared',
                                        esc_html__( 'Big Squared (2x2)', 'haru-pangja' )   => 'big_squared',
                                        esc_html__( 'Landscape (2x1)', 'haru-pangja' )     => 'landscape',
                                        esc_html__( 'Portrait (1x2)', 'haru-pangja' )      => 'portrait',
                                        esc_html__( 'Special (3x2)', 'haru-pangja' )      => 'special',
                                    ),
                                ),
                                array(
                                    'param_name' => 'hover_style',
                                    'type'       => 'dropdown',
                                    'heading'    => esc_html__( 'Hover Style', 'haru-pangja' ),
                                    'description'=> esc_html__( 'Choose Hover style from drop down list styles.', 'haru-pangja'),
                                    'value'      => array(
                                        esc_html__( 'Default', 'haru-pangja' ) => 'style_1',
                                        esc_html__( 'Style 2', 'haru-pangja' ) => 'style_2',    
                                        esc_html__( 'Style 3', 'haru-pangja' ) => 'style_3',                         
                                    ),
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
                                esc_html__( 'Packery (Has Padding)', 'haru-pangja' )   => 'packery',
                                esc_html__( 'Packery (No Padding)', 'haru-pangja' )   => 'packery_2',
                                esc_html__( 'Masonry (Home 3)', 'haru-pangja' )   => 'masonry',
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

    new Haru_Framework_Shortcode_Banner_Creative();
}