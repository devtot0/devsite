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

if ( ! class_exists('Haru_Framework_Shortcode_Video') ) {
    class Haru_Framework_Shortcode_Video {
        function __construct() {
            add_shortcode( 'haru_video', array( $this, 'haru_video_shortcode' ) );
            add_action( 'vc_before_init', array($this, 'haru_video_vc_map') );
        }

        function haru_video_shortcode( $atts ) {
            $atts        = vc_map_get_attributes( 'haru_video', $atts );
            $layout_type = $video_url = $title = $video_image = $css = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'layout_type'   => 'style_1',
                'video_url'     => '',
                'title'         => '',
                'video_image'   => '',
                'css'           => '',
                'el_class'      => '',
                'css_animation' => '',
                'duration'      => '',
                'delay'         => '',
            ), $atts));

            $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'haru_video', $atts );

            $haru_animation   = HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation = HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();
            
        ?>
        <?php if ( $video_url != '' ) : ?>
            <div class="<?php echo esc_attr($css_class . ' ' . $haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('video/'. $layout_type . '.php', array('atts' => $atts), '', '' ); ?>
            </div>
        <?php else : ?>
            <div class="item-not-found"><?php echo esc_html__( 'Please insert video Url!', 'haru-pangja' ) ?></div>
        <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;
        }

        function haru_video_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__('Haru Video', 'haru-pangja'),
                    'base'        => 'haru_video',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'icon'        => 'fa fa-play-circle haru-vc-icon',
                    'description' => esc_html__( 'Display Video', 'haru-pangja' ),
                    'params'      =>  array(
                        array(
                            'param_name'  => 'layout_type',
                            'heading'     => esc_html__( 'Style', 'haru-pangja' ),
                            'description' => 'Select style for display video.',
                            'type'        => 'dropdown',
                            'value'       => array(
                                esc_html__( 'Style 1 (Popup)', 'haru-pangja' ) =>  'style_1',
                                esc_html__( 'Style 2 (Popup 2)', 'haru-pangja' ) =>  'style_2',
                            ),
                            'admin_label' => true,
                        ),
                        array(
                            'param_name'  =>  'video_url',
                            'type'        =>  'textfield',
                            'heading'     =>  esc_html__( 'Url', 'haru-pangja' ),
                            'description' =>  'Enter url for video from youtube or vimeo. Example: https://www.youtube.com/watch?v=YE7VzlLtp-4',
                            'value'       =>  '',
                            'admin_label' => true,
                        ),
                        array(
                            'param_name'  =>  'title',
                            'type'        =>  'textfield',
                            'heading'     =>  esc_html__( 'Title', 'haru-pangja' ),
                            'description' =>  'Enter title text',
                            'value'       =>  '',
                        ),
                        array(
                            'param_name'  => 'video_image',
                            'type'        => 'attach_image',
                            'heading'     => esc_html__( 'Image Background', 'haru-pangja' ),
                            'description' => esc_html__( 'Please select image background.', 'haru-pangja' ),
                            'admin_label' => true,
                            'dependency' => array(
                                'element' => 'layout_type',
                                'value'   => 'style_3',
                            ),
                        ),
                        array(
                            'param_name' => 'css',
                            'type'       => 'css_editor',
                            'heading'    => esc_html__( 'CSS box', 'haru-pangja' ),
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

    new Haru_Framework_Shortcode_Video();
}