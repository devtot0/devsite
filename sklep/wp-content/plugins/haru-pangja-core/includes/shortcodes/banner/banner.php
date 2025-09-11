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

if ( ! class_exists('Haru_Framework_Shortcode_Banner') ) {
    class Haru_Framework_Shortcode_Banner {
        function __construct() {
            add_shortcode( 'haru_banner', array($this, 'haru_banner_shortcode') );
            add_action( 'vc_before_init', array($this, 'haru_banner_vc_map') );
        }

        function haru_banner_shortcode($atts) {
            $atts        = vc_map_get_attributes( 'haru_banner', $atts );
            $layout_type = $title = $description = $link = $image = $svg_class = $text_align = $css = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type'       => 'style_1',
                'title'             => '',
                'sub_title'         => '',
                'description'       => '',
                'link'              => '',
                'image'             => '',
                'svg_class'        => '',
                'text_align'        => 'left',
                'css'               => '',
                'el_class'          => '',
                'css_animation'     => '',
                'duration'          => '',
                'delay'             => '',
            ), $atts)); 

            $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'haru_banner', $atts );

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();

            ?>
            <?php if ( ($image != '') ) : ?>
            <div class="<?php echo esc_attr($css_class . ' ' . $haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('banner/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
            <?php else : ?>
                <div class="banner-not-select"><?php echo esc_html__( 'Please select image for banner!', 'haru-pangja' ); ?></div>
            <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;         
        }

        function haru_banner_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__( 'Haru Banner', 'haru-pangja' ),
                    'base'        => 'haru_banner',
                    'icon'        => 'fa fa-windows haru-vc-icon',
                    'description' => esc_html__( 'Display banner', 'haru-pangja' ),
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'params'      => array(
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Layout Style', 'haru-pangja' ),
                            'param_name' => 'layout_type',
                            'value'      => array(
                                esc_html__( 'Style 1 (Image Scale)', 'haru-pangja' )            => 'style_1',
                                esc_html__( 'Style 2 (Services 1)', 'haru-pangja' )              => 'style_2',
                            ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Title', 'haru-pangja' ),
                            'param_name'  => 'title',
                            'admin_label' => true,
                        ),
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'Sub Title', 'haru-pangja' ),
                            'param_name'  => 'sub_title',
                            'admin_label' => true,
                            'dependency'  => array(
                                'element' => 'layout_type',
                                'value'   => array('style_2'),
                            ),
                        ),
                        array(
                            'type'        => 'textarea',
                            'heading'     => esc_html__( 'Description', 'haru-pangja' ),
                            'param_name'  => 'description',
                            'admin_label' => false,
                            'dependency'  => array(
                                'element' => 'layout_type',
                                'value'   => array('style_1', 'style_2'),
                            ),
                        ),
                        array(
                            'type'             => 'vc_link',
                            'heading'          => esc_html__( 'Link', 'haru-pangja' ),
                            'param_name'       => 'link',
                            'admin_label'      => true,
                            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
                        ),
                        array(
                            'type'        => 'attach_image',
                            'heading'     => esc_html__( 'Banner\'s Image', 'haru-pangja' ),
                            'param_name'  => 'image',
                            'admin_label' => true,
                            'dependency'  => array(
                                'element' => 'layout_type',
                                'value'   => array('style_1', 'style_2',),
                            ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__( 'SVG Class', 'haru-pangja' ),
                            'param_name'  => 'svg_class',
                            'admin_label' => true,
                            'dependency' => array(
                                'element' => 'layout_type',
                                'value'   => array('style_2')
                            ),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Banner Position', 'haru-pangja' ),
                            'param_name' => 'banner_position',
                            'value'      => array(
                                esc_html__( 'Left', 'haru-pangja' )   => 'left',
                                esc_html__( 'Right', 'haru-pangja' )  => 'right',
                            ),
                            'dependency'       => array(
                                'element' => 'layout_type',
                                'value'   => array('style_2'),
                            ),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'heading'    => esc_html__( 'Text Align', 'haru-pangja' ),
                            'param_name' => 'text_align',
                            'value'      => array(
                                esc_html__( 'Left', 'haru-pangja' )   => 'left',
                                esc_html__( 'Center', 'haru-pangja' ) => 'center',
                                esc_html__( 'Right', 'haru-pangja' )  => 'right',
                            ),
                            'dependency'       => array(
                                'element' => 'layout_type',
                                'value'   => array('style_1'),
                            ),
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

    new Haru_Framework_Shortcode_Banner();
}