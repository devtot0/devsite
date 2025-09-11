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

if ( ! class_exists('Haru_Framework_Shortcode_Footer_Link') ) {
    class Haru_Framework_Shortcode_Footer_Link {
        function __construct() {
            add_shortcode( 'haru_footer_link', array($this, 'haru_footer_link_shortcode') );
            add_action( 'vc_before_init', array($this, 'haru_footer_link_vc_map') );
        }

        function haru_footer_link_shortcode($atts) {
            $atts  = vc_map_get_attributes( 'haru_footer_link', $atts );
            $links = $layout_type = $css = $el_class = $haru_animation = $css_animation = $duration = $delay = $styles_animation = '';
            extract(shortcode_atts(array(
                'links'      => '',
                'layout_type'   => 'style_1',
                'css'           => '',
                'el_class'      => '',
                'css_animation' => '',
                'duration'      => '',
                'delay'         => '',
            ), $atts));
           
            $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'haru_footer_link', $atts );
            
            $haru_animation   .= HARU_PangjaCore_Shortcodes::haru_get_css_animation($css_animation);
            $styles_animation .= HARU_PangjaCore_Shortcodes::haru_get_style_animation($duration, $delay);

            ob_start();

            ?>
            <?php if ( $links != '' ) : ?>
            <div class="<?php echo esc_attr($css_class . ' ' . $haru_animation . ' ' . $styles_animation); ?>">
                <?php echo haru_get_template('footer/footer-link/'. $layout_type . '.php', array('atts' => $atts), '', '' ); // use echo because footer use echo in theme ?>
            </div>
            <?php else : ?>
                <div class="footer-not-select"><?php echo esc_html__( 'Please insert Footer Link information!', 'haru-pangja' ); ?></div>
            <?php endif; ?>
        <?php
            $content =  ob_get_clean();
            return $content;         
        }

        function haru_footer_link_vc_map() {
            vc_map(
                array(
                    'name'        => esc_html__('Haru Footer Link', 'haru-pangja'),
                    'base'        => 'haru_footer_link',
                    'category'    => HARU_PANGJA_CORE_SHORTCODE_CATEGORY,
                    'icon'        => 'fa fa-link haru-vc-icon',
                    'description' => esc_html__( 'Display Footer Link', 'haru-pangja' ),
                    'params'      =>  array(
                        array(
                            'param_name'  => 'links',
                            'type'        => 'param_group',
                            'heading'     => esc_html__( 'Footer Link List', 'haru-pangja' ),
                            'description' => esc_html__( 'Insert information for Footer Link List.', 'haru-pangja' ),
                            'value'       => urlencode( json_encode( array(
                                array(
                                    'title'       => esc_html__( 'Link text', 'haru-pangja' ),
                                ),
                                array(
                                    'title'       => esc_html__( 'Link text', 'haru-pangja' ),
                                ),
                                array(
                                    'title'       => esc_html__( 'Link text', 'haru-pangja' ),
                                ),
                            ) ) ),
                            'params' => array(
                                // Link Information
                                array(
                                    'param_name'  => 'title',
                                    'type'        => 'textfield',
                                    'heading'     => esc_html__( 'Title', 'haru-pangja' ),
                                    'description' => esc_html__( 'Enter title of footer link.', 'haru-pangja' ),
                                    'admin_label' => true,
                                ),
                                array(
                                    'param_name'  => 'link',
                                    'type'        => 'vc_link',
                                    'heading'     => esc_html__( 'Link', 'haru-pangja' ),
                                    'description' => esc_html__( 'Set link of footer link.', 'haru-pangja' ),
                                    'admin_label' => false,
                                ),
                            ),
                        ),
                        array(
                            'param_name'  => 'layout_type',
                            'heading'     => esc_html__( 'Style', 'haru-pangja' ),
                            'description' => 'Select style for display footer link.',
                            'type'        => 'dropdown',
                            'value'       => array(
                                esc_html__( 'Style 1 (Footer Default)', 'haru-pangja' ) =>  'style_1',
                                esc_html__( 'Style 2 (Footer Background Primary)', 'haru-pangja' )  =>  'style_2',
                                esc_html__( 'Style 3 (Services - Home 5)', 'haru-pangja' )   =>  'style_3',
                                esc_html__( 'Style 4 (Footer Background White)', 'haru-pangja' )   =>  'style_4',
                                esc_html__( 'Style 5 (Inline - Footer 5)', 'haru-pangja' )   =>  'style_5',
                                esc_html__( 'Style 6 (Inline - Align Left)', 'haru-pangja' )   =>  'style_6',
                            ),
                            'admin_label' => true,
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

    new Haru_Framework_Shortcode_Footer_Link();
}
?>